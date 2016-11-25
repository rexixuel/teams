@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Contact </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['titlepage' => 'Contact'])
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
            	<p>
            		<p class="lead"> You may reach the developer at: </p>
            		<address>
            			<strong> Mark Reuel Cabal </strong> <br/>
            			<strong> E-mail: </strong> <a href="{{ url('mailto:markreuel.cabal@gmail.com')}}"> markreuel.cabal@gmail.com </a> <br/>
            			<strong> Facebook: </strong> <a href="{{ url('https://www.facebook.com/markreuel.cabal')}}"> Mark Reuel Cabal </a>

            		</address>
            	</p>
              </div>
            </div>  
          </section>                         
@stop