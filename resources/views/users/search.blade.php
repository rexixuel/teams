@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Employee - Search </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Employees'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Search Employees', 'operDescription' => 'Search employees and view their attendances.'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('users/browse') }}">
                    {{ csrf_field() }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    
                    <fieldset>

                      <div class="form-group {{ $errors->has('search') ? ' has-error' : '' }}">
                        <label for="search_name" class="col-md-2 control-label"> Search Name </label>
                         <div class="col-md-10">                         
                          <input type="text" id="search" name="search_name" class="form-control" 
                          value="{{ old('search_name') }}"/>

                          @include('modules.errorField', ['field' => 'search_name'])
                        </div>
                      </div>                                    
                          @include('modules.submitField', ['field' => 'Search'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')