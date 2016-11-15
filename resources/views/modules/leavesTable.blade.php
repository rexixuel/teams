								<td> {{ $leave->created_at->format('M d, Y') }} </td>
								@if($leave->num_days < 1)
									<td> {{ ($leave->num_days * 8) }} hours </td>
								@else
									<td> {{ number_format($leave->num_days) }} days</td>
								@endif
								<td> {{ $leave->start_date->format('M d, Y') }}</td>
								<td> {{ $leave->leaveTypes->leave_description}}</td>
								<td> {{ $leave->reason }}</td>
								<td> {{ $leave->status }}</td>
								@if(Request::is('*/approval'))
									<td class="text-center btn-group-sm"> <a class="btn btn-primary btn-fab" alt="Proceed to approval" href="{{ URL::asset('leaves/'.$leave->id.'/review')}}"> <i class="material-icons">gavel</i> </a> </td>
								@else
									<td class="text-left btn-group-sm"> <a class="btn btn-primary btn-fab" alt="Proceed to approval" href="{{ URL::asset('leaves/'.$leave->id)}}"> <i class="material-icons">pageview</i> </a> </td>
									@if( $leave->status == 'Approved' && !Request::is('leaves/approval/*'))
									<td class="text-left btn-group-sm"> <button class="btn btn-primary btn-fab" alt="Revoke/Cancel leave" type="button" data-toggle="modal" data-target="#revoke-modal" data-url = "{{ $revokeUrl }}"> <i class="material-icons">remove_circle_outline</i> </button> </td>
									@else
									<td> </td>		
									@endif
								@endif

