						  @if(Auth::user()->role < 2)
						  
						  <td class="btn-group-sm"> <a class="text-center btn btn-primary btn-fab" alt="Update user" href="{{ URL::asset($url)}}"> <i class="material-icons">edit</i> </a> </td>
						  <!-- use modules for this one -->
						  @if(Request::is('users/*'))
							<td class="text-left btn-group-sm"> <button class="btn btn-primary btn-fab" alt="Delete user" type="button" data-toggle="modal" data-target="#delete-modal" data-url = "{{ $deleteUrl }}"> <i class="material-icons">delete</i> </button> </td>
						  @endif
						  @endif