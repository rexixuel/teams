@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Holidays - List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Holidays','leavesActive' => '', 'holidaysActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Browse Holidays', 'operDescription' => 'Select holiday to update'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<h4> Search Term: <small> {{ $searchRequest->search_description }},{{ $searchRequest->start_date }}, {{ $searchRequest->end_date }} </small> </h4> 
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Description </th>
						<th class=""> Start Date </th>
						<th class=""> End Date </th>
  						@if(Auth::user()->role < 2)
  						<th class=""> Update Info </th>						
						<!-- <th class=""> Delete </th> -->
						@endif
					</tr>				
				</thead>
				<tbody>
					@if (!empty($holidays))						
						@foreach($holidays as $holiday)
						<tr> 
						  <th> {{ $holiday->holiday_description }}</th>	
						  <td> {{ $holiday->start_date->format('m/d/Y') }} </td>
						  <td> {{ $holiday->end_date->format('m/d/Y') }} </td>
						  @include('modules.tableActions', ['url' => 'holidays/'.$holiday->id.'/edit'])
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No matching employees </td>
						</tr>
					@endif

				</tbody>
			</table>
			@if (!empty($holidays))						
				{{ $holidays->links() }}
			@endif
		</div>
@stop

@include('modules.sidebarScript')