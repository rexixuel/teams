			{{!! Form::open() !!}}
				<fieldset>
					<div class="form-group">
						{{!! Form::label('project-manager', 'Project Manager:'), }}
						<div class="col-md-10">
							 {{ $user->user->first_name }} {{ $user->user->last_name }}
						</div>
					</div>
					<div class="form-group">
						{{!! Form::label('vl-remaining', 'Remaining VLs:'), }}
						<div class="col-md-10">
							{{ $user->rem_vl }}
						</div>
					</div>					
					<div class="form-group">
						{{!! Form::label('sl-remaining', 'Remaining SLs:'), }}
						<div class="col-md-10">
							{{ $user->rem_sl }}
						</div>
					</div>
					<div class="form-group">
						{{!! Form::label('leave-type', 'Type of Leave:'), }}
						<div class="col-md-10">
					 		<select name="leave-type" class="form-control">
							  @foreach ($leaveTypes as $leaveType)
						        <option>{{ $leaveType->leave_description }}</option>							  
							  @endforeach
					        </select>						
						</div>
					</div>
					<div class="form-group">
						{{!! Form::label('start-date', 'Start Date:'), }}
						<div class="col-md-10">
						<!-- material datepicker -->
						</div>
					</div>					

					<div class="form-group">
						{{!! Form::label('end-date', 'End Date:'), }}
						<div class="col-md-10">
						<!-- material datepicker -->
						</div>
					</div>					

					<div class="form-group">
						{{!! Form::label('num-of-days', 'Number of Days:'), }}
						<div class="col-md-10">
						<!-- javascript computation here: start date - end date-->
						</div>
					</div>					

					<div class="form-group">
						{{!! Form::label('reason', 'Reason:'), }}
						<div class="col-md-10">
							{{!! Form:textarea('reason', 'Please enter reason for filing leave') !!}}
						</div>
					</div>					
				</fieldset>
			{{!! Form::close() !!}}