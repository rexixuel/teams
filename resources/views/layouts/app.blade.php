<!DOCTYPE html >
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <!-- Material Design fonts -->
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Yanone+Kaffeesatz"> 
      <link rel="stylesheet" href="{{ URL::asset('/node_modules/bootstrap/dist/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('/dist/css/bootstrap-material-design.min.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('/dist/css/font-awesome.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('/dist/css/ripples.min.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('/dist/css/simple-sidebar.css') }}" />

      <link rel="stylesheet" href="{{ URL::asset('/dist/css/teams.css') }}" />
      <link rel="stylesheet" href="{{ URL::asset('/dist/css/bootstrap-material-datetimepicker.css') }}" />

      <script src="{{ URL::asset('/node_modules/jquery/dist/jquery.min.js') }}" type="text/javascript"> </script>
      <script src="{{ URL::asset('/node_modules/jquery/dist/underscore.j') }}s" type="text/javascript"> </script>
      <script src="{{ URL::asset('/node_modules/jquery/dist/moment/moment.js') }}" type="text/javascript"> </script>
      <script src="{{ URL::asset('/node_modules/jquery/dist/moment-range.js') }}" type="text/javascript"> </script>
      <script src="{{ URL::asset('/node_modules/jquery/dist/clndr.js') }}" type="text/javascript"> </script>
      <script type="text/javascript" src="{{ URL::asset('/dist/js/teams.js') }}"></script>
      <script src="{{ URL::asset('/dist/js/teams-clndr.js') }}" type="text/javascript"></script>      
      @yield('titlePage')

    </head>

    <body class = "{{ $bodyClass }}">
      <div class="container-fluid {{ $containerClass }}">
        <div id="{{ $divWrapperId }}" class="toggled">      
          @yield('sidebar')
          <header class="row bs-component">
            <nav class="navbar navbar-default navbar-fixed-top navbar-dropshadow">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="glyphicon glyphicon-option-horizontal"></span>
                  </button>
                  @yield('menuToggle')
                  <a class="navbar-brand text-center teams-brand l-teams-brand" href="/"> T E A M:S </a>
                  
                </div>

                
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav navbar-right">
                    @yield('navbar')
                  </ul>
                </div>
              </div>          
            </nav>
          </header>

          <section class="main">
            @yield('content')
          </section>
        </div>
        <footer class="row {{ $footerClass }}">
          <div class="col-xs-4">
             <p class="text-left footer-text"> Copyright <i class="glyphicon glyphicon-copyright-mark"> </i>  Cabal, Mark Reuel <br />
            IS295B
            </p> 
            <div class="clear"> </div>
          </div>
          <div class="col-xs-8">
            <p class="text-right footer-text"> <i class="glyphicon glyphicon-copyright-mark"> </i> <a href="http://terasystem.com"> TeraSystem, Inc. </a> Employee Attendance Management System <br />
             All Rights Reserved </p>

            <div class="clear"> </div>
          </div>          
        </footer>
      </div>
      <script src="{{ URL::asset('/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"> </script>      
      <script src="{{ URL::asset('/node_modules/bootstrap/dist/js/npm.js') }}"> </script>
      <script src="{{ URL::asset('/dist/js/material.min.js') }}"> </script>
      <script src="{{ URL::asset('/dist/js/ripples.min.js') }}"> </script>              
      <script src="{{ URL::asset('/dist/js/ripples.min.js') }}"> </script>              
      <script src="{{ URL::asset('/dist/js/bootstrap-material-datetimepicker.js') }}"></script>
      <script src="{{ URL::asset('/dist/js/jquery.maskedinput.min.js') }}"></script>
      <script>
        $.material.init();
        @if(!Auth::guest())
            @yield('sidebarScript')
        @endif
      </script>
    </body>
</html> 
