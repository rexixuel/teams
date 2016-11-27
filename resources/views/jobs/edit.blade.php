@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Job Description - Edit </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Job Description'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Edit', 'operDescription' => 'Change a job description\'s associated job class'])
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        <a href="{{ url('jobs/search') }}"> Edit another job description? </a>
                    @endif              
              {!! Form::model($jobDescription, ['action' => ['JobsController@update',$jobDescription->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) !!}
              <legend> <small> Go to Job Class: <a href="{{ url('jobclasses/'.$jobDescription->jobClasses->id.'/edit')}}" > {{$jobDescription->jobClasses->job_class_description}} </a> </small></legend>
              <fieldset>
                @include('modules.jobsForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Update'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')