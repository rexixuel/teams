@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Benefit  - Create </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Benefits'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Create', 'operDescription' => 'Set-up benefit packages'])
              {{ Form::open(['url' => 'benefits', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
              <fieldset>
                @include('modules.benefitsForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Create'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')