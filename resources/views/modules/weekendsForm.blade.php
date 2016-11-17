					<div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
						{{ Form::label('days', 'Days:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
							@foreach($weekends as $weekend)

							<label class="days-checkbox checkbox-inline">
							  <input name="day[]" type="checkbox" id="{{ strtolower($weekend->day) }}-checkbox" value="{{ $weekend->day }}" {{$weekend->weekend ? 'checked='.'"'.'checked'.'"' : '' }} /> {{ $weekend->day }}
							</label>							
							@endforeach
						</div>
					</div>					
