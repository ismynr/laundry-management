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
                <label for="name" class="col-form-label">Kategori Jasa:</label>
                <input type="text" id="edit_service_type" class="form-control" name="service_type">
                <small class="edit_error_service_type text-danger hidden"></small>
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