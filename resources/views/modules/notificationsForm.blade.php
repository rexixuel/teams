					<div class="form-group">						
							{{ Form::label('user', 'Recipient: ', ['class' => 'col-md-2 control-label']) }}
							<div class="col-md-2">
								<p class="text-left"> {{ $notifications->user->first_name }} {{ $notifications->user->last_name }} </p>
							</div>

					</div>

					<div class="form-group {{ $errors->has('time_in') ? ' has-error' : '' }}">
						{{ Form::label('message', 'Message:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group" id="message-form">
		                  		{!! $notifications->message !!}		                  		
		                  </div>
							<span id="helpBlock" class="help-block"> Employee time in at the beginning of the day </span>
						</div>
					</div>
