@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Employee - Registration </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Users'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Registration', 'operDescription' => 'Register new Tera Employee'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                    <fieldset>

                      <div class="form-group {{ $errors->has('emp_number') ? ' has-error' : '' }}">
                        <label for="emp_number" class="col-md-2 control-label"> Employee Number </label>
                        <div class="col-md-10">
                          <input id="emp-num" name="emp_number" type="text" class="form-control" placeholder="0000" 
                          value="{{ old('emp_number') }}">
                          @include('modules.errorField', ['field' => 'emp_number'])                       
                        </div>
                      </div>       

                      <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-2 control-label"> First Name </label>
                        <div class="col-md-10">
                          <input id="first-name" name="first_name" type="text" class="form-control" placeholder="Juan" value="{{ old('first_name') }}">
                          @include('modules.errorField', ['field' => 'first_name'])
                        </div>
                      </div>       

                      <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-2 control-label"> Last Name </label>

                        <div class="col-md-10">
                          <input id="last-name" name="last_name" type="text" class="form-control" placeholder="dela Cruz" value="{{ old('last_name') }}">

                          @include('modules.errorField', ['field' => 'last_name'])
                        </div>
                      </div>                  

                      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label"> TeraMail </label>
                        <div class="col-md-10">
                          <input id="teramail" name="email" type="email" class="form-control" placeholder="user@teramail.com" value="{{ old('email') }}">

                          @include('modules.errorField', ['field' => 'email'])
                        </div>
                      </div>                  

                      <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-2 control-label"> User Photo </label>
                         <div class="col-md-10">
                         <input readonly="" class="form-control" placeholder="Browse..." type="text">
                          <input id="user-photo" name="photo" type="file" accept="image/" class="form-control" 
                          value="{{ old('photo') }}"/>

                          @include('modules.errorField', ['field' => 'photo'])
                        </div>
                      </div>                                    

                      <div class="form-group {{ $errors->has('job_class_id') ? ' has-error' : '' }}">
                        <label for="job_class_id" class="col-md-2 control-label"> Job Class </label>
                         <div class="col-md-10">
                          <select id="job-class" data-url="{{ url('api/dropdown')}}" name="job_class_id" class="form-control">
                            @foreach ($jobClasses as $jobClass)
                              @if(old('job_class_id') == $jobClass->id)
                                <option value="{{ $jobClass->id }}" selected>{{ $jobClass->job_class_description}}</option>
                              @else
                                <option value="{{ $jobClass->id }}">{{ $jobClass->job_class_description}}</option>
                              @endif  
                            @endforeach
                          </select>

                          @include('modules.errorField', ['field' => 'job_class_id'])
                        </div>
                      </div>                                    

                      <div class="form-group {{ $errors->has('job_description_id') ? ' has-error' : '' }}">
                        <label for="job_description_id" class="col-md-2 control-label"> Job Description </label>
                         <div class="col-md-10">
                          <select id="job-description" name="job_description_id" class="form-control">
                            <option>Select a Job Class</option>
                          </select>

                          @include('modules.errorField', ['field' => 'job_description_id'])
                        </div>
                      </div>                                    

                      <div class="form-group {{ $errors->has('supervisor_id') ? ' has-error' : '' }}">
                        <label for="supervisor_id" class="col-md-2 control-label"> Supervisor </label>
                         <div class="col-md-10">
                          <select id="supervisor-id" class="form-control" name="supervisor_id">
                          
                          @foreach ($supervisors as $supervisor)
                            @if(old('supervisor_id') == $supervisor->id )
                              <option selected value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                            @else
                              <option value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                            @endif
                          @endforeach
                          
                          </select>

                          @include('modules.errorField', ['field' => 'supervisor_id'])
                        </div>
                      </div>
                          @include('modules.submitField', ['field' => 'Register'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')