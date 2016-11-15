@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Employees - List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Employees','leavesActive' => '', 'attendancesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'View Employee Attendance', 'operDescription' => 'Select an employee and view his or her attendances'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<h4> Search Term: <small> {{ $search['search_emp_number'] }} - {{ $search['search_first_name'] }} {{ $search['search_last_name'] }}</small> </h4> 
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Employee Number </th>
						<th class=""> Name </th>
						<th class=""> # of Lates for {{ Carbon\Carbon::now()->format('M') }} </th>
						<th class=""> Job Class </th>
						<th class=""> Job Description </th>
						<th class=""> Attendances </th>
						<th class=""> Leaves </th>
  						@if(Auth::user()->role < 2)
  						<th class=""> Update Info </th>						
						<th class=""> Delete </th>
						@endif
					</tr>				
				</thead>
				<tbody>
					@if (!empty($users))
						@foreach($users as $user)
						<tr> 
						  <th> {{ $user->emp_number }}</th>	
						  <th> {{ $user->first_name }} {{ $user->last_name }} </th>
						  <td> {{ $user->num_lates }} </td>
						  <td> {{ $user->jobClass->job_class_description }} </td>
						  <td> {{ $user->jobDescription->job_description }} </td>
						  <td class="btn-group-sm"> <a class="text-center btn btn-primary btn-fab" alt="View attendances" href="{{ URL::asset('/users/'.$user->id.'/attendances')}}"> <i class="material-icons">event_available</i> </a> </td>
						  <td class="btn-group-sm"> <a class="text-center btn btn-primary btn-fab" alt="View leaves" href="{{ URL::asset('/leaves/approval/'.$user->id)}}"> <i class="material-icons">flight_takeoff</i> </a> </td>						  
						  @include('modules.tableActions', ['url' => 'users/'.$user->id.'/edit', 'deleteUrl' => url('users/'.$user->id)])
						</tr>
						@endforeach						
					@else
						<tr>
							<td colspan="6" class="text-center"> No matching employees </td>
						</tr>
					@endif

				</tbody>
			</table>
			@if (!empty($users))
				{{ $users->links() }}
			@endif
			@include('modules.deleteModal')
		</div>
@stop

@include('modules.sidebarScript')