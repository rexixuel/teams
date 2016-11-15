                      <div class="form-group {{ $errors->has('search_description') ? ' has-error' : '' }}">
                        <label for="search_description" class="col-md-2 control-label"> Search Description </label>
                         <div class="col-md-10">                         
                          <input type="text" id="search" name="search_description" class="form-control" 
                          value="{{ old('search_description') }}"/>

                          @include('modules.errorField', ['field' => 'search_description'])
                        </div>
                      </div>                                                    