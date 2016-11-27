<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendancesRequest;

use App\Http\Requests;
use App\AttendanceLog;
use App\Attendance;
use App\Notification;
use App\User;
use App\Leave;
use App\Holiday;
use App\Weekend;
use App\DB;
use Excel;
use Carbon;
use Input;
use Auth;

class AttendancesController extends Controller
{

    public function __construct()
    
    {

        $this->middleware('auth');
        $this->middleware('isUserHRD', ['except' => ['index', 'show']]);
    }

    public function show($id){
        $attendances = Auth::user()->attendances()->with('employee')->find($id);
        
        return view('attendances.show', compact('attendances'));
    }

    public function create()
    {
        return view('attendances.create');
    }

    public function store(AttendancesRequest $request)
    {


        $file = $request['attendance_log'];
        
        $dtrs = Excel::load($file, function($reader) {

        })->get();

        $filename = pathinfo(Input::file('attendance_log')->getClientOriginalName(), PATHINFO_FILENAME);

        $attendanceLog = new AttendanceLog;
        $attendanceLogCount = $attendanceLog->where('filename','=',$filename)->get()->count();
        
        if(empty($attendanceLogCount))
        {
            $attendanceLog->filename = $filename;
            $attendanceLog->save();
        }

        $dtrsStartEnd = $dtrs->take(2);
        
        foreach ($dtrsStartEnd as $dtr) {
            if($dtr[1] == "Start Date"){                
                $startDate = Carbon\Carbon::parse($dtr[2]);
            }elseif($dtr[1] == "End Date"){
                $endDate = Carbon\Carbon::parse($dtr[2]);
            }
        }

        $attendanceRange = $endDate->diff($startDate)->days + 1;
        
        $dtrsRec = $dtrs->toArray();
        
        for($x = 5; $x < count($dtrsRec) - 1 && empty($attendanceLogCount); $x++) {            

            $dtrsName = strval($dtrsRec[$x][1]);
            $dtrsName = strval(title_case($dtrsName));           
            $user = User::where('name_key','like',$dtrsName);
            
            $userCount = $user->count();

            if(!empty($userCount))
            {
                $userFields["rem_vl"] = $user->first()->rem_vl;
                $userFields["rem_sl"] = $user->first()->rem_sl;
            }

            $currentEmp = $x + 1;                        
                        
            $dateLength = strlen(rtrim($dtrsRec[$currentEmp][1], '"')) - 3;
            $prevDtrsDate = Carbon\Carbon::parse(substr($dtrsRec[$currentEmp][1], 0,$dateLength));
            
            $checkDate = "";
            $prevDate = $prevDtrsDate;
            $timeArray = [];            
            $timeIn = [];
            $timeOut = [];
            
            // for($y = 1; $checkDate < $endDate; $y++){ // loop thru dates
            $y = 1;
            do{ // loop thru dates

                $currentEmp = $x + $y;
                             
                $dateLength = strlen(rtrim($dtrsRec[$currentEmp][1], '"')) - 3;
                
                $isValidDate = (bool)strtotime(substr($dtrsRec[$currentEmp][1], 0,$dateLength));

                if($isValidDate){
                  $checkDate = Carbon\Carbon::parse(substr($dtrsRec[$currentEmp][1], 0,$dateLength));
                }

                // echo "checkDate: ".$checkDate." vs prevDate: ".$prevDate."<br />";
                if(($checkDate != $prevDate && $userCount > 0 && $prevDate != "") || (str_contains($dtrsRec[$currentEmp][1],",") == true && $userCount > 0)){
                    // echo "<br /> ".$dtrsName."<br />";
                    $message = "";
                    $errorArray = [];
                    if($prevDate != ""){                        
                        $formattedDate = $prevDate->format('M d, Y');
                    }

                    $timeInIndex = 0;
                    $storeInIndex = 0;
                    $timeOutIndex = 0;                    
                    $storeOutIndex = 0;

                    // match time-ins and time-outs
                    // remove duplicate logs

                    for($timeIndex = 0; $timeIndex < count($timeArray); $timeIndex += 2){
                        if($timeArray[$timeIndex] != ""){
                            
                            $timeIn[$storeInIndex] = $timeArray[$timeIndex];
                            $storeInIndex++;

                            $matchFound = false;
                            for($timeOutIndex = $timeIndex + 1; $matchFound == false && $timeOutIndex < count($timeArray); $timeOutIndex += 2){
                                if($timeArray[$timeOutIndex] != ""){

                                    $timeOut[$storeOutIndex] = $timeArray[$timeOutIndex];
                                    $storeOutIndex++;

                                    $timeIndex = $timeOutIndex - 1;
                                    if($timeOutIndex < count($timeArray) - 2){                                        
                                        if( $timeIn[$storeInIndex - 1] != $timeArray[$timeOutIndex - 1] &&
                                            count($timeIn) < 2 && $timeArray[$timeOutIndex + 1] == ""){

                                            $timeIn[$storeInIndex] = $timeArray[$timeIndex];
                                            $storeInIndex++;                                        
                                        }

                                    }
                                    $matchFound = true;
                                }
                            }

                            if($matchFound == false){
                                $errorArray[6] = "You have a time in without a matching time out. <br /> ";
                            }

                        }
                        else{                 

                            $matchFound = false;                            
                            for($timeInIndex = $timeIndex; $matchFound == false && $timeInIndex < count($timeArray); $timeInIndex += 2){
                                if($timeArray[$timeInIndex] != ""){
                                    $matchFound = true;

                                    if($timeIndex == 0 && $timeArray[$timeInIndex -1] != ""){

                                        $timeOut[$storeOutIndex] = $timeArray[$timeInIndex - 1];
                                        $storeOutIndex++;

                                        $errorArray[7] = "You did not log in on: ".$formattedDate."<br/>";
                                    }
                                }
                            }

                            if($matchFound == false){
                                for($timeOutIndex = $timeIndex + 1; $matchFound == false && $timeOutIndex < count($timeArray); $timeOutIndex += 2){
                                    if($timeArray[$timeOutIndex] != ""){

                                        $timeOut[$storeOutIndex] = $timeArray[$timeOutIndex];
                                        $storeOutIndex++;

                                        $timeIndex = $timeOutIndex - 1;
                                        $matchFound = true;
                                    }
                                }
                            }
                        }
                    }
                    
                    $timeCount = count($timeIn);

                    // re-align time-ins and time-outs
                    $noLunch = false;
                    if(count($timeOut) > 0 && count($timeIn) > 0){

                        if(count($timeOut) != count($timeIn)){

                            if(count($timeOut) > count($timeIn)){
                                $timeCount = count($timeOut);
                                for ($count = 0; $count < $timeCount; $count++){
                                    if($count < count($timeIn)){
                                        $timeInParsed = date('H:i:s', strtotime($timeIn[$count]));
                                    }
                                    if($count < count($timeOut) - 1){
                                        $timeOutParsed = date('H:i:s', strtotime($timeOut[$count + 1]));
                                    }

                                    if($timeOutParsed < $timeInParsed){

                                        $timeIn[$count + 1] = $timeIn[$count];
                                        $timeIn[$count] = "";
                                        
                                    }

                                }                        
                            }else{
                                $timeCount = count($timeIn);
                                
                                for ($count = 0; $count < $timeCount; $count++){
                                    if($count < count($timeIn) - 1){
                                        $timeInParsed = date('H:i:s', strtotime($timeIn[$count + 1]));
                                    }

                                    if($count < count($timeOut)){
                                        $timeOutParsed = date('H:i:s', strtotime($timeOut[$count]));
                                    }

                                    if($timeOutParsed > $timeInParsed && $count < count($timeOut)){
                                        
                                        $timeOut[$count + 1] = $timeOut[$count];
                                        $timeOut[$count] = "";
                                        
                                        $noLunch = true;

                                    }                                    
                                }                            
                            }

                        }
                    }     

                    // tag discrepancies in time logs [temp - for optimazation]

                    if($noLunch){                        
                        $errorArray[0] = "Did you took a lunch on this date? <br /> ";
                    }

                    if(count($timeIn) > 2){
                        if($timeIn[count($timeIn) - 1] >= $timeOut[count($timeOut) - 1]){
                            $errorArray[1] = "You have an extra time in logged. Do you wish to file for an overtime? <br /> ";                            
                        }
                    }


                    if(count($timeOut) > count($timeIn)){
                        $timeCount = count($timeOut);

                        if(count($timeIn) == 0){
                            $errorArray[2] = "You did not log in on ".$prevDate->format('M d, Y')."<br />";
                        }elseif(count($timeIn) > 1){
                            for ($timePop = 0; $timePop <= count($timeOut) - count($timeIn); $timePop++ ) {
                                $timeOut[count($timeOut) - 2] = $timeOut[count($timeOut) - 1];
                                array_pop($timeOut);
                            }

                        }else{
                           $errorArray[3] = "You have a log out without a matching in. Maybe you have missed to log in after lunch on ".$formattedDate."? <br />";   
                        }
                    }elseif(count($timeIn) < 2 && count($timeIn) > 0 && !$noLunch){
                        $errorArray[4] = "Did you took a lunch on this date? <br /> ";
                    }elseif(count($timeOut) < count($timeIn)){
                        $errorArray[5] = "You have a time in without a matching time out. <br /> ";
                    }

                    // store to database

                    $attendanceFields = [];
                    $attendanceFields["attendance_date"] = $prevDate;

                    $attendanceFields["time_in"]  = date('H:i:s', strtotime("00:00:00"));

                    if(count($timeIn) > 0){
                        $attendanceFields["time_in"]  = date('H:i:s', strtotime($timeIn[0]));
                        if(count($timeIn) > 1){
                            $attendanceFields["lunch_in"] = date('H:i:s', strtotime($timeIn[1]));
                        }
                    }

                    if(count($timeOut) > 0){
                        if(count($timeOut) > 1){
                            $attendanceFields["lunch_out"] = date('H:i:s', strtotime($timeOut[0]));
                            $attendanceFields["time_out"]  = date('H:i:s', strtotime($timeOut[1]));
                        }else{
                            $attendanceFields["time_out"]  = $timeOut[0];                            
                        }
                    }                    

                    // check if employee is on leave on this date                    

                    $leave = $user->first()->leaves()->attendanceDateRange($attendanceFields["attendance_date"]);

                    $leaveCount = $leave->count();
                    if(!empty($leaveCount))
                    {
                        $num_days = $leave->first()->num_days;
                    }
                    else
                    {
                        $num_days = 0;
                    }
                    // auto deduct leaves
                    if(empty($leaveCount) || ($num_days == 0.5))
                    {
                        $attendanceTimeIn = date('H:i:s', strtotime($attendanceFields["time_in"]));
                        if(!empty($leaveCount) && $num_days == 0.5)
                        {
                            $gracePeriod = date('H:i:s', strtotime("14:00:00"));
                        }else
                        {
                            $gracePeriod = date('H:i:s', strtotime("9:00:00"));
                        }

                        $attendanceTimeInExplode = explode(":", $attendanceTimeIn);

                        $attendanceTimeInHour = $attendanceTimeInExplode[0];
                        $attendanceTimeInMin = $attendanceTimeInExplode[1];

                        if($attendanceTimeIn > $gracePeriod)
                        {
                            // check hour if greater than 9, then 1 hour * hour - 9
                            // check minutes by >0 && < 15, >15 && <=30, >30 && <=45, > 45 

                            $additionalHour = $attendanceTimeInHour - $gracePeriod;
                            
                            if($attendanceTimeInMin > 0 && $attendanceTimeInMin <= 15)
                            {
                                $attendanceTimeInMin = 15;
                            }
                            elseif($attendanceTimeInMin > 15 && $attendanceTimeInMin <= 30)
                            {
                                $attendanceTimeInMin = 30;
                            }
                            elseif($attendanceTimeInMin > 30 && $attendanceTimeInMin <= 45)
                            {
                                $attendanceTimeInMin = 45;
                            }
                            else
                            {
                                $attendanceTimeInMin = 60;
                            }                            

                            $leaveDeduction = (($attendanceTimeInMin / 60) + $additionalHour) / 8;
                            
                            if($userFields["rem_vl"] > 0 || $userFields["rem_sl"] <= 0)
                            {
                                $userFields["rem_vl"] = $userFields["rem_vl"] - $leaveDeduction;
                            }else{
                                $userFields["rem_sl"] = $userFields["rem_sl"] - $leaveDeduction;
                            }

                            // tag attendance as late by
                            // storing leave deduction
                            $attendanceFields["late_hours"] = $leaveDeduction;

                        }
                    }


                    // on next improvement, check if attendance exists and update on next batch                    
                    // use updateOrCreate eloquent
                    $attendance = $user->first()->storeAttendance(
                        new Attendance($attendanceFields)
                    );

                    $holiday = new Holiday;
                    $holidayCount = $holiday->holidayDateRange($attendanceFields["attendance_date"])->count();

                    $weekendTest = explode("-", $attendanceFields["attendance_date"]);
                    $weekendDay = Carbon\Carbon::parse($attendanceFields["attendance_date"])->format('l');
                    
                    $weekend = new Weekend;
                    $weekendCount = $weekend->where('day','=',$weekendDay)->where('weekend','=',1)->count();

                    //build table for errors
                    if($prevDate != "" && empty($leaveCount) && empty($holidayCount) && empty($weekendCount))
                    {                        
                        if(($attendance->time_in == "00:00:00" || $attendance->time_in == null) && ($attendance->time_out == "00:00:00" || $attendance->time_out == null))
                        {
                            $errorArray[8] = $message."<li> You have no attendance log on this date. Did you want to file for a <a href='".url('leaves/create')."'> leave? </a> </li>";
                        }

                        if(strtotime($attendance->time_out) <= strtotime("17:00:00"))
                        {
                            $errorArray[9] = $message."<li> Were you on half-day or undertime? </a> </li>";
                        }
                    }

                    if($prevDate != "" && count($errorArray) > 0){
                        $message = "<ul>";


                        
                        foreach ($errorArray as $errorMessage) {
                            if(!empty($errorMessage)){
                                $message = $message."<li>".$errorMessage."</li>";                                
                            }
                        }
                        $message = $message."</ul> <br /> Please see attendance log below for reference and get back to us. Thank you! <br /> <br /> ".$formattedDate."<br /> <table> <thead> <tr>";
                        for ($count = 0; $count <= $timeCount + 1; $count++){
                            if($count % 2 == 0){                                
                                $message = $message."<th> In </th>";
                            }else{
                                $message = $message."<th> Out </th>";
                            }
                        }          
                        $message = $message."</tr> </thead> <tbody> <tr>";                        

                        $inCount = 0;
                        $outCount = 0;
                        for ($count = 0; $count <= $timeCount + 1; $count++){
                            if($count % 2 == 0){                                
                                if($inCount < count($timeIn)){                                    
                                    $message = $message."<td>".$timeIn[$inCount]."</td>";                                    
                                    $inCount++;
                                }else{
                                    $message = $message."<td> </td>";
                                }
                            }else{
                                if($outCount < count($timeOut)){
                                    $message = $message."<td>".$timeOut[$outCount]."</td>";
                                    $outCount++;
                                }else{
                                    $message = $message."<td> </td>";
                                }
                            }
                        }          
                        $message = $message."</tr> </tbody> </table>";       


                        $notificationFields = [];
                        $notificationFields["message"] = $message;
                        $notificationFields["mailed_status"] = "Pending";
                        $notificationFields["read_status"] = "Pending";
                        $notificationFields["attendance_id"] = $attendance->id;

                        $user->first()->storeNotification(
                            new Notification($notificationFields)
                        );

                    }                    

                    $timeArray = [];

                    $timeIn = [];
                    $timeOut = [];
                }

                // build time log array
                $arrayFlat = $dtrsRec[$currentEmp];
                array_shift($arrayFlat);                
                $timeArray = array_merge($timeArray, $arrayFlat);

                $prevDate = $checkDate;

                $y++;               
                 
            }while(str_contains($dtrsRec[$currentEmp][1],",") == false && $currentEmp < count($dtrsRec) - 1);

            // select where('late_hours' ,'>', 0)
            // aggregate leave deduction
            if(!empty($userCount))
            {
                $user = $user->find($user->first()->id);
                $user->rem_vl = $userFields["rem_vl"];
                $user->rem_sl = $userFields["rem_sl"];
                $user->save();
            }

            $x = $currentEmp - 1;
            
        }

        if(empty($attendanceLogCount))
        {
            return back()->with('message', 'Attendance log: '.$filename.' has been successfully uploaded. Please check notifications on sidebar to send discrepancy notices to Tera employees. Thank you.');
        }
        else
        {
            return back()->with('error', 'Attendance log: '.$filename.' has already been processed. Please upload new attendance log. Thank you.');
        }
    }

    public function index()
    {
        $url = 'api/calendar';
        $urlLeaves = 'api/Leaves';
    	return view('attendances.index',compact('url', 'urlLeaves'));
    }

}
