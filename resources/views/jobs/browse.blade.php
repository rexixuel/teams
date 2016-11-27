@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Jobs - List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Jobs','leavesActive' => '', 'jobDescriptionsActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Browse Jobs', 'operDescription' => 'Select a job description to update'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<h4> Search Term: <small> {{ $searchRequest->search_description }} </small> </h4> 
  	        <div class="row">
           	  <div class="col-md-2">
				<a href="{{ url('jobs/create') }}"> Create New Job Description? </a>
			  </div>
			</div>
			<br />			
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Description </th>
						<th class=""> Job Class </th>						
  						@if(Auth::user()->role < 2)
  						<th class=""> Update Info </th>						
						<!-- <th class=""> Delete </th> -->
						@endif
					</tr>				
				</thead>
				<tbody>
					@if (!empty($jobDescriptions))						
						@foreach($jobDescriptions as $jobDescription)
						<tr> 
						  <th> {{ $jobDescription->job_description }}</th>	
						  <td> {{ $jobDescription->jobClasses->job_class_description }} </td>
						  @include('modules.tableActions', ['url' => 'jobs/'.$jobDescription->id.'/edit'])
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No matching jobs </td>
						</tr>
					@endif

				</tbody>
			</table>
				@if (!empty($jobDescriptions))
					{{ $jobDescriptions->links() }}
				@endif
		</div>
@stop

@include('modules.sidebarScript')