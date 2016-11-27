@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Job Classes - List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Job Classes','leavesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Browse Job Classes', 'operDescription' => 'Select a job class to update'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<h4> Search Term: <small> {{ $searchRequest->search_description }} </small> </h4> 
  	        <div class="row">
           	  <div class="col-md-2">
				<a href="{{ url('jobclasses/create') }}"> Create New Job Class? </a>                    
			  </div>
			</div>
			<br />
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Description </th>
						<th class=""> Benefit Package </th>
  						@if(Auth::user()->role < 2)
  						<th class=""> Update Info </th>						
						<!-- <th class=""> Delete </th> -->
						@endif
					</tr>				
				</thead>
				<tbody>
					@if (!empty($jobClasses))						
						@foreach($jobClasses as $jobClass)
						<tr> 
						  <th> {{ $jobClass->job_class_description }}</th>	
						  <td> {{ $jobClass->benefits->benefit_description }} </td>
						  @include('modules.tableActions', ['url' => 'jobclasses/'.$jobClass->id.'/edit'])
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No matching job classes </td>
						</tr>
					@endif

				</tbody>
			</table>
				@if (!empty($jobClasses))
					{{ $jobClasses->links() }}
				@endif

		</div>
@stop

@include('modules.sidebarScript')