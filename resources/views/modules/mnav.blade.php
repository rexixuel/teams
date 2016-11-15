@section('menuToggle')
	@if (!Auth::guest())
                  <button id="menu-toggle" class="btn-link navbar-brand"> 
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </button>	
    @endif
@stop

@section('navbar')
                    <li class=""> <a href="{{URL::asset('about')}}"> About </a> </li>
                    <li class=""> <a href="{{URL::asset('help')}}"> Help </a> </li>
                    <li class=""> <a href="{{URL::asset('contact')}}"> Contact </a> </li>
	@if (!Auth::guest())
                    <li class=""> <a href="{{URL::asset('logout')}}"> Log Out </a> </li>
    @endif
@stop