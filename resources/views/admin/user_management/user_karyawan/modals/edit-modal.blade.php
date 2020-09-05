<!-- EDIT ITEM MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="editData" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-info">
          <h5 class="modal-title text-white" id="editData">Edit Data</h5>
        </div>
        <div class="modal-body">
          <form id="editForm">
            {{ csrf_field() }}
            <input type="hidden" id="edit_id" name="id">
            <input type="hidden" name="role" value="karyawan">
            <div class="form-group">
                <label for="name" class="col-form-label">Nama Karyawan:</label>
                <input type="text" id="edit_name" class="form-control" name="name">
                <small class="edit_error_name text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" id="edit_email" class="form-control" name="email">
              <small class="edit_error_email text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password: <small class="text-danger">*Kosongkan jika tidak ingin diganti</small></label>
              <input type="password" id="edit_password" class="form-control" name="password">
              <small class="edit_error_password text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-form-label">Password Confirmation:</label>
              <input type="password" id="edit_password_confirmation" class="form-control" name="password_confirmation">
              <small class="edit_error_password_confirmation text-danger hidden"></small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="updateBtn" class="btn btn-gradient-info" >Ubah</button>
            </form>
        </div>
      </div>
    </div>
  </div>