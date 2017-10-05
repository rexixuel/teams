<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Leave;
use App\LeaveType;
use App\User;
use App\Http\Requests;
use App\Http\Requests\LeavesRequest;
use App\Notifications\LeaveProcessed;
use App\Notifications\LeaveReviewed;
use App\Notifications\LeaveRevoked;
use App\CustomClasses\EmployeeSick;
use App\CustomClasses\EmployeeVacation;

use Carbon;
use Auth;

class LeavesController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('isUserProjectManager', ['only' => ['review', 'approve']]);
        $this->middleware('isUserAdmin', ['only' => ['approval']]);
    }

    public function index()
    {
        
        $leaveType = new LeaveType;
        $leaves = new Leave;
                
        $user = Auth::user()->load('leaves')->load('leaves.leaveTypes');
        
        // $leaves = $user->leaves()->orderBy('created_at','desc')->get();
        $leaves = $user->leaves()->orderBy('created_at', 'desc')->paginate(3);
        return view('leaves.index', compact('leaves'));
    }

    public function approval()
    {

        $leaveType = new LeaveType;
        $leaves = new Leave;
        $users = new User;

        $leaves = $leaves->where('status', '=', 'Pending')->whereHas('employees', function ($q) {
                $q->where('users.supervisor_id', '=', Auth::id());
        })->orderBy('created_at', 'desc')->paginate(3)->load('employees', 'leaveTypes');
        
        return view('leaves.approval', compact('leaves'));
    }

    public function approvalAll($id)
    {

        $leaveType = new LeaveType;
        $leaves = new Leave;
        $user = new User;

        $user = $user->find($id)->load('leaves')->load('leaves.leaveTypes');
        $leaves = $user->leaves()->paginate(3);

        return view('leaves.index', compact('leaves', 'user'));
    }

    public function review($id)
    {

        $leave = new Leave;
        $leaveType = new LeaveType;

        $leaves = $leave->findOrFail($id)->load('employees');
        $user = $leaves->employees;
        $leaveTypes = $leaveType::all();
        if (!empty($leaves['num_days'])) {
            $leaves['num_days'] = number_format($leaves['num_days'], 3);
        }
        return view('leaves.review', compact('user', 'leaves', 'leaveTypes'));
    }

    public function approve(LeavesRequest $request, $id)
    {
        
        $leave = new Leave;
        $leaveType = new LeaveType;

        $leaveFields = $request->all();
        
        $leave = $leave->findOrFail($id)->load('employees');
        $leaveType = $leave->findOrFail($id)->load('leaveTypes');

        // this can also be moved to a class CalculateDays

        if ($leaveFields['leave_sub_type'] != "whole") {
            $numOfDays = $leaveFields['num_days'] / 8;
        } else {
            $numOfDays = $leaveFields['num_days'];
        }

        // this can be moved to a class Approvals or Leaves

        if (strtoupper($leaveFields['submit']) == 'APPROVE') {
            $leave->status = 'Approved';
            $leaveClass = 'App\CustomClasses\\'.$leaveType->leaveTypes->leave_type_class;
            

            // dd($employeeLeave->RemainingLeaves());

            if ($leave->leave_type_id == 1) {
                $employeeLeave = new $leaveClass($numOfDays, $leave->employees->rem_vl);
                $leave->employees->rem_vl = $employeeLeave->RemainingLeaves();
            } else {
                $employeeLeave = new $leaveClass($numOfDays, $leave->employees->rem_sl);
                $leave->employees->rem_sl = $employeeSick->RemainingLeaves();
            }
        } else {
            $leave->status = 'Rejected';
        }

        $user = $leave->employees;

        $user->notify(new LeaveProcessed($leave));
        
        $leave->push();


        return redirect('leaves/approval')->with('message', $leave->employees->first_name.' '.$leave->employees->last_name.'\'s leave has been '.$leave->status);
    }

    public function show($id)
    {

        $leave = new Leave;
        $leaveType = new LeaveType;

        $leaves = $leave->findOrFail($id)->load('employees');
        $user = $leaves->employees;
        $leaveTypes = $leaveType::all();

        if (!empty($leaves['num_days'])) {
            $leaves['num_days'] = number_format($leaves['num_days'], 3);
        }

        return view('leaves.show', compact('user', 'leaves', 'leaveTypes'));
    }

    public function edit($id)
    {

        $leave = new Leave;
        $leaveType = new LeaveType;

        $leaves = $leave->findOrFail($id)->load('employees');
        $user = $leaves->employees;
        $leaveTypes = $leaveType::all();

        return view('leaves.edit', compact('user', 'leaves', 'leaveTypes'));
    }

    public function update($id)
    {

        $leave = new Leave;
        $leaveType = new LeaveType;

        $leave = $leave->findOrFail($id)->load('employees');

        $leave->status = 'Revoked';
        
        $user = $leave->employees;

        $user->notify(new LeaveRevoked($leave));

        $users = new User;
        $users = $users->where('role', '=', 1)->get();
        
        foreach ($users as $user) {
            $user->notify(new LeaveRevoked($leave));
        }
        
        $leave->push();



        return back()->with('message', 'Your leave has been '.$leave->status);
    }

    public function create()
    {
        
        $leaveType = new LeaveType;
                
        $user = Auth::user()->load('supervisors');

        $leaveTypes = $leaveType::all();

        if ($user->supervisor_id != null) {
            return view('leaves.create', compact('user', 'leaveTypes'));
        } else {
            return view('errors.noSupervisor');
        }
    }

    public function store(LeavesRequest $request)
    {

        $leaveFields = $request->all();
        $leaveFields['status'] = 'Pending';
        
        if ($leaveFields['leave_sub_type'] != "whole") {
            $leaveFields['end_date'] = $leaveFields['start_date'];
        }

        
        $leave = Auth::user()->fileLeave(
            new Leave($leaveFields)
        );

        $user = Auth::user()->load('supervisors.info');
        
        $user->supervisors->info->notify(new LeaveReviewed($leave));
        
        return redirect('leaves')->with('message', 'Leave has been successfully filed. Please wait for your supervisor\'s approval. Thank you.');
    }
}
