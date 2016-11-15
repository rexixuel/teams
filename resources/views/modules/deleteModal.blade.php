<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-warning">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">DELETE <span id="userForDeletion"> </span> </h4>
      </div>
      <div class="modal-body">
        <p>You are about to delete an employee from the system. All related attendances and leaves shall be removed as well. Are you sure? <br /> <br />
          <small> Employee shall be notified of their removal from the system </small>
        </p>

      </div>
      <div class="modal-footer">
      {{ Form::model($users, ['method' => 'DELETE', 'class' => 'form-horizontal', 'id' => 'delete-modal-form']) }}
        {{-- Form::hidden('id',null,['class' => 'form-control', 'id' => 'leave-id', 'readonly']) --}}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Delete</button>
      {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->