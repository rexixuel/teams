@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Attendances - Leaves </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['page' => 'index', 'titlepage' => 'Leaves Summary','leavesActive' => 'active', 'attendancesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Leaves Status', 'operDescription' => 'View status of filed leaves'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Date Filed </th>
						<th class=""> # of Days / Hours </th>
						<th class=""> Start Date </th>
						<th class=""> Leave Type </th>
						<th class=""> Reason </th>						
						<th class=""> Status </th>
						<th class=""> View Details </th>
						@if(!Request::is('leaves/approval/*'))
						<th class=""> Revoke? </th>
						@endif
					</tr>				
				</thead>
				<!-- dummy, user @ foreach for actual -->
				<tbody>
					@if (!empty($leaves->toArray()))
						@foreach ($leaves as $leave)
						<tr> 
							@include('modules.leavesTable',['revokeUrl' => url('leaves/'.$leave->id)])
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No Filed Leaves Yet </td>
						</tr>
					@endif

				</tbody>
			</table>
			@if (!empty($leaves->toArray()))
				{{$leaves->links()}}
			@endif
			@include('modules.revokeModal')
		</div>

		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Remaining Leaves', 'operDescription' => 'View number of remaining leaves'])
			<div class="row">
				<div class="col-md-6 text-center">
					<strong> Vacation Leaves: </strong> {{ number_format(Auth::user()->rem_vl, 2) }}
				</div>

				<div class="col-md-6 text-center">
					<strong> Sick Leaves: </strong> {{ number_format(Auth::user()->rem_sl, 2) }}
				</div>
			</div>
		</div>		
@stop
@include('modules.sidebarScript')