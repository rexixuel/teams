<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\BenefitRequest;
use App\Benefit;

class BenefitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isUserHRD');
    }
        
    public function create()
    {
    	return view('benefits.create');
    }

    public function edit($id)
    {

    	$benefit = new Benefit;
    	$benefit = $benefit->find($id);
    	
    	return view('benefits.edit', compact('benefit'));
    }

    public function store(BenefitRequest $request)
    {
    	$benefitFields = $request->all();
    	$benefitFields['benefif_description'] = title_case($request['benefit_description']);
    	$benefit = new Benefit;
        $benefit = $benefit->create($benefitFields);

		return back()->with('message', title_case($request['benefit_description']).' has been successfully created!');	
    }

    public function update(BenefitRequest $request, $id)
    {

    	$benefitFields = $request->all();

    	$benefit = new Benefit;
    	$benefit = $benefit->find($id);
    	$benefit = $benefit->update($benefitFields);
    	
		return back()->with('message', title_case($request['benefit_description']).' has been successfully updated!');	
    }

    public function show(){
        return view('benefits.search');
    }

    public function browse(Request $request){
        $benefits = new Benefit;
        $searchRequest = $request;
        $search_description = $request['search_description'];
        
        $benefits = $benefits->where('benefit_description','LIKE','%'.$request['search_description'].'%')->paginate(10);  
        
        return view('benefits.browse', compact('benefits', 'searchRequest'));
    }    

}
