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
			@include('modules.cardOperation', ['operation' => 'Approve Leave', 'operDescription' => 'Review leave details for approval or rejection'])
			{{ Form::model($leaves, ['action' => ['LeavesController@approve',$leaves->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) }}

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
						<a href="{{ url('leaves/approval') }}"> Review another leave? </a>
                    @endif                    
			
			<fieldset>
				@include('modules.leavesForm', ['readonly' => 'readonly', 'disabled' =>'disabled']) 

				@if($leaves->status != "Approved")
                  @include('modules.submitField', ['field' => 'Approve', 'field2' => 'Reject'])
                @else
                  <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
	                  <a href="{{ URL::asset('/leaves/approval') }}" class="btn btn-raised btn-default"> Back </a>
	                </div>
	              </div>
                @endif
			</fieldset>
			
			{{ Form::close()}}
		</div>
@stop

@include('modules.sidebarScript')