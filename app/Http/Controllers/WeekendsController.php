<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Weekend;
use Illuminate\Support\Facades\Input;


class WeekendsController extends Controller
{
	public function edit()
	{
		$weekends = new Weekend;
		$weekends = $weekends->get();

		return view('weekends.edit', compact('weekends'));
	}

	public function update(Request $request)
	{	
		$weekendRequest = $request->all();

		$weekends = new Weekend;
		$weekendUpdated = new Weekend;

		if(!empty($weekendRequest['day']))
		{	
			foreach ($weekendRequest['day'] as $weekendDay) {
				$weekendUpdated->where('day','=', $weekendDay)->update(['weekend' => 1]);
				$weekends = $weekends->where('day','!=', $weekendDay);
				echo $weekendDay."<br />";
			}
		}
		else
		{
			$weekends = $weekends->where('day','!=',null);
		}

		$weekends->update(['weekend' => 0]);
		
		return back()->with('message', 'Weekend list has been updated!');
	}
}
