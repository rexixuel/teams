@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Leaves - Approval List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Leave Approval','leavesActive' => 'active', 'attendancesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Pending Leaves for Approval', 'operDescription' => 'View pending leaves for approval'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> By </th>
						<th class=""> Date Filed </th>
						<th class=""> # of Days / Hours </th>
						<th class=""> Start Date </th>
						<th class=""> Leave Type </th>
						<th class=""> Reason </th>						
						<th class="" colspan="2"> Status </th>
					</tr>				
				</thead>
				<tbody>
					@if (!empty($leaves->toArray()))
						
							@foreach ($leaves as $leave)
							<tr> 
								<th> {{ $leave->employees->first_name }} {{ $leave->employees->last_name }} </th>	
								@include('modules.leavesTable')
							</tr>
							@endforeach
						
					@else
						<tr>
							<td colspan="6" class="text-center"> No Filed Leaves Yet </td>
						</tr>
					@endif

				</tbody>
			</table>
		</div>
@stop

@include('modules.sidebarScript')