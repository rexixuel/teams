@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Job Class  - Create </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Job Classes'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Create', 'operDescription' => 'Set-up Job Class and associated benefit'])
              {{ Form::open(['url' => 'jobclasses', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
              <fieldset>
                @include('modules.jobClassesForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Create'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')