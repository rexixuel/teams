					<div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
						{{ Form::label('days', 'Days:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
							@foreach($weekends as $weekend)

							<label class="days-checkbox checkbox-inline">
							  <input name="day[]" type="checkbox" id="{{ strtolower($weekend->day) }}-checkbox" value="{{ $weekend->day }}" {{$weekend->weekend ? 'checked='.'"'.'checked'.'"' : '' }} /> {{ $weekend->day }}
							</label>							
							@endforeach
<!-- 							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="sunday-checkbox" value="sunday"> Sunday
							</label>						
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="monday-checkbox" value="monday"> Monday
							</label>
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="tuesday-checkbox" value="tuesday"> Tuesday
							</label>
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="wednesday-checkbox" value="wednesday"> Wednesday
							</label>
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="thursday-checkbox" value="thursday"> Thursday
							</label>
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="friday-checkbox" value="friday"> Friday
							</label>
							<label class="days-checkbox checkbox-inline">
							  <input type="checkbox" id="saturday-checkbox" value="saturday"> Saturday
							</label>															 -->
						</div>
					</div>					
