@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ]
	    )

@section('titlePage')
	<title> Leaves - Approve </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Leaves'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Edit Leave', 'operDescription' => 'Edit leave details before approval'])
			{{ Form::model($leaves, ['url' => 'leaves/update', 'method' => 'POST', 'class' => 'form-horizontal']) }}
			<fieldset>
				@include('modules.leavesForm', ['disabled' => '', 'readonly' => '']) 
                @include('modules.submitField', ['field' => 'Edit'])
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')