		<div class="row l-titlearea">
		  @if(Request::is('leaves') || Request::is('home') || Request::is('/') || Request::is('attendances') || Request::is('users/*/attendances') || Request::is('leaves/approval/*'))
		  <div class="col-md-5">
	  	    @if (Request::is('users/*/attendances') || Request::is('leaves/approval/*'))
				<legend class="titlepage text-left"> {{ $user->first_name }} {{ $user->last_name }} </legend>	  	    
	  	    @else
				<ul class="nav nav-pills">
			  	  <li role="presentation" class="{{$attendancesActive}}"><a href="{{url('attendances')}}"> Attendances </a></li>
				  <li role="presentation" class="{{$leavesActive}}"><a href="{{url('leaves')}}"> Leaves </a></li>
				</ul>
			@endif
		  </div>
		  <div class="col-md-7">
		  	<h1 class="titlepage text-right"> {{ $titlepage }}</h1>
		  </div>
		  @else
			  <div class="col-md-12">			
			  	<h1 class="titlepage text-right"> {{ $titlepage }} </h1>
			  </div>		  		  
		  @endif
		</div>
