@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Job Description - Create </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Job Description'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Create', 'operDescription' => 'Set-up job description and set its job class and leave benefit'])
              {{ Form::open(['url' => 'jobs', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
              <fieldset>
                @include('modules.jobsForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Create'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')