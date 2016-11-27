			<div class="row card-operation">
			  <div class="col-xs-6">
				<legend class="text-left card-operation-text">
					{{ $operation }} 
					<small class="card-operation-text">
					@if(empty($attendances))
						 ({{ Carbon\Carbon::now()->format('M d, Y') }})
					@else
						- {{ $attendances->attendance_date->format('M d, Y') }}
					@endunless
					</small> 
				</legend>
			  </div>
			  <div class="col-xs-6">
				<h3 class="text-right l-oper-desc"> <small class="card-operation-text"> {{ $operDescription }} </small> </h3>
			  </div>			  
			</div>
			<hr />
