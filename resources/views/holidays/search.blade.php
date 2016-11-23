@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Holidays - Search </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Holidays'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Search Holidays', 'operDescription' => 'Search for holidays.'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('holidays/browse') }}">
                    {{ csrf_field() }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif                    
                    <fieldset>

                      <div class="form-group {{ $errors->has('search') ? ' has-error' : '' }}">
                        <label for="search_description" class="col-md-2 control-label"> Search Description </label>
                         <div class="col-md-10">                         
                          <input type="text" id="search" name="search_description" class="form-control" 
                          value="{{ old('search_description') }}"/>

                          @include('modules.errorField', ['field' => 'search_description'])
                        </div>
                      </div>                                    
                        <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                          {{ Form::label('start_date', 'Start Date:', ['class' => 'col-md-2 control-label'])}}
                          <div class="col-md-10">
                                    <div class="input-group date" id="start-date-form">
                                      <span class="input-group-addon glyphicon glyphicon-calendar"></span> 
                                        {{ Form::text('start_date',old('start_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::now()->format('m/d/Y'), 'id' => 'start-date']) }}
                                    </div>
                            <span id="helpBlock" class="help-block"> Start of holiday. This field is required. Must be less than end date.</span>                                       
                            @if ($errors->has('start_date'))
                              @foreach ($errors->get('start_date') as $error)
                              <p class="alert alert-danger" id="start-date-error" data-value = "" >
                                {{ $error }}
                              </p>
                              @endforeach
                            @endif                      
                          </div>
                        </div>          

                        <div class="form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                          {{ Form::label('end_date', 'End Date:', ['class' => 'col-md-2 control-label'])}}
                          <div class="col-md-10">
                                    <div class="input-group date" id="end-date-form">
                                      <span class="input-group-addon glyphicon glyphicon-calendar"></span> 
                                        {{ Form::text('end_date',old('end_date'),['class' => 'form-control', 'placeholder' => Carbon\Carbon::tomorrow()->format('m/d/Y'), 'id' => 'end-date']) }}
                                    </div>
                            <span id="helpBlock" class="help-block"> End of holiday. This field is required. Must be greater than or equal to start date.</span>                  
                            @if ($errors->has('end_date'))
                              @foreach ($errors->get('end_date') as $error)
                              <p class="alert alert-danger" id="end-date-error" data-value = "" >
                                {{ $error }}
                              </p>
                              @endforeach
                            @endif                                  
                          </div>
                        </div>                                  
                          @include('modules.submitField', ['field' => 'Search'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')
