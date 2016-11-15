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
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                    <fieldset>

                      <div class="form-group">
                        <label for="emp_num" class="col-md-2 control-label"> Employee Number </label>
                        <div class="col-md-10">
                          <input id="emp-num" name="emp_num" type="text" class="form-control" placeholder="0000">
                        </div>
                      </div>       

                      <div class="form-group">
                        <label for="first_name" class="col-md-2 control-label"> First Name </label>
                        <div class="col-md-10">
                          <input id="first-name" name="first_name" type="text" class="form-control" placeholder="Juan">
                          @include('modules.errorField', ['field' => 'first_name'])
                        </div>
                      </div>       

                      <div class="form-group">
                        <label for="last_name" class="col-md-2 control-label"> Last Name </label>

                        <div class="col-md-10">
                          <input id="last-name" name="last_name" type="text" class="form-control" placeholder="dela Cruz">

                          @include('modules.errorField', ['field' => 'last_name'])
                        </div>
                      </div>                  

                      <div class="form-group">
                        <label for="email" class="col-md-2 control-label"> TeraMail </label>
                        <div class="col-md-10">
                          <input id="teramail" name="email" type="email" class="form-control" placeholder="user@teramail.com">

                          @include('modules.errorField', ['field' => 'email'])
                        </div>
                      </div>                  

                      <div class="form-group">
                        <label for="photo" class="col-md-2 control-label"> User Photo </label>
                         <div class="col-md-10">
                         <input readonly="" class="form-control" placeholder="Browse..." type="text">
                          <input id="user-photo" name="photo" type="file" accept="image/" class="form-control" />

                          @include('modules.errorField', ['field' => 'photo'])
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="job_class_id" class="col-md-2 control-label"> Job Class </label>
                         <div class="col-md-10">
                          <select id="job-class" data-url="{{ url('api/dropdown')}}" name="job_class_id" class="form-control">
                            @foreach ($jobClasses as $jobClass)
                              <option value="{{ $jobClass->id }}">{{ $jobClass->job_class_description}}</option>
                            @endforeach
                          </select>

                          @include('modules.errorField', ['field' => 'job_class_id'])
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="job_description_id" class="col-md-2 control-label"> Job Description </label>
                         <div class="col-md-10">
                          <select id="job-description" name="job_description_id" class="form-control">
                            <option>Select a Job Class</option>
                          </select>

                          @include('modules.errorField', ['field' => 'job_description_id'])
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="supervisor_id" class="col-md-2 control-label"> Supervisor </label>
                         <div class="col-md-10">
                          <select id="immediate-supervisor" class="form-control" name="supervisor_id">
                          @if(!empty($users))
                              @foreach ($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                              @endforeach
                          @endif
                          </select>

                          @include('modules.errorField', ['field' => 'supervisor_id'])
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                          <button type="button" class="btn btn-raised btn-default">Cancel</button>
                          <button type="submit" class="btn btn-raised btn-primary">Register</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')