<!-- TABLE PICK TOTAL PRINT MARK MODAL -->
<div class="modal fade" id="printMarkModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="printMarkData" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 500px;" role="document">
    <div class="modal-content bg-white">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title text-white" id="printMarkData">Tentukan Jumlah Tanda Yang Akan Dicetak</h5>
      </div>
      <form action="{{ route('admin.transactions.invoice.mark', $transaction->id) }}" method="post" target="_blank">
        {{ csrf_field() }}
        <div class="modal-body">
          <table class="table table-responsive table-hover data-table dataTable" id="table-print-mark">
            <thead>
              <tr>
                <th> # </th>
                <th> Nama Paket </th>
                <th width="10%"> Qty </th>
                <th width="15%"> Harga </th>
                <th> Jml Cetak </th>
              </tr>
            </thead>
              <tbody> </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="storeBtn" class="btn btn-gradient-success">Print</button>
        </div>
      </form>
    </div>
  </div>
</div>