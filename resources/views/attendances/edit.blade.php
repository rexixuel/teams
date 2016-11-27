@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Attendances - Update </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Attendances'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Update attendance', 'operDescription' => 'Update attendance details'])
			{{ Form::model($attendances, ['method' => 'PATCH', 'action' => ['UsersController@attendanceUpdate',$attendances->employee->id, $attendances->id], 'class' => 'form-horizontal']) }}

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        <a href="{{ url('users/search') }}"> Edit another user attendance? </a>
                    @endif
			
			<fieldset>
				@if(!empty($attendances))
					@include('modules.attendancesForm', ['readonly' => '', 'disabled' =>'']) 
				@else
					<p class="alert alert-warning text-center"> Attendance not found for user </p>
				@endif
                  <div class="form-group">
                    @include('modules.submitField', ['field' => 'Update'])	                  
	              </div>
                
			</fieldset>
			
			{{ Form::close()}}

		</div>
@stop

@include('modules.sidebarScript')