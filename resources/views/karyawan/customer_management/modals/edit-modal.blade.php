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
            <div class="form-group">
              <label for="name" class="col-form-label">Nama Customer:</label>
              <input type="text" id="edit_name" class="form-control" name="name">
              <small class="edit_error_name text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Alamat:</label>
            <textarea name="alamat" id="edit_alamat" class="form-control" cols="30" rows="5"></textarea>
            <small class="edit_error_alamat text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">No HP:</label>
            <input type="text" id="edit_telephone" class="form-control" name="telephone">
            <small class="edit_error_telephone text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Gender:</label>
            <select name="gender" id="edit_gender" class="form-control">
              <option value="laki-laki">Laki laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
            <small class="edit_error_gender text-danger hidden"></small>
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