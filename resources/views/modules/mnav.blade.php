@section('menuToggle')
	@if (!Auth::guest())
                  <button id="menu-toggle" class="btn-link navbar-brand l-menu">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <span class="l-nav-name nav-name"> {{Auth::user()->first_name}} {{Auth::user()->last_name}} </span>
                    
                  </button>	
    @endif
@stop

@section('userSection')
  @if (!Auth::guest())
                  <ul class="nav navbar-nav">
                    <li class=""> </li>
                  </ul>              
    @endif
@stop

@section('navbar')
                    <li class=""> <a href="{{URL::asset('about')}}"> About </a> </li>
                    <li class=""> <a href="{{URL::asset('https://docs.google.com/document/d/1i0bTTbbd4SNg2p8B5Vin-p9tQnOEdMSjFJRz0q9nX1g/edit?usp=sharing')}}"> Help </a> </li>
                    <li class=""> <a href="{{URL::asset('contact')}}"> Contact </a> </li>
	@if (!Auth::guest())
                    <li class=""> <a href="{{URL::asset('logout')}}"> Log Out </a> </li>
    @endif
@stop