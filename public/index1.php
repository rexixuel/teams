<!DOCTYPE html >
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Material Design fonts -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="dist/css/bootstrap-material-design.min.css" />
        <link rel="stylesheet" href="dist/css/teams.css" />
        <title> T.E.A.M.S. </title> <!-- @yield('titlePage')--> 
    </head>

    <body class="landing-page">
      <div class="container-fluid landing-cover">
        <header class="row bs-component">
          <nav class="navbar navbar-default navbar-fixed-top teams-navbar-shadow">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                  <span class="glyphicon glyphicon-option-horizontal"></span>
                </button>
                <a class="navbar-brand" href="#">T.E.A.M.S.</a>
              </div>
              <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li class=""> <a href="about"> About </a> </li>
                  <li class=""> <a href="help"> Help </a> </li>
                  <li class=""> <a href="contact"> Contact </a> </li>
                </ul>
              </div>
            </div>          
          </nav>
        </header>
        <section class="main">
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
            <div class="col-lg-6 col-lg-pull-6">            
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
            </div>

          </div>
        </section>

        <footer class="row footer-landing">
          <div class="col-xs-4">
            <p class="text-left footer-text"> <i class="glyphicon glyphicon-copyright-mark"> </i>  Cabal, Mark Reuel <br />
            IS295B
            </p> 
            <div class="clear"> </div>
          </div>
          <div class="col-xs-8">
            <p class="text-right footer-text"> <a href="http://terasystem.com"> <i class="glyphicon glyphicon-copyright-mark"> </i>  TeraSystem, Inc. </a> Employee Attendance Management System <br />
             All Rights Reserved </p>

            <div class="clear"> </div>
          </div>          
        </footer>
      </div>

      <script src="node_modules/jquery/dist/jquery.min.js"> </script>
      <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"> </script>
      <script src="node_modules/bootstrap/dist/js/npm.js"> </script>
      <script src="dist/js/material.min.js"> </script>
      <script src="dist/js/ripples.min.js"> </script>              
      <script type="text/javascript" src="teams.js"></script>

      <script>
        $.material.init();
      </script>
    </body>
</html>