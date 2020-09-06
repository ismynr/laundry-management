<!-- ADD ITEM MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="addData" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary">
          <h5 class="modal-title text-white" id="addData">Add Data</h5>
        </div>
        <div class="modal-body">
          <form id="addForm">
            {{ csrf_field() }}
            <input type="hidden" name="role" value="admin">
            <div class="form-group">
                <label for="name" class="col-form-label">Nama Admin:</label>
                <input type="text" id="name" class="form-control" name="name">
                <small class="error_name text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" id="email" class="form-control" name="email">
              <small class="error_email text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" id="password" class="form-control" name="password">
              <small class="error_password text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-form-label">Password Confirmation:</label>
              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
              <small class="error_password_confirmation text-danger hidden"></small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="storeBtn" class="btn btn-gradient-primary" >Ubah</button>
            </form>
        </div>
      </div>
    </div>
  </div>