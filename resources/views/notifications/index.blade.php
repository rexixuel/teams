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
		@include('modules.titlearea', ['page' => 'index', 'titlepage' => 'Notifications','leavesActive' => '', 'attendancesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Send Notifications', 'operDescription' => 'Send attendance discrepancy notifications to Tera employees'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Attendance Date </th>
						<th class=""> Recipient </th>
						<th class=""> Message </th>
						<th class="" colspan=""> Status </th>
						<th class="" colspan=""> View </th>
						<th class="" colspan=""> Send </th>
					</tr>				
				</thead>
				
				<tbody>
					@if (!empty($notifications->toArray()))
						@foreach ($notifications as $notification)
						<tr> 
							@include('modules.notificationsTable')
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No Notifications to be Sent Yet </td>
						</tr>
					@endif

				</tbody>
			</table>
			@if (!empty($notifications->toArray()))
				{{ $notifications->links() }}
				
				<form class="form-horizontal" enctype="multipart/form-data" role="form" method="GET" action="{{ url('/notifications/sendAll') }}">
					<fieldset>
						<div class="col-md-10">
							<a href="{{ URL::asset('/') }}" class="btn btn-raised btn-default"> Cancel </a>  	                          <button type="submit" name="submit" class="btn btn-raised btn-info" value="send"> Send All </button>                          

						</div>	
					</fieldset>
        		</form>
            	
			@endif
		</div>

@stop

@include('modules.sidebarScript')
