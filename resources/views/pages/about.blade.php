@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> About </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['titlepage' => 'About'])
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
            	<h2> TeraSystem, Inc. Employee Attendance Management System <small> TEAMS </small></h2>
            	
            	<hr />

            	<p class="about">
            		<blockquote> TEAMS design is based from Google's Material design principles. <br/>

            		It is powered by Laravel 5 Framework, Bootstrap, and jQuery <br />

            		Deployed through <a href="{{ url('https://forge.laravel.com/')}}"> Laravel Forge</a>; hosted at <a href="{{ url ('https://www.amazon.com/')}}" > AWS </a>; registered at 
            		<a href="{{ url('https://www.godaddy.com/')}}"> GoDaddy </a>
            		</blockquote>
            	</p>

            	<p class="about">
            		<p class="lead"> The developer thanks: </p>
            		<ul>
            			<li> Taylor Otwell - for creating a wonderful <a href="{{ url('https://laravel.com/')}}"> framework </a> for PHP </li>
            			<li> Jeffrey Way and Satt Stauffer - for the awesome tutorials at <a href="{{ url ('https://laracasts.com/')}} " > laracasts </a> and at <a href="{{ url('mattstauffer.co')}}"> mattstauffer.co </a> </li>
            			<li> T00rk - for the great <a href="{{ url ('https://github.com/T00rk/bootstrap-material-datetimepicker')}}"> datetimepicker </a> </li>
            			<li> Maatwebsite - for the brilliant <a href="{{ url('https://github.com/Maatwebsite/Laravel-Excel/')}}"> excel package for PHP </a></li>
        			</ul>
            		<br />
            		<p class="lead"> and especially...</p>

            		The Family, friends, colleagues, mentors, professors, and advisers of the developer for participating and supporting this project

            	</p>
              </div>
            </div>  
          </section>                         
@stop