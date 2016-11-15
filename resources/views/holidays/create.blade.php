@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Holidays - Create </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Holidays'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Create Holidays', 'operDescription' => 'Fill up fields below to create new holiday. This shall be used for verifying leaves and attendances.'])

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    
                    			
			{{ Form::open(['url' => 'holidays', 'method' => 'POST', 'class' => 'form-horizontal']) }}
			<fieldset>
				@include('modules.holidaysForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Create'])
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')