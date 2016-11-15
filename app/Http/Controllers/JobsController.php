<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\JobDescriptionRequest;

use App\Benefit;
use App\JobClass;
use App\JobDescription;


class JobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isUserHRD');
    }
    
    public function create()
    {
    	$jobDescription = new JobDescription;
    	$jobClass = new JobClass;
    	$jobClasses = $jobClass->get();

    	return view('jobs.create',compact('jobClasses'));
    }

    public function edit($id)
    {
    	$jobDescription = new JobDescription;
    	$jobDescription = $jobDescription->find($id)->load('jobClasses');
    	$jobClassOriginal = $jobDescription->jobClasses->id;

    	$jobClass = new JobClass;
    	$jobClasses = $jobClass->get();

    	return view('jobs.edit', compact('jobDescription','jobClasses','jobClassOriginal'));
    }    

    public function store(JobDescriptionRequest $request)
    {
    	$jobDescriptionFields = $request->all();
    	$jobDescriptionFields['job_description'] = title_case($request['job_description']);
    	$jobClass = new JobClass;
    	$jobClass = $jobClass->find($request['job_class_id']);    	

        $jobDescription = $jobClass->saveJobDescription(
            new JobDescription($jobDescriptionFields)
        );

		return back()->with('message', title_case($request['job_description']).' has been successfully created!');	
    }

    public function update(JobDescriptionRequest $request, $id)
    {
    	$jobDescription = new JobDescription;

    	$jobDescriptionFields = $request->all();
    	$jobDescriptionFields['job_description'] = title_case($request['job_description']);

    	// $jobClass = new JobClass;
    	// $jobClass = $jobClass->find($request['job_class_id']);


        // $jobDescription->push();
        // dd($jobDescriptionFields);
        $jobDescription = $jobDescription->find($id);
        $jobDescription->job_description = $jobDescriptionFields['job_description'];
        $jobDescription->job_class_id = $jobDescriptionFields['job_class_id'];
        $jobDescription = $jobDescription->push();

		return back()->with('message', title_case($request['job_description']).' has been successfully updated!');	
    }    

    public function show(){
        return view('jobs.search');
    }

    public function browse(Request $request){
        $jobDescriptions = new JobDescription;
        $searchRequest = $request;
        $search_description = $request['search_description'];
        
        $jobDescriptions = $jobDescriptions->where('job_description','LIKE','%'.$request['search_description'].'%')->with('jobClasses')->paginate(10);  
        
        return view('jobs.browse', compact('jobDescriptions', 'searchRequest'));
    }    
}
