<!-- SAVE ITEM MODAL -->
<div class="modal fade" id="saveKaryawanModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="saveKaryawanData" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-warning">
          <h5 class="modal-title text-white" id="saveKaryawanData">Data Karyawan</h5>
        </div>
        <div class="modal-body">
          <form id="saveKaryawanForm">
            {{ csrf_field() }}
            <input type="hidden" id="save_action" name="action">
            <input type="hidden" id="save_id" name="id">
            <input type="hidden" id="save_id_user" name="id_user">
            <div class="form-group">
                <label for="name" class="col-form-label">Alamat:</label>
                <textarea name="alamat" id="save_alamat" class="form-control" cols="30" rows="5"></textarea>
                <small class="error_alamat text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="telephone" class="col-form-label">Telephone:</label>
              <input type="text" name="telephone" id="save_telephone" class="form-control">
              <small class="error_telephone text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Gender:</label>
              <select name="gender" id="save_gender" class="form-control">
                <option value="laki-laki">Laki laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
              <small class="error_gender text-danger hidden"></small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveKaryawanBtn" class="btn btn-gradient-warning" >Save</button>
            </form>
        </div>
      </div>
    </div>
  </div>