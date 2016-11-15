
@extends('layouts.app',[
          'bodyClass' => 'landing-page',
          'containerClass' => 'landing-cover',
          'divWrapperId' => 'index-wrapper',
          'footerClass' => 'footer-landing'
        ])


@section('titlePage')
  <title> Home - T.E.A.M.S. </title>
@stop

@include('modules.mnav')

@section('content')
          <div class="row">
            <div class="col-lg-6 col-lg-push-6">
            
              <div class="login">
                <h1 class="login"> Log In </h1>
                <form class="" action="" method="post" id="login-form">
                  <div class="form-group label-floating">
                      <label for="teramail" class="control-label">TeraMail</label>
                      <input type="text" id="teramail" name="teramail" value="" placeholder="" class="form-control" />                      
                  </div>                    
                  <div class="form-group label-floating">
                      <label for="password" class="control-label">Password</label>
                      <input type="password" id="password" name="password" placeholder="" class="form-control" />
                  </div>
                  <div class="form-group row">
                    
                      <button type="submit" name="login" class="btn btn-raised btn-primary teams-btn"> Log In </button>
                                        
                      <span class="text-right"> <a href="recov" class="btn btn-link"> Forgot password? </a> </span>
                    
                  </div>
                </form>
              </div>
            </div>
<!--             <div class="col-lg-6 col-lg-pull-6">            
              <div class="splash">
                <div class="message-filler">
                  <p class="text-justify">
                    Thank you for using TeraSystem, Inc.'s Attendance Management System!
                  </p>
                  <p class="text-justify">
                    Kindly sign in using your registered <strong> TeraMail account </strong> and enter your password.
                  </p>

                </div>
              </div>
            </div> -->

          </div>

@stop