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
              <label for="name" class="col-form-label">Deskripsi:</label>
              <textarea name="deskripsi" id="edit_deskripsi" cols="30" rows="5" class="form-control"></textarea>
              <small class="edit_error_deskripsi text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Harga:</label>
              <input type="text" id="edit_harga" class="form-control" name="harga">
              <small class="edit_error_harga text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Catatan:</label>
              <input type="text" id="edit_catatan" class="form-control" name="catatan" placeholder="Optional">
              <small class="edit_error_catatan text-danger hidden"></small>
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