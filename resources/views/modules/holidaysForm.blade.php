					<div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
						{{ Form::label('start_date', 'Start Date:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
		                  <div class="input-group date" id="start-date-form">
		                    <span class="input-group-addon glyphicon glyphicon-calendar"></span> 
		                    @if($errors->has('start_date') || Request::is('holidays/create'))
			                    {{ Form::text('start_date',old('start_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'start-date']) }}
			                @else
			                    {{ Form::text('start_date',$holidays->start_date->format('m/d/Y'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'start-date', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> Start of holiday. This field is required. Must be less than end date.</span>					        		                  
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
							@if ($errors->has('end_date') || Request::is('holidays/create'))
		                    	{{ Form::text('end_date',old('end_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::tomorrow()->format('m/d/Y'), 'id' => 'end-date']) }}
		                    @else
		                    	{{ Form::text('end_date',$holidays->end_date->format('m/d/Y'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::tomorrow()->format('m/d/Y'), 'id' => 'end-date', $disabled]) }}
		                    @endif
		                  </div>
							<span id="helpBlock" class="help-block"> End of holiday. This field is required. Must be greater than or equal to start date.</span>                  
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
                    	 {{ Form::number('num_days',null,['class' => 'form-control', 'placeholder' => 0, 'id' => 'num-of-days', 'readonly']) }}
						  
						  @if ($errors->has('num_days'))
							@foreach ($errors->get('num_days') as $error)
							<p class="alert alert-danger" id="num-days-error" data-value = "" >
							  {{ $error }}
							</p>
							@endforeach
						  @endif		                  												  			
						  
						  <span id="helpBlock" class="help-block"> Duration of holiday. This field is required. </span>
						</div>
					</div>

					<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}" id="description-group">
						{{ Form::label('holiday_description', 'Description:', ['class' => 'col-md-2 control-label'])}}
						<div class="col-md-10">
						@if ($errors->has('holiday_description') || Request::is('holidays/create'))					
							{{ Form::text('holiday_description', old('holiday_description'), ['class' => 'form-control', 'placeholder' => 'Please input description for holiday', 'id' => 'holiday-description',$readonly]) }}
						@else
							{!! Form::text('holiday_description',null, ['class' => 'form-control', 'placeholder' => 'Please input description for holiday', 'id' => 'holiday-description',$readonly]) !!}
						@endif						
							@if ($errors->has('holiday_description'))
								@foreach ($errors->get('holiday_description') as $error)
								<p class="alert alert-danger" id="description-error" data-value = "" >
								  {{ $error }}
								</p>
								@endforeach
							@endif
							<span id="helpBlock" class="help-block"> Description for holiday. This field is required </span>
						</div>
					</div>