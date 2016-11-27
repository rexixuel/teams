@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Job Class  - Edit </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Job Classes'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Edit', 'operDescription' => 'Set-up Job Class and associated benefit'])
              {{ Form::model($jobClass, ['action' => ['JobClassesController@update',$jobClass->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        <a href="{{ url('jobclasses/search') }}"> Edit another job class? </a>
                    @endif
              <fieldset>
              <legend> <small> Go to Benefit Package: <a href="{{ url('benefits/'.$jobClass->benefits->id.'/edit')}}" > {{$jobClass->benefits->benefit_description}} </a> </small></legend>              
                @include('modules.jobClassesForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Edit'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')