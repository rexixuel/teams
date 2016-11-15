@extends('layouts.app',[
      'bodyClass' => '',
          'containerClass' => '',
          'divWrapperId' => 'wrapper',
          'footerClass' => 'footer-main'
          ]
      )

@section('titlePage')
  <title> Attendances - Upload </title>
@stop

@include('modules.mnav')

@if(!Auth::guest())
  @include('modules.sidebar')
@endif

@section('content')
          <section class="main">
            @include('modules.titlearea', ['page' => '','titlepage' => 'Attendances'])
            <div class="card l-card">
              @include('modules.cardOperation', ['operation' => 'Upload Attendance', 'operDescription' => 'Upload extracted attendance logs from biometric scanner.'])
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/attendances') }}">
                    {{ csrf_field() }}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>                    
                    @endif                    
                    <fieldset>

                      <div class="form-group {{ $errors->has('attendance_log') ? ' has-error' : '' }}">
                        <label for="attendance-log" class="col-md-2 control-label"> Attendance Log </label>
                         <div class="col-md-10">
                         <input readonly="" class="form-control" placeholder="Browse..." type="text">
                          <input id="attendance-log" name="attendance_log" type="file" accept="txt,csv" class="form-control" 
                          value="{{ old('attendance_log') }}"/>

                          @include('modules.errorField', ['field' => 'attendance_log'])
                        </div>
                      </div>                                    
                          @include('modules.submitField', ['field' => 'Upload'])
                    </fieldset>
                  </form>
              </div>  
          </section>                         
@stop

@include('modules.sidebarScript')