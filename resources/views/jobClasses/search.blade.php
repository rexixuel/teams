@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Job Classes - Search </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Job Classes'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Search Job Classes', 'operDescription' => 'Search for job classes.'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('jobclasses/browse') }}">
                    {{ csrf_field() }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    
                    <fieldset>
                          @include('modules.searchDescription')
                          @include('modules.submitField', ['field' => 'Search'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')