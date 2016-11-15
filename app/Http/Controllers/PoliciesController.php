<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PoliciesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isUserHRD');
    }
    	
    public function index()
    {
    	return view('policies.index');
    }
}
