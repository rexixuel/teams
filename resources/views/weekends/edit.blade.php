@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Weekends - Update </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Weekends'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Update Weekends', 'operDescription' => 'Select days to be tagged as weekends.'])

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    
   			{!! Form::model($weekends, ['action' => ['WeekendsController@update'], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

			<fieldset>
				@include('modules.weekendsForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Update'])
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')