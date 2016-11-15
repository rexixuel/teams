
@extends('app')

@section('title')
	Contact Dev - T.E.A.M.S.
@stop

@section('content')
	<h1> Contact Me </h1>

	@if(count($devs))
		<h2> Meet the Team </h2>
		<ul>
			@foreach($devs as $dev)

				<li> {{ $dev }} </li>
			@endforeach
		</ul>
	@endif
@stop

@section('footer')
	<div> some footer </div>
@stop