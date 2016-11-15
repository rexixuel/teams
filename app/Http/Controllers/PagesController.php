<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\JobClass;
use App\User;
use App\Supervisor;
class PagesController extends Controller
{
    // temporary for UI testing
    public function usrMgt() 
    {    
        $jobClasses = new JobClass;
        
        $jobClasses = $jobClasses->all();

        $users = new User;
        $supervisors = new Supervisor;
        $users = $users->where('role', '=', '1')->get();


        $supervisors = $supervisors->all();
        return view('pages.usrMgt', compact('jobClasses','users', 'supervisors'));
    }    

    public function index()
    {    
        return view('pages.index');
    }

    public function about()
    {

    	$first = 'Reuel';
    	$last = 'Cabal';
    	return view('pages.about', compact('first', 'last'));
    }

    public function contact(){

    	$devs = [

    	];

    	return view('pages.contact', compact('devs'));
    }
}
