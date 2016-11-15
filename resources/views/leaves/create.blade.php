@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
	        ])

@section('titlePage')
	<title> Leaves - File </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => '','titlepage' => 'Leaves'])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'File Leave', 'operDescription' => 'Fill up fields below to file a vacation or sick leave. Please be mindful of your remaining leaves.'])
			{{ Form::open(['url' => 'leaves', 'method' => 'POST', 'class' => 'form-horizontal']) }}
			<fieldset>
				@include('modules.leavesForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Submit'])
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')