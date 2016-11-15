@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Benefits - List </title>
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')
		@include('modules.titlearea', ['titlepage' => 'Benefits','leavesActive' => ''])
		<div class="card l-card">
			@include('modules.cardOperation', ['operation' => 'Browse Benefits', 'operDescription' => 'Select a benefit package to update '])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    			
			<h4> Search Term: <small> {{ $searchRequest->search_description }} </small> </h4> 
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th class=""> Description </th>
  						@if(Auth::user()->role < 2)
  						<th class=""> Update Info </th>						
						<!-- <th class=""> Delete </th> -->
						@endif
					</tr>				
				</thead>
				<tbody>
					@if (!empty($benefits))											
						@foreach($benefits as $benefit)
						<tr> 
						  <th> {{ $benefit->benefit_description }}</th>	
						  @include('modules.tableActions', ['url' => 'benefits/'.$benefit->id.'/edit'])
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6" class="text-center"> No matching benefit </td>
						</tr>
					@endif

				</tbody>
			</table>
			@if (!empty($benefits))											
				{{ $benefits->links() }}
			@endif
		</div>
@stop

@include('modules.sidebarScript')