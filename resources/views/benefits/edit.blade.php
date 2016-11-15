@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Benefit  - Edit </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Benefits'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Edit', 'operDescription' => 'Set-up benefit packages'])
              {{ Form::model($benefit, ['action' => ['BenefitsController@update',$benefit->id], 'method' => 'PATCH', 'class' => 'form-horizontal']) }}

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
              <fieldset>
                @include('modules.benefitsForm', ['disabled' => '', 'readonly' => ''])
                @include('modules.submitField', ['field' => 'Update'])
              </fieldset>
              
              {{ Form::close()}}
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')