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
                <label for="name" class="col-form-label">Kategori Jasa:</label>
                <input type="text" id="service_type" class="form-control" name="service_type">
                <small class="error_service_type text-danger hidden"></small>
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