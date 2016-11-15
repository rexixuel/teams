@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Leaves - View </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Leaves'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'View Leave', 'operDescription' => 'View leave details.'])
			{{ Form::model($leaves, ['action' => ['LeavesController@update', $leaves->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<fieldset>
				@include('modules.leavesForm', ['disabled' => 'disabled', 'readonly' => 'readonly'])                 
				@include('modules.submitField')
			</fieldset>
			@include('modules.revokeModal')			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')