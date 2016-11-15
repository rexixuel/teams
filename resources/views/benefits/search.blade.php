@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Benefits - Search </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Benefits'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Search Benefits', 'operDescription' => 'Search for benefit packages.'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('benefits/browse') }}">
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