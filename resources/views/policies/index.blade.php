@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Leave Policy - Set-up </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Leave Policy'])
            <div class="row">
              <div class="col-md-6">
                <div class="card l-card thumbnail">
                  @include('modules.cardOperation', ['operation' => 'Holidays and Weekends', 'operDescription' => 'Set-up holidays and weekends to skip attendance check'])
                  <ul class="nav nav-pills nav-stacked">
                    <li class="" role="presentation"> <a href="{{ URL::asset('holidays/search') }}"> Browse Holidays </a> </li>
                    <li class="" role="presentation"> <a href="{{ URL::asset('holidays/create') }}"> Create Holidays </a> </li>
                    <li class="" role="presentation"> <a href="{{ URL::asset('weekends/edit') }}"> Edit Weekends </a> </li>
                  </ul>
                </div>
              </div>              
              <div class="col-md-6">
                <div class="card l-card thumbnail">
                  @include('modules.cardOperation', ['operation' => 'Employee Info and Leaves', 'operDescription' => 'Search for an employee and either delete his/her profile or update his/her information and number of vacation leaves'])
                  <ul class="nav nav-pills nav-stacked">
                    <li class="" role="presentation"> <a href="{{ URL::asset('users/search') }}"> Browse Users </a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card l-card thumbnail">
                  @include('modules.cardOperation', ['operation' => 'Job Leave Benefits', 'operDescription' => 'Set-up job descriptions and associated leave benefits'])
                  <h5> Benefits </h5>
                  <ul class="nav nav-pills nav-stacked">
                    <li class="" role="presentation"> <a href="{{ URL::asset('benefits/search') }}"> Browse Benefit Packages </a> </li>
                    <li class="" role="presentation"> <a href="{{ URL::asset('benefits/create') }}"> Create Benefit Package </a> </li>
                  </ul>

                  <hr />
                  <h5> Job Classes </h5>
                  <ul class="nav nav-pills nav-stacked">
                    <li class="" role="presentation"> <a href="{{ URL::asset('jobclasses/search') }}"> Browse Job Classes </a> </li>
                    <li class="" role="presentation"> <a href="{{ URL::asset('jobclasses/create') }}"> Create Job Class </a> </li>
                  </ul>

                  <hr />
                  <h5> Job Descriptions </h5>
                  <ul class="nav nav-pills nav-stacked">
                    <li class="" role="presentation"> <a href="{{ URL::asset('jobs/search') }}"> Browse Job Descriptions </a> </li>
                    <li class="" role="presentation"> <a href="{{ URL::asset('jobs/create') }}"> Create Job Descriptions </a> </li>
                  </ul>

                </div>

              </div>

            </div>            
          </section>                         
@stop

@include('modules.sidebarScript')