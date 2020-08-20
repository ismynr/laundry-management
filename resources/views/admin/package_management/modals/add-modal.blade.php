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
            <div class="form-group">
                <label for="name" class="col-form-label">Nama Paket:</label>
                <input type="text" id="nama_paket" class="form-control" name="nama_paket">
                <small class="error_nama_paket text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Tipe Berat:</label>
              <input type="text" id="tipe_berat" class="form-control" name="tipe_berat">
              <small class="error_tipe_berat text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Harga Per Berat:</label>
              <input type="text" id="harga" class="form-control" name="harga">
              <small class="error_harga text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Jasa:</label>
              <select class="select2_id_service form-control select2" id="id_service" name="id_service"></select>
              <small class="error_id_service text-danger hidden"></small>
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