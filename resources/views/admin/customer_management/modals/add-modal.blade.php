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
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="name" class="col-form-label">Nama Customer:</label>
                <input type="text" id="name" class="form-control" name="name">
                <small class="error_name text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Alamat:</label>
              <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5"></textarea>
              <small class="error_alamat text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">No HP:</label>
            <input type="text" id="telephone" class="form-control" name="telephone">
            <small class="error_telephone text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Gender:</label>
            <select name="gender" id="gender" class="form-control">
              <option value="laki-laki">Laki laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
            <small class="error_gender text-danger hidden"></small>
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