<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Holiday;
use App\Http\Requests\HolidaysRequest;
use Carbon\Carbon;

class HolidaysController extends Controller
{

	public function __construct()
	{
        $this->middleware('auth');
        $this->middleware('isUserHRD');
	}

    public function create()
    {
    	return view('holidays.create');
    }

    public function edit($id)
    {
        $holidays = Holiday::find($id);
        
        return view('holidays.edit',compact('holidays'));
    }    

    public function store(HolidaysRequest $request)
    {

		$holidayFields = $request->all();

		$holiday = new Holiday;

        $holiday = $holiday->create($holidayFields);

    	return back()->with('message',$holiday->holiday_description." holiday has been successfully created!");

    }

    public function update(HolidaysRequest $request, $id)
    {

        $holidayFields = $request->all();        

        $holiday = Holiday::find($id);
        $holiday->update($holidayFields);

        return back()->with('message',$holiday->holiday_description." holiday has been successfully updated!");
    }

    public function show(){
        return view('holidays.search');
    }

    public function browse(Request $request){
        $holidays = new Holiday;
        $searchRequest = $request;
        $search_description = $request['search_description'];
        if(!empty($searchRequest["start_date"]) || !empty($searchRequest["end_date"])){
            $holidays = $holidays->where('holiday_description','LIKE','%'.$request['search_description'].'%')
                                 ->where('start_date','=',Carbon::parse($request['start_date']))
                                 ->orWhere('end_date','=',Carbon::parse($request['end_date']))->paginate(5);  
        }
        else
        {
            $holidays = $holidays->where('holiday_description','LIKE','%'.$request['search_description'].'%')
                                 ->orWhere('start_date','=',Carbon::parse($request['start_date']))
                                 ->orWhere('end_date','='.Carbon::parse($request['end_date']))->paginate(5);
        }
        
        return view('holidays.browse', compact('holidays', 'searchRequest'));
    }

}
