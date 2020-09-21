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
                <label for="name" class="col-form-label">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
                <small class="error_deskripsi text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Harga:</label>
              <input type="text" id="harga" class="form-control" name="harga">
              <small class="error_harga text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Catatan:</label>
              <input type="text" id="catatan" class="form-control" name="catatan" placeholder="Optional">
              <small class="error_catatan text-danger hidden"></small>
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