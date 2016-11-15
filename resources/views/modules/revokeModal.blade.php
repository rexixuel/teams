<div class="modal fade" tabindex="-1" role="dialog" id="revoke-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-warning">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Revoking APPROVED leave</h4>
      </div>
      <div class="modal-body">
        <p>You are about to revoke your approved leave. You will have to file for a new leave if you need to adjust the dates. Are you sure? <br /> <br />
          <small> You're supervior and HR personnel shall be notified to adjust your leaves </small>
        </p>

      </div>
      <div class="modal-footer">
      {{ Form::model($leaves, ['method' => 'PATCH', 'class' => 'form-horizontal', 'id' => 'revoke-modal-form']) }}
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Revoke</button>
      {{ Form::close() }}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->