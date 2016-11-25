<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\JobClass;
use App\User;
use App\Supervisor;
class PagesController extends Controller
{

    public function about()
    {
    	return view('pages.about');
    }

    public function contact(){

    	$devs = [

    	];

    	return view('pages.contact', compact('devs'));
    }
}
