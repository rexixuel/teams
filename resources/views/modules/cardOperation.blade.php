			<div class="row">
			  <div class="col-xs-6">
				<legend class="text-left"> 
					{{ $operation }} 
					<small>					
					@if(empty($attendances))
						 ({{ Carbon\Carbon::now()->format('M d,Y') }})
					@else
						- {{ $attendances->attendance_date->format('M d,Y') }}
					@endunless
					</small> 
				</legend>
			  </div>
			  <div class="col-xs-6">
				<h3 class="text-right l-oper-desc"> <small> {{ $operDescription }} </small> </h3>
			  </div>			  
			</div>
			<hr />
