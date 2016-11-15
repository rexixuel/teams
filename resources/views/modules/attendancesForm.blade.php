					<div class="form-group">
							{{ Form::label('project-manager', 'Project Manager: ', ['class' => 'col-md-2 control-label']) }}
							<div class="col-md-2">
								<p class="text-left"> {{ $attendances->employee->supervisors->info->first_name }} {{ $attendances->employee->supervisors->info->last_name }} </p>
							</div>						
						
							{{ Form::label('user', 'Employee: ', ['class' => 'col-md-2 control-label']) }}
							<div class="col-md-2">
								<p class="text-left"> {{ $attendances->employee->first_name }} {{ $attendances->employee->last_name }} </p>
							</div>

					</div>

					<div class="form-group {{ $errors->has('time_in') ? ' has-error' : '' }}">
						{{ Form::label('time_in', 'Time In::', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="time-in-form">
		                    <span class="input-group-addon glyphicon glyphicon-time"></span> 
		                    @if($errors->has('time_in') || Request::is('attendances/*/edit'))
			                    {{ Form::text('time_in',old('time_in'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('H:i:s'), 'id' => 'time-in']) }}
			                @else
			                    {{ Form::text('time_in',$attendances->time_in,['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('H:i:s'), 'id' => 'time-in', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Employee time in at the beginning of the day </span>					        		                  
							@if ($errors->has('time_in'))
								@foreach ($errors->get('time_in') as $error)
								<p class="alert alert-danger" id="time-in-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  
						</div>
					</div>
					<div class="form-group {{ $errors->has('lunch_out') ? ' has-error' : '' }}">
						{{ Form::label('lunch_out', 'Lunch Out:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="lunch-out-form">
		                    <span class="input-group-addon glyphicon glyphicon-time"></span> 
		                    @if($errors->has('lunch_out') || Request::is('attendances/*/edit'))
			                    {{ Form::text('lunch_out',old('lunch_out'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'lunch-out']) }}
			                @else
			                    {{ Form::text('lunch_out',$attendances->lunch_out,['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'lunch-out', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Employee lunch out. </span>					        		                  
							@if ($errors->has('lunch_out'))
								@foreach ($errors->get('lunch_out') as $error)
								<p class="alert alert-danger" id="lunch-out-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  
						</div>
					</div>
					<div class="form-group {{ $errors->has('lunch_in') ? ' has-error' : '' }}">
						{{ Form::label('lunch_in', 'Lunch In:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="lunch-in-form">
		                    <span class="input-group-addon glyphicon glyphicon-time"></span> 
		                    @if($errors->has('lunch_in') || Request::is('attendances/*/edit'))
			                    {{ Form::text('lunch_in',old('lunch_in'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'lunch-in']) }}
			                @else
			                    {{ Form::text('lunch_in',$attendances->lunch_in,['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'lunch-in', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Time employee came back from lunch. </span>					        		                  
							@if ($errors->has('lunch_in'))
								@foreach ($errors->get('lunch_in') as $error)
								<p class="alert alert-danger" id="lunch-in-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  
						</div>
					</div>					
					<div class="form-group {{ $errors->has('time_out') ? ' has-error' : '' }}">
						{{ Form::label('time_out', 'Time Out:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="time-out-form">
		                    <span class="input-group-addon glyphicon glyphicon-time"></span> 
		                    @if($errors->has('time_out') || Request::is('attendances/*/edit'))
			                    {{ Form::text('time_out',old('time_out'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'time-out']) }}
			                @else
			                    {{ Form::text('time_out',$attendances->time_out,['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'time-out', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Employee time out at the end of the day. </span>					        		                  
							@if ($errors->has('time_out'))
								@foreach ($errors->get('time_out') as $error)
								<p class="alert alert-danger" id="time-out-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  
						</div>
					</div>