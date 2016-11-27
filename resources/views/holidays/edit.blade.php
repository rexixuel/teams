@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Holidays - Update </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Holidays'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Update Holidays', 'operDescription' => 'Fill up fields below to update holiday. This shall be used for verifying leaves and attendances.'])

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        <a href="{{ url('holidays/search') }}"> Edit another holiday? </a>
                    @endif                    
   			{!! Form::model($holidays, ['action' => ['HolidaysController@update',$holidays->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}

			<fieldset>
				@include('modules.holidaysForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Update'])
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')