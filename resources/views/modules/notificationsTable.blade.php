								<td> {{ $notification->attendance->attendance_date->format('M d, Y') }} </td>
								<td> {{ $notification->user->first_name }} {{ $notification->user->last_name }}</td>
								<td> {!! str_limit($notification->message,35) !!} </td>
								<td> {{ $notification->mailed_status }}</td>

								<td class="text-left btn-group-sm"> <a class="btn btn-primary btn-fab" alt="Proceed to approval" href="{{ URL::asset('notifications/'.$notification->id)}}"> <i class="material-icons">mail</i> </a></td>
								
								@if(Request::is('notifications'))
									<td class="text-left btn-group-sm"> <a class="btn btn-primary btn-fab" alt="Send this notification" href="{{ URL::asset('notifications/'.$notification->id.'/send')}}"> <i class="material-icons">send</i> </a> </td>
								@endif

