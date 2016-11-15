@extends('app')

@section('titlePage')
	<title> Attendances - Leaves </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		<div class="row">
		  <div class="col-md-12">
		  	<h1 class="titlepage text-right"> Attendances </h1>
		  </div>		  
		</div>
		<div class="card">
			<legend class="text-left"> File Leave </legend>
			<hr />
			<form method="POST" action="/store" class="form-horizontal">
				<fieldset>
					<div class="form-group">
						<label for="project-manager" class="col-md-2 control-label"> Project Manager: </label>
						<div class="col-md-10">
							 {{ $user->first_name }} {{ $user->last_name }}
						</div>
					</div>
				</fieldset>
			</form>
		</div>

@stop

@include('modules.sidebarScript')