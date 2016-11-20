              @if(Request::is('benefits/create'))
                        <div class="form-group">
                          <label for="benefit_description" class="col-md-2 control-label"> Description </label>
                          <div class="col-md-10">
                            <input id="benefit-description" name="benefit_description" type="text" class="form-control" placeholder="New Benefit">

                            @include('modules.errorField', ['field' => 'benefit_description'])
                          </div>
                        </div>       

                        <div class="form-group">
                          <label for="max_vl" class="col-md-2 control-label"> Vacation Leaves </label>
                          <div class="col-md-10">
                            <input id="max-vl" name="max_vl" type="number" class="form-control" placeholder="15">

                            @include('modules.errorField', ['field' => 'max_vl'])
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="max_sl" class="col-md-2 control-label"> Sick Leaves </label>
                          <div class="col-md-10">
                            <input id="max-sl" name="max_sl" type="number" class="form-control" placeholder="13">
                            @include('modules.errorField', ['field' => 'max_sl'])
                          </div>
                        </div>       
                        <div class="form-group">
                          <label for="allow_vl_update" class="col-md-2 control-label"> Allow Vacation Leave Adjustment? </label>
                          <div class="col-md-10">
                              <div class="radio l-radio">
                                 <label>
                                    <input type="radio" name="allow_vl_update" id="allow-yes" value="1" checked>
                                    Yes
                                 </label>
                                 <label>
                                    <input type="radio" name="allow_vl_update" id="allow-no" value="0" checked>
                                    No
                                 </label>
                              </div>
                              <span id="helpBlock" class="help-block"> Determines if job class is allowed for leave offset. This field is required. </span>

                          </div>
                        </div>
              @else

                        <div class="form-group">
                          <label for="benefit_description" class="col-md-2 control-label"> Description </label>
                          <div class="col-md-10">
                            {{ Form::text('benefit_description',old('benefit_description'),['class' => 'form-control', 'placeholder' => 'Benefit', 'id' => 'benefit-description']) }}

                            @include('modules.errorField', ['field' => 'benefit_description'])
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="max_vl" class="col-md-2 control-label"> Vacation Leaves </label>
                          <div class="col-md-10">

                            {{ Form::number('max_vl',old('max_vl'),['class' => 'form-control', 'placeholder' => 0, 'id' => 'max-vl']) }}

                            @include('modules.errorField', ['field' => 'max_vl'])
                          </div>
                        </div>       
                        <div class="form-group">
                          <label for="max_sl" class="col-md-2 control-label"> Sick Leaves </label>
                          <div class="col-md-10">
                          
                            {{ Form::number('max_sl',old('max_sl'),['class' => 'form-control', 'placeholder' => 0, 'id' => 'max-sl']) }}

                            @include('modules.errorField', ['field' => 'max_sl'])
                          </div>
                        </div>       
                        <div class="form-group">
                          <label for="allow_vl_update" class="col-md-2 control-label"> Allow Vacation Leave Adjustment? </label>
                          <div class="radio l-radio col-md-10 col-md-offset-2">
                            @if(old('allow_vl_update') == 1 ||$benefit->allow_vl_update == true)
                               <label>
                                  <input type="radio" name="allow_vl_update" id="allow-yes" value="1" checked />
                                  Yes

                               </label>
                               <label>
                                  <input type="radio" name="allow_vl_update" id="allow-no" value="0" />
                                  No
                               </label>
                            @else
                               <label>
                                  <input type="radio" name="allow_vl_update" id="allow-yes" value="1" />
                                  Yes

                               </label>
                               <label>
                                  <input type="radio" name="allow_vl_update" id="allow-no" value="0" checked />
                                  No
                               </label>
                            @endif                            
                          </div>
                        </div>              
              @endif