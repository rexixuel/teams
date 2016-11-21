@section('sidebar')
          <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <li class="sidebar-brand">
                <ul class="sidebar-user">
                  <li class="">
                    <div class="list-group">
                      <div class="list-group-item list-group-photo">
                        <div class="row-picture">
                          {{ Html::image('users/'.Auth::id().'/photo', Auth::user()->first_name, ['class' => 'circle user-photo'] )}}                          
                        </div>
                      </div>
                    </div>
                    <h2 class="text-left sidebar-user-name">
                      {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}  
                    </h2>
                    <h4 class="text-left sidebar-user-title"> {{ Auth::user()->jobDescription->job_description }} </h4>

                    <p> # of Lates for {{ Carbon\Carbon::now()->format('M') }} : 
                    @php
                      if(Auth::user()->attendances()->monthYear(Carbon\Carbon::now()->format('m'), Carbon\Carbon::now()->format('Y'))->first())
                      {
                        echo number_format(Auth::user()->attendances()->monthYear(Carbon\Carbon::now()->format('m'), Carbon\Carbon::now()->format('Y'))->aggregateLates(), 2);
                      }
                      else
                      {
                        echo 0.00;
                      }
                    @endphp
                      <br />
                      Remaining Vacation Leaves: {{ number_format(Auth::user()->rem_vl, 2) }}
                      <br />
                      Remaining Sick Leaves: {{ number_format(Auth::user()->rem_sl, 2) }}
                    </p>
                  </li>
                </ul>
              </li>            
          @if(Auth::user()->role <= 1 )
              <li> <a href="{{ URL::asset('attendances/create') }}"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Attendance </a> </li>
              <li> <a href="{{ URL::asset('notifications') }}"> <i class="fa fa-send" aria-hidden="true"></i> Send Notifications </a> </li>
              <li> <a href="{{ URL::asset('users/register') }}"> <i class="fa fa-user-plus" aria-hidden="true"></i> Employee Registration </a> </li>
              <li> <a href="{{ URL::asset('policies') }}"> <i class="fa fa-gear" aria-hidden="true"></i> Set-up Leave Policies </a> </li>
          @endif
          @if (Auth::user()->role == 2 ||  Auth::user()->role == 0 )
              <li> <a href="{{ URL::asset('leaves/approval') }}"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> Leave Approval </a> </li>
          @endif
          @if(Auth::user()->role <= 2)
              <li> <a href="{{ URL::asset('users/search') }}"> <i class="fa fa-search" aria-hidden="true"></i> View Employee Attendance </a> </li>
          @endif          
              <li> <a href="{{ URL::asset('leaves/create') }}"> <i class="fa fa-plane" aria-hidden="true"></i> File Leave </a> </li>
              <li> <a href="{{ URL::asset('attendances') }}"> <i class="fa fa-calendar" aria-hidden="true"></i> View Attendance </a> </li>
              <!-- <li> <a href="{{ URL::asset('notifications/'.Auth::id()) }}"> <i class="fa fa-envelope" aria-hidden="true"></i> View Attendance Notifications </a> </li> -->
            </ul>
<!--             <footer class="">
              <ul class="sidebar-nav sidebar-footer">
                <li class=""> <a href="about"> About </a> </li>
                <li class=""> <a href="help"> Help </a> </li>
                <li class=""> <a href="contact"> Contact </a> </li>
              </ul>
            </footer> -->
          </div>        
@stop
