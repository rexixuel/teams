@extends('layouts.app',[
			'bodyClass' => '',
	        'containerClass' => '',
	        'divWrapperId' => 'wrapper',
	        'footerClass' => 'footer-main'
        ])

@section('titlePage')
	<title> Attendances - Calendar </title>	
@stop

@include('modules.mnav')

@include('modules.sidebar')

@section('content')		
		@include('modules.titlearea', ['titlepage' => 'Attendances Summary', 'attendancesActive' => 'active', 'leavesActive' => ''])
		<div class="card calendar">
	        <div class="card cal1" id="clndr-attendance" data-url="{{ url($url) }}" data-url-holiday="{{ url('api/holidays') }}" data-url-leave="{{ url('api/leaves') }}" data-action="{{ Auth::user()->role < 2 ? 'edit' : '' }}">

		    	<script type="text/template" id="clndr-attendance-template">
		            <div class="clndr-controls">
		                <div class="clndr-previous-button clndr-button text-center"><i class="clndr-previous-button fa fa-angle-left" aria-hidden="true"></i></div>
		                <div class="month text-center"><%= month %></div>
		                <div class="clndr-next-button clndr-button text-center"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		            </div>
			        <table class='table clndr-table' border='0' cellspacing='0' cellpadding='0'>
			            <thead>
			                <tr class='header-days'>
			                <% for(var i = 0; i < daysOfTheWeek.length; i++) { %>
			                    <td class='header-day text-center'><%= daysOfTheWeek[i] %></td>
			                <% } %>
			                </tr>
			            </thead>
			            <tbody>
			            <% for(var i = 0; i < numberOfRows; i++){ %>
			                <tr>
			                <% for(var j = 0; j < 7; j++){ %>
			                <% var d = j + i * 7; %>
			                    <td class='<%= days[d].classes %>'>
			                        <div class='day-contents'><%= days[d].day %>
			                                <br />
			                                  <% _.each(days[d].events, function(event) { %>
			                                      <a class="event" href="<%= event.url %>"> <%= event.title %> </a>

			                                      <br />
			                                  <% }); %>
			                        </div>
			                    </td>
			                <% } %>
			                </tr>
			            <% } %>
			            </tbody>
			        </table>

					<div class="card events">
		                <div class="headers">
		                  <div class="event-header text-center"> Summary - List View </div>
		                  <div class="event-header text-center"> Total number of lates in days: <span id="lates-for-month"> </span> </div>
		                </div>

						<table class='table table-striped table-hover'>
							<thead>
								<tr>
									<th class=""> Date </th>
									<th class=""> Time In </th>
									<th class=""> Time Out </th>
									<th class=""> Action </th>
								</tr>				
							</thead>

							<tbody>

			                  <% _.each(eventsThisMonth, function(event) { %>
			                    <tr class="event">
			                      <td> 
			                      	<%= moment(event.date).format('MMMM DD, YYYY') %>
			                      </td>
			                      <td>
			                      	<%= event.timeIn %>
			                      </td>
			                      <td>
			                      	<%= event.timeOut %>
			                      </td>		                      
								  <td class="text-left btn-group-sm"> 
								  	<a class="btn btn-primary btn-fab" alt="View Details" href="<%= event.url %>" > <i class="material-icons">pageview</i> </a> 
							  	  </td>		                      
			                    </tr>
			                  <% }); %>


							</tbody>
						</table>		                
		                <div class="events-list">
		                </div>
		            </div>		            
				</script>

	      	</div>      
	    </div>	

	    <div class="card">

	    </div>

@stop

@include('modules.sidebarScript')