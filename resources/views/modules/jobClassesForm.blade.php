          @if(Request::is('jobclasses/create'))
                        <div class="form-group {{ $errors->has('job_class_description') ? ' has-error' : '' }}">
                          <label for="job_class_description" class="col-md-2 control-label"> Job Class </label>
                          <div class="col-md-10">
                            <input id="job-class-description" name="job_class_description" type="text" class="form-control" placeholder="Z" value="{{ old('job_class_description')}}">
                            @include('modules.errorField', ['field' => 'job_class_description'])
                          </div>
                        </div>
                        <div class="form-group {{ $errors->has('benefit_id') ? ' has-error' : '' }}">
                          <label for="benefit_id" class="col-md-2 control-label"> Benefit Package </label>
                           <div class="col-md-10">

                            <select id="benefit" name="benefit_id" class="form-control">
                              @foreach ($benefits as $benefit)
                                @if((old('benefit_id') == $benefit->id))
                                  <option value="{{ $benefit->id }}" selected>{{ $benefit->benefit_description }}</option>
                                @else
                                  <option value="{{ $benefit->id }}">{{ $benefit->benefit_description }}</option>
                                @endif  
                              @endforeach
                            </select>

                            @include('modules.errorField', ['field' => 'benefit_id'])

                          </div>

                        </div>       
          @else
                        <div class="form-group {{ $errors->has('job_class_description') ? ' has-error' : '' }}">
                          <label for="job_class_description" class="col-md-2 control-label"> Job Class </label>
                          <div class="col-md-10">
                            {{ Form::text('job_class_description',old('job_class_description'),['class' => 'form-control', 'placeholder' => 0, 'id' => 'job-class-description']) }}

                            @include('modules.errorField', ['field' => 'job_class_description'])
                          </div>
                        </div>
                        <div class="form-group {{ $errors->has('benefit_id') ? ' has-error' : '' }}">
                          <label for="benefit_id" class="col-md-2 control-label"> Benefit Package </label>
                           <div class="col-md-10">

                            <select id="benefit" name="benefit_id" class="form-control">
                              @foreach ($benefits as $benefit)
                                @if((old('benefit_id') == $benefit->id) ||
                                    ($benefit->id == $benefitOriginal  && !$errors->has('benefit_id')) )
                                  <option value="{{ $benefit->id }}" selected>{{ $benefit->benefit_description }}</option>
                                @else
                                  <option value="{{ $benefit->id }}">{{ $benefit->benefit_description }}</option>
                                @endif  
                              @endforeach
                            </select>

                            @include('modules.errorField', ['field' => 'benefit_id'])                            
                          </div>
                        </div>       
          @endif