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
              <label for="name" class="col-form-label">Nama Paket:</label>
              <input type="text" id="edit_nama_paket" class="form-control" name="nama_paket">
              <small class="edit_error_nama_paket text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Tipe Berat:</label>
            <input type="text" id="edit_tipe_berat" class="form-control" name="tipe_berat">
            <small class="edit_error_tipe_berat text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Harga Per Berat:</label>
            <input type="text" id="edit_harga" class="form-control" name="harga">
            <small class="edit_error_harga text-danger hidden"></small>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Jasa:</label>
            <select class="select2_id_service form-control select2" id="edit_id_service" name="id_service"></select>
            <small class="edit_error_id_service text-danger hidden"></small>
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