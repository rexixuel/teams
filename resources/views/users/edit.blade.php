@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Employee - Update </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Employees'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Update', 'operDescription' => 'Update Tera Employee details. You may update employee\'s job class here and adjust their leaves'])
                {{ Form::model($user, ['action' => ['UsersController@update',$user->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                    {{-- csrf_field() --}}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                            <br />
                        </div>
                        <a href="{{ url('users/search') }}"> Edit another user? </a>
                    @endif                    
                    <fieldset>

                      <div class="form-group {{ $errors->has('emp_number') ? ' has-error' : '' }}">
                        <label for="emp_number" class="col-md-2 control-label"> Employee Number </label>
                        <div class="col-md-10">
                          <input id="emp-num" name="emp_number" type="text" class="form-control" placeholder="{{ $user->emp_number }}" 
                          value="{{ $user->emp_number }}" disabled="disabled">

                          <span id="helpBlock" class="help-block">Employee number provided by TeraSystem. This field is required and must be unique.</span>
                        </div>
                      </div>       

                      <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-2 control-label"> First Name </label>
                        <div class="col-md-10">
                          @if($errors->has('first_name'))
                          <input id="first-name" name="first_name" type="text" class="form-control" placeholder="Juan" value="{{ old('first_name') }}">
                          @else
                          <input id="first-name" name="first_name" type="text" class="form-control" placeholder="Juan" value="{{ $user->first_name }}">
                          @endif
                          @include('modules.errorField', ['field' => 'first_name'])
                          <span id="helpBlock" class="help-block"> Employee's first name. This field is required.</span>
                        </div>
                      </div>


                      <div class="form-group {{ $errors->has('middle_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-2 control-label"> Middle Name </label>
                        <div class="col-md-10">
                          @if($errors->has('middle_name'))
                          <input id="middle-name" name="middle_name" type="text" class="form-control" placeholder="Manaloto" value="{{ old('middle_name') }}">
                          @else
                          <input id="middle-name" name="middle_name" type="text" class="form-control" placeholder="Manaloto" value="{{ $user->middle_name }}">
                          @endif
                          @include('modules.errorField', ['field' => 'first_name'])
                          <span id="helpBlock" class="help-block"> Employee's middle name. This field is required and is used for building name key.</span>
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-2 control-label"> Last Name </label>

                        <div class="col-md-10">
                        @if($errors->has('last_name'))
                          <input id="last-name" name="last_name" type="text" class="form-control" placeholder="dela Cruz" value="{{ old('last_name') }}">
                        @else
                          <input id="last-name" name="last_name" type="text" class="form-control" placeholder="dela Cruz" value="{{ $user->last_name }}">                        
                        @endif
                          @include('modules.errorField', ['field' => 'last_name'])
                          <span id="helpBlock" class="help-block"> Employee's last name. This field is required.</span>
                        </div>
                      </div>                  

                      <div class="form-group {{ $errors->has('rem_vl') ? ' has-error' : '' }}">
                        {{ Form::label('vl-remaining', 'Remaining VLs:', ['class' => 'pull-left col-md-2 control-label']) }}
                        <div class="col-md-2">
                        @if ($user->jobClass->benefits->allow_vl_update)
                          {{ Form::number('rem_vl',number_format($user->rem_vl, 2),['class' => 'form-control', 'placeholder' => 0, 'id' => 'rem-vl']) }}
                          @include('modules.errorField', ['field' => 'rem_vl'])
                        @else
                          {{ Form::number('rem_vl',number_format($user->rem_vl, 2),['class' => 'form-control', 'placeholder' => 0, 'id' => 'rem-vl']) }}
                        @endif
                        </div>
                        {{ Form::label('sl-remaining', 'Remaining SLs:', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-2">
                          {{ Form::number('rem_sl',number_format($user->rem_sl, 2),['class' => 'form-control', 'placeholder' => 0, 'id' => 'rem-sl']) }}
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-2 control-label"> TeraMail </label>
                        <div class="col-md-10">
                        @if($errors->has('email'))
                          <input id="teramail" name="email" type="email" class="form-control" placeholder="user@teramail.com" value="{{ old('email') }}">
                        @else
                          <input id="teramail" name="email" type="email" class="form-control" placeholder="user@teramail.com" value="{{ $user->email }}">
                        @endif
                          @include('modules.errorField', ['field' => 'email'])
                          <span id="helpBlock" class="help-block"> Employee's Teramail account. Please make sure that employee has been registered in TeraSystem's Teramail service. This field is required and will be used for login authorization.</span>                  
                        </div>
                      </div>                  

                      <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="col-md-2 control-label"> User Photo </label>
                         <div class="col-md-10">
                         <input readonly="" class="form-control" placeholder="Browse..." type="text">
                          <input id="user-photo" name="photo" type="file" accept="image/" class="form-control" 
                          value="{{ old('photo') }}"/>

                          @include('modules.errorField', ['field' => 'photo'])

                          <span id="helpBlock" class="help-block"> User photo used as avatar. This is optional.</span>                                            
                        </div>
                      </div>                                    

                      <div class="form-group {{ $errors->has('job_class_id') ? ' has-error' : '' }}">
                        <label for="job_class_id" class="col-md-2 control-label"> Job Class </label>
                         <div class="col-md-10">
                          <select id="job-class" data-url="{{ url('api/dropdown')}}" name="job_class_id" class="form-control">
                            @foreach ($jobClasses as $jobClass)
                              @if($errors->has('job_class_id'))
                                @if(old('job_class_id') == $jobClass->id)
                                  <option value="{{ $jobClass->id }}" data-description="{{ $jobClass->job_class_description}}" selected>{{ $jobClass->job_class_description}}</option>
                                @else
                                  <option value="{{ $jobClass->id }}" data-description="{{ $jobClass->job_class_description}}" >{{ $jobClass->job_class_description}}</option>
                                @endif  
                              @else
                                @if($user->job_class_id == $jobClass->id)
                                  <option value="{{ $jobClass->id }}" data-description="{{ $jobClass->job_class_description}}" selected>{{ $jobClass->job_class_description}}</option>
                                @else
                                  <option value="{{ $jobClass->id }}" data-description="{{ $jobClass->job_class_description}}">{{ $jobClass->job_class_description}}</option>
                                @endif                                
                              @endif
                            @endforeach
                          </select>

                          @include('modules.errorField', ['field' => 'job_class_id'])

                          <span id="helpBlock" class="help-block"> Employees job class. This will determine the number of leaves allowed for employee. This field is required.</span>                          
                        </div>
                      </div>                                    

                      <div class="form-group {{ $errors->has('job_description_id') ? ' has-error' : '' }}">
                        <label for="job_description_id" class="col-md-2 control-label"> Job Description </label>
                         <div class="col-md-10">
                          <select id="job-description" name="job_description_id" class="form-control" data-primary-selected="{{ $user->job_description_id }}">
                            <option>Select a Job Class</option>
                          </select>

                          @include('modules.errorField', ['field' => 'job_description_id'])
                          <span id="helpBlock" class="help-block"> This refers to employee's job description or title. This field is required.</span>                          
                        </div>
                      </div>                                    
                      
                        <div class="form-group {{ $errors->has('supervisor_id') ? ' has-error' : '' }}" id="supervisor-div">
                          <label for="supervisor_id" class="col-md-2 control-label"> Supervisor </label>
                           <div class="col-md-10">
                            <select id="supervisor-id" class="form-control" name="supervisor_id">
                            
                            @foreach ($supervisors as $supervisor)
                              @if($errors->has('supervisor_id'))                        
                                @if(old('supervisor_id') == $supervisor->id )
                                  <option selected value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                                @else
                                  <option value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                                @endif
                              @else
                                @if($user->supervisor_id == $supervisor->id && $user->supervisor_id != null)
                                  <option selected value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                                @else
                                  <option value="{{ $supervisor->id }}"> {{ $supervisor->info->first_name }} {{ $supervisor->info->last_name }}</option>
                                @endif                            
                              @endif
                            @endforeach
                            
                            </select>

                            @include('modules.errorField', ['field' => 'supervisor_id'])

                            <span id="helpBlock" class="help-block"> This is the employee's immediate supervisor. The assigned supervisor is responsible for approving of employee's leaves. This field is required.</span>

                          </div>
                        </div>
                      
                      @include('modules.submitField', ['field' => 'Update'])
                    </fieldset>
                  {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')
