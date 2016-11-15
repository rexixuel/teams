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
      <link rel="stylesheet" href="dist/css/font-awesome.css" />
      <link rel="stylesheet" href="dist/css/ripples.min.css" />
      <link rel="stylesheet" href="dist/css/simple-sidebar.css" />
      <link rel="stylesheet" href="dist/css/teams.css" />
      <title> @yield('titlePage') </title>
    </head>

    <body class="">
      <div class="container-fluid">      
        <div id="wrapper">
          <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <li class="sidebar-brand">
                <ul class="sidebar-user">
                  <li>
                    <img src='node_modules/material-design-icons/av/2x_web/ic_recent_actors_white_36dp.png' />
                    <h2 class="text-left sidebar-user-name">
                      {{ user }}  
                    </h2>
                    <h4 class="text-left sidebar-user-title"> {{ user-job-title }} </h4>

                    <p> # of Lates for ({{ month }}) : 10 
                      <br />
                      Remaining Vacation Leaves: 10 
                      <br />
                      Remaining Sick Leaves: 10 
                    </p>
                  </li>
                </ul>
              </li>            
              <li> <a href=""> <i class="fa fa-plane" aria-hidden="true"></i> File Leave </a> </li>
              <li> <a href=""> <i class="fa fa-calendar-o" aria-hidden="true"></i> View Attendance </a> </li>
              <li> <a href=""> <i class="fa fa-envelope-o" aria-hidden="true"></i> Notifications </a> </li>                    
            </ul>
<!--             <footer class="">
              <ul class="sidebar-nav sidebar-footer">
                <li class=""> <a href="about"> About </a> </li>
                <li class=""> <a href="help"> Help </a> </li>
                <li class=""> <a href="contact"> Contact </a> </li>
              </ul>
            </footer> -->
          </div>        
          <header class="row bs-component">
            <nav class="navbar navbar-default navbar-fixed-top navbar-dropshadow">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="glyphicon glyphicon-option-horizontal"></span>
                  </button>
                  <a href="#" id="menu-toggle" class="navbar-brand"> 
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </a>                
                  <a class="navbar-brand text-center" href="#">T.E.A.M.S.</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li class=""> <a href="about"> About </a> </li>
                    <li class=""> <a href="help"> Help </a> </li>
                    <li class=""> <a href="contact"> Contact </a> </li>
                    <li class=""> <a href="logout"> Log Out </a> </li>
                  </ul>
                </div>
              </div>          
            </nav>
          </header>

          <section class="main">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h1 class="titlepage"> @yield('titlePage') </h1>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="card l-card"> 
                  <form class="form-horizontal">
                    <fieldset>
                      <legend>@yield('formTitle')</legend>
                      <div class="form-group">
                        <label for="first-name" class="col-md-2 control-label"> First Name </label>
                        <div class="col-md-10">
                          <input id="first-name" type="text" class="form-control" placeholder="Juan">
                        </div>
                      </div>       

                      <div class="form-group">
                        <label for="last-name" class="col-md-2 control-label"> Last Name </label>

                        <div class="col-md-10">
                          <input id="last-name" type="text" class="form-control" placeholder="dela Cruz">
                        </div>
                      </div>                  

                      <div class="form-group">
                        <label for="teramail" class="col-md-2 control-label"> TeraMail </label>
                        <div class="col-md-10">
                          <input id="teramail" type="email" class="form-control" placeholder="user@teramail.com">
                        </div>
                      </div>                  

                      <div class="form-group">
                        <label for="job-class" class="col-md-2 control-label"> Job Class </label>
                         <div class="col-md-10">
                          <select id="job-class" class="form-control">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                            <option>E</option>
                            <option>F</option>
                            <option>G</option>
                            <option>H</option>
                            <option>I</option>
                          </select>
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="job-class-description" class="col-md-2 control-label"> Job Class Description </label>
                         <div class="col-md-10">
                          <input id="job-class-description" type="text" class="form-control" disabled="">
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="job-description" class="col-md-2 control-label"> Job Description </label>
                         <div class="col-md-10">
                          <select id="job-description" class="form-control">
                            <option>Programmer Trainee</option>
                            <option>Junior Programmer</option>
                            <option>Analyst Programmer</option>
                          </select>
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="immediate-supervisor" class="col-md-2 control-label"> Supervisor </label>
                         <div class="col-md-10">
                          <select id="immediate-supervisor" class="form-control">
                            <option>Mike Uy</option>
                            <option>Richard Te</option>
                            <option>Meanne Bautista</option>
                          </select>
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="max-vacation-leaves" class="col-md-2 control-label"> Max Vacation Leaves </label>
                         <div class="col-md-3">
                          <input id="max-vacation-leaves" type="text" class="form-control" size="3" />
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <label for="max-sick-leaves" class="col-md-2 control-label"> Max Sick Leaves </label>
                         <div class="col-md-3">
                          <input id="max-sick-leaves" type="text" class="form-control" length="3" />
                        </div>
                      </div>                                    

                      <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                          <button type="button" class="btn btn-raised btn-default">Cancel</button>
                          <button type="submit" class="btn btn-raised btn-primary">Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>   
          </section>                         
        </div>             
        <footer class="row footer-main">
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

        $("#menu-toggle").click(function(e) {                           
            $("#wrapper").toggleClass("toggled");              
        });          
      </script>
    </body>
</html>