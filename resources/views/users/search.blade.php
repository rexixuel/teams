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

                      <div class="form-group {{ $errors->has('search_first_name') ? ' has-error' : '' }}">
                        <label for="search_first_name" class="col-md-2 control-label"> Search First Name </label>
                         <div class="col-md-10">                         
                          <input type="text" id="search-first" name="search_first_name" class="form-control" 
                          value="{{ old('search_first_name') }}"/>

                          @include('modules.errorField', ['field' => 'search_first_name'])

                        </div>
                      </div>                                    
                      <div class="form-group {{ $errors->has('search_last_name') ? ' has-error' : '' }}">
                        <label for="search_last_name" class="col-md-2 control-label"> Search Last Name </label>
                         <div class="col-md-10">                         
                          <input type="text" id="search-last" name="search_last_name" class="form-control" 
                          value="{{ old('search_last_name') }}"/>

                          @include('modules.errorField', ['field' => 'search_last_name'])                          
                        </div>
                      </div>                                                          

                      <div class="form-group {{ $errors->has('search_emp_number') ? ' has-error' : '' }}">
                        <label for="search_emp_number" class="col-md-2 control-label"> Search Employee Number </label>
                         <div class="col-md-10">                         
                          <input type="text" id="emp-num" name="search_emp_number" class="form-control" 
                          value="{{ old('search_last_name') }}" placeholder="0000" />

                          @include('modules.errorField', ['field' => 'search_last_name'])                          
                        </div>
                      </div>                                                                                
                          @include('modules.submitField', ['field' => 'Search'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')