<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\JobClassRequest;

use App\Benefit;
use App\JobClass;

class JobClassesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isUserHRD');
    }
    
    public function create()
    {
    	$benefit = new Benefit;

    	$benefits = $benefit->all();

    	return view('jobClasses.create', compact('benefits'));
    }

    public function store(JobClassRequest $request)
    {
    	$jobClassFields = $request->all();
    	$jobClassFields['job_class_description'] = title_case($request['job_class_description']);
    	$benefit = new Benefit;
    	$benefit = $benefit->find($request['benefit_id']);    	

        $jobClass = $benefit->saveJobClass(
            new JobClass($jobClassFields)
        );

		return back()->with('message', title_case($request['job_class_description'].' has been successfully created!'));	
    }    

    public function edit($id)
    {    	

    	$jobClass = new JobClass;
    	$jobClass = $jobClass->find($id)->load('benefits');
    	
    	$benefitOriginal = $jobClass->benefits->id;

    	$benefit = new Benefit;

    	$benefits = $benefit->all();

    	return view('jobClasses.edit', compact('jobClass','benefits', 'benefitOriginal'));
    }    

    public function update(JobClassRequest $request, $id)
    {
    	$jobClass = new JobClass;

    	$jobClassFields = $request->all();
    	$jobClassFields['job_class_description'] = $request['job_class_description'];

        $jobClass = $jobClass->find($id);
        $jobClass->job_class_description = $jobClassFields['job_class_description'];
        $jobClass->benefit_id = $jobClassFields['benefit_id'];
        $jobClass = $jobClass->push();

		return back()->with('message', $request['job_class_description'].' has been successfully updated!');	
    }

    public function show(){
        return view('jobClasses.search');
    }

    public function browse(Request $request){
        $jobClasses = new JobClass;
        $searchRequest = $request;
        $search_description = $request['search_description'];
        
        $jobClasses = $jobClasses->where('job_class_description','LIKE','%'.$request['search_description'].'%')->with('benefits')->paginate(10);  
        
        return view('jobClasses.browse', compact('jobClasses', 'searchRequest'));
    }    
}