@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Attendances - Details </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Attendances'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'View attendance', 'operDescription' => 'View attendance details'])
			{{ Form::model($attendances, ['method' => 'POST', 'class' => 'form-horizontal']) }}

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
			
			<fieldset>
				@if(!empty($attendances))
					@include('modules.attendancesForm', ['readonly' => 'readonly', 'disabled' =>'disabled']) 
				@else
					<p class="alert alert-warning text-center"> Attendance not found for user </p>
				@endif
                  <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
	                  <a href="{{ URL::asset('/') }}" class="btn btn-raised btn-default"> Back </a>
	                </div>
	              </div>
                
			</fieldset>
			
			{{ Form::close()}}

		</div>
@stop

@include('modules.sidebarScript')