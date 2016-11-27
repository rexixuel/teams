					<input type="hidden" data-url="{{ url('api/weekends') }}" id="url" />
					@unless(Request::is('leaves/create'))
						<div class="form-group">
								{{ Form::label('status', 'Status: ', ['class' => 'col-md-2 control-label']) }}
								<div class="col-md-10">
									<p class="text-left"> {{ $leaves->status }} </p>
								</div>
						</div>
					@endunless
					<div class="form-group">
							{{ Form::label('user', 'Employee: ', ['class' => 'col-md-2 control-label']) }}
							<div class="col-md-2">
								<p class="text-left"> {{ $user->first_name }} {{ $user->last_name }} </p>
							</div>
						@unless(Request::is('leaves/*/review'))
							{{ Form::label('project-manager', 'Project Manager: ', ['class' => 'col-md-2 control-label']) }}
							<div class="col-md-2">
								<p class="text-left"> {{ $user->supervisors->info->first_name }} {{ $user->supervisors->info->last_name }} </p>
							</div>
						@endunless						
					</div>
					<div class="form-group">
						{{ Form::label('vl-remaining', 'Remaining VLs:', ['class' => 'pull-left col-md-2 control-label']) }}
						<div class="col-md-2">
							{{ Form::text('rem_vl',number_format($user->rem_vl, 2),['class' => 'form-control', 'placeholder' => 0, 'id' => 'rem-vl', 'readonly']) }}
						</div>
						{{ Form::label('sl-remaining', 'Remaining SLs:', ['class' => 'col-md-2 control-label']) }}
						<div class="col-md-2">
		                    {{ Form::text('rem_sl',number_format($user->rem_sl, 2),['class' => 'form-control', 'placeholder' => 0, 'id' => 'rem-sl', 'readonly']) }}
						</div>
					</div>					
					<div class="form-group">
						{{ Form::label('leave_type', 'Leave Type:', ['class' => 'col-md-2 control-label']) }}		
						<div class="col-md-10">
					 		<select name="leave_type_id" class="form-control" {{ $disabled }} aria-describedby="helpBlock">
							  @foreach ($leaveTypes as $leaveType)
								  @if($errors->has('leave_type_id') || Request::is('leaves/create'))
							        <option value="{{ $leaveType->id }}" {{ old('leave_type_id') == $leaveType->id ? 'selected='.'"'.'selected'.'"' : '' }}>{{ $leaveType->leave_description }}</option>
							      @else
							        <option value="{{ $leaveType->id }}" {{ $leaves->leave_type_id == $leaveType->id ? 'selected='.'"'.'selected'.'"' : '' }}>{{ $leaveType->leave_description }}</option>							      
							      @endif
							  @endforeach
					        </select>
							<span id="helpBlock" class="help-block">Type of leave to be filed. Emergency leaves count as vacation leaves. This field is required.</span>					        
						</div>
					</div>
					<div class="form-group">
                      <div class="radio l-radio col-md-10 col-md-offset-2">
                      @if($errors->has('leave_sub_type') || Request::is('leaves/create'))
                        <label class="">
                        	@if(Request::is('leaves/create'))
                        		@if( !$errors->has('leave_sub_type') )
                            		<input type="radio" name="leave_sub_type" id="leave-sub-type" value="whole" {{ 'checked='.'"'.'checked'.'"'}} {{ $disabled }} >
                            	@endif
    						@else
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="whole" {{ old('leave_sub_type')=="whole" ? 'checked='.'"'.'checked'.'"' : ''}} {{ $disabled }} >
    						@endif
                            	Whole day(s)
                        </label>

                        <label class="">
                            <input type="radio" name="leave_sub_type" id="leave-sub-type" value="half" {{ old('leave_sub_type')=="half" ? 'checked='.'"'.'checked'.'"' : ''}} {{ $disabled }} >
    						Half day
                        </label>

                        <label class="">
                            <input type="radio" name="leave_sub_type" id="leave-sub-type" value="under" {{ old('leave_sub_type')=="under" ? 'checked='.'"'.'checked'.'"' : '' }} {{ $disabled }}>
    						Undertime
                        </label>
                      @else
                        <label class="">
                        	@if($leaves->num_days  >= 1)
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="whole" {{ $leaves->num_days  >= 1 ? 'checked='.'"'.'checked'.'"' : ''}} >
                            @else
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="whole" {{ $leaves->num_days  >= 1 ? 'checked='.'"'.'checked'.'"' : ''}} {{ $disabled }} >
                            @endif
    						Whole day(s)
                        </label>

                        <label class="">
                        	@if($leaves->num_days  < 1 && $leaves->num_days  > 0.375)
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="half" {{ $leaves->num_days  < 1 && $leaves->num_days  > 0.375 ? 'checked='.'"'.'checked'.'"' : ''}} >
                            @else
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="half" {{ $leaves->num_days  < 1 && $leaves->num_days  > 0.375 ? 'checked='.'"'.'checked'.'"' : ''}} {{ $disabled }} >
                            @endif
    						Half day
                        </label>

                        <label class="">
                        	@if($leaves->num_days  < 0.5)
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="under" {{ $leaves->num_days  < 0.5 ? 'checked='.'"'.'checked'.'"' : '' }} >
                            @else
                            	<input type="radio" name="leave_sub_type" id="leave-sub-type" value="under" {{ $leaves->num_days  < 0.5 ? 'checked='.'"'.'checked'.'"' : '' }} {{ $disabled }}>
                            @endif
    						Undertime
                        </label>                      
                      @endif
							@if ($errors->has('leave_sub_type'))
								@foreach ($errors->get('leave_sub_type') as $error)
								<br />
								<br />
								<p class="alert alert-danger" id="leave-sub-type-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif
                      </div>
                    </div>
					<div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
						{{ Form::label('start_date', 'Start Date:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="start-date-form">
		                    <span class="input-group-addon glyphicon glyphicon-calendar"></span> 
		                    @if($errors->has('start_date') || Request::is('leaves/create'))
			                    {{ Form::text('start_date',old('start_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'start-date']) }}
			                @else
			                    {{ Form::text('start_date',$leaves->start_date->format('m/d/Y'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'start-date', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Start of leave. This field is required. Must be less than end date.</span>					        		                  
							@if ($errors->has('start_date'))
								@foreach ($errors->get('start_date') as $error)
								<p class="alert alert-danger" id="start-date-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  
						</div>
					</div>					

					<div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
						{{ Form::label('end_date', 'End Date:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="end-date-form">
		                    <span class="input-group-addon glyphicon glyphicon-calendar"></span> 
							@if ($errors->has('end_date') || Request::is('leaves/create'))
		                    	{{ Form::text('end_date',old('end_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::tomorrow()->format('m/d/Y'), 'id' => 'end-date']) }}
		                    @else
		                    	{{ Form::text('end_date',$leaves->end_date->format('m/d/Y'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::tomorrow()->format('m/d/Y'), 'id' => 'end-date', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> End of leave. This field is required. Must be greater than or equal to start date.</span>                  
							@if ($errors->has('end_date'))
								@foreach ($errors->get('end_date') as $error)
								<p class="alert alert-danger" id="end-date-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif		                  						
						</div>
					</div>					

					<div class="form-group {{ $errors->has('num_days') ? ' has-error' : '' }}">
						<label for="num-of-days" id="num-of-days-label" class="col-md-2 control-label"> Number of Days: </label>
						<div class="col-md-10">
                    	 {{ Form::text('num_days',null,['class' => 'form-control', 'placeholder' => 0, 'id' => 'num-of-days', 'readonly']) }}
						  
						  @if ($errors->has('num_days'))
							@foreach ($errors->get('num_days') as $error)
							<p class="alert alert-danger" id="num-days-error" data-value = "" >
							  {{ $error }}
							</p>
							@endforeach
						  @endif		                  												  			
						  
						  <span id="helpBlock" class="help-block"> Duration of leave. This field is required. Half days get 4 hours; undertimes get 3 to 1 hour(s). Half-days and whole days are automatically computed and filled</span>
						</div>
					</div>					

					<div class="form-group {{ $errors->has('reason') ? ' has-error' : '' }}">
						{{ Form::label('reason', 'Reason:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
							{{ Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => 'Please input reason for filing leave', $readonly]) }}
							@if ($errors->has('reason'))
								@foreach ($errors->get('reason') as $error)
								<p class="alert alert-danger" id="reason-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif
							<span id="helpBlock" class="help-block"> Reason for leave. This field is required. Must be a valid reason, to be reviewed by your project manager.</span>                  						
						</div>
					</div>