					@if(Request::is('jobs/create'))
                          <div class="form-group {{ $errors->has('job_description') ? ' has-error' : '' }}">
                            <label for="job-description" class="col-md-2 control-label"> Job Description</label>
                            <div class="col-md-10">
	                          <input type="text" name="job_description" id="job-description" class="form-control" placeholder="New Job"/>

	                          @include('modules.errorField', ['field' => 'job_description'])
	                          <span id="helpBlock" class="help-block"> This refers to employee's job description or title. This field is required.</span>                          
                            </div>
                          </div>

	                      <div class="form-group {{ $errors->has('job_class_id') ? ' has-error' : '' }}">
	                        <label for="job_class_id" class="col-md-2 control-label"> Job Class </label>
	                         <div class="col-md-10">
	                          <select id="job-class" data-url="{{ url('api/dropdown')}}" name="job_class_id" class="form-control">
	                            @foreach ($jobClasses as $jobClass)
	                              @if(old('job_class_id') == $jobClass->id)
	                                <option value="{{ $jobClass->id }}" selected>{{ $jobClass->job_class_description}}</option>
	                              @else
	                                <option value="{{ $jobClass->id }}">{{ $jobClass->job_class_description}}</option>
	                              @endif  
	                            @endforeach
	                          </select>

	                          @include('modules.errorField', ['field' => 'job_class_id'])

	                          <span id="helpBlock" class="help-block"> Employees job class. This will determine the number of leaves allowed for employee. This field is required.</span>                          
	                        </div>
	                      </div>
                    @else
                      
                          <div class="form-group {{ $errors->has('job_description') ? ' has-error' : '' }}">
                            <label for="job-description" class="col-md-2 control-label"> Job Description</label>
                            <div class="col-md-10">
                            {{ Form::text('job_description',old('job_description'),['class' => 'form-control', 'placeholder' => 'Job Description', 'id' => 'job-description']) }}                            

	                          @include('modules.errorField', ['field' => 'job_description'])
	                          <span id="helpBlock" class="help-block"> This refers to employee's job description or title. This field is required.</span>                          
                            </div>
                          </div>

	                      <div class="form-group {{ $errors->has('job_class_id') ? ' has-error' : '' }}">
	                        <label for="job_class_id" class="col-md-2 control-label"> Job Class </label>
	                         <div class="col-md-10">
	                          <select id="job-class" data-url="{{ url('api/dropdown')}}" name="job_class_id" class="form-control">
	                            @foreach ($jobClasses as $jobClass)
	                              @if((old('job_class_id') == $jobClass->id) ||
	                              		($jobClass->id == $jobClassOriginal  && !$errors->has('job_class_id')) )
	                                <option value="{{ $jobClass->id }}" selected>{{ $jobClass->job_class_description}}</option>
	                              @else
	                                <option value="{{ $jobClass->id }}">{{ $jobClass->job_class_description}}</option>
	                              @endif  
	                            @endforeach
	                          </select>

	                          @include('modules.errorField', ['field' => 'job_class_id'])

	                          <span id="helpBlock" class="help-block"> Employees job class. This will determine the number of leaves allowed for employee. This field is required.</span>                          
	                        </div>
	                      </div>                                                                                                          
                      
                    @endif
