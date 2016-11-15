                      <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                          @if(Request::is('leaves/*/review'))
                            <a href="{{ URL::asset('leaves/approval') }}" class="btn btn-raised btn-default"> Back </a>
                          @else
                            <a href="{{ URL::asset('/') }}" class="btn btn-raised btn-default"> Cancel </a>
                            @if(!empty($leaves) && $leaves->status == "Approved" && Auth::id() == $leaves->employees->id)
                            <button alt="Revoke/Cancel leave" type="button" data-toggle="modal" data-target="#revoke-modal" class="btn btn-raised btn-warning"> Revoke </a>

                            @endif
                          @endif
                          @if( Request::is('*/create') || Request::is('*/*/review') || Request::is('*/*/edit') || Request::is('*/register') || Request::is('*/search') || Request::is('weekends/edit'))
                          	@if(Request::is('leaves/*/review'))
                             @if($leaves->status == "Pending")
  	                          <button type="submit" name="submit" class="btn btn-raised btn-info" value="{{ $field }}">{{ $field }}</button>                          
  	                          @if(Request::is('leaves/*/review'))
  	                          	<button type="submit" name="submit" class="btn btn-raised btn-danger" value="{{ $field2 }}">{{ $field2 }}</button>
  	                          @endif
	                          @endif
	                        @else
	                          <button type="submit" name="submit" class="btn btn-raised btn-info" value="{{ $field }}">{{ $field }}</button>                          	                        
	                        @endif
	                      @endif
                        </div>
                      </div>