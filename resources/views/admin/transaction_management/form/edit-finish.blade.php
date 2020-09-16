@extends('layouts.app')

@section('title', 'Create Transaction Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Edit Transactions </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          <button class="btn btn-rounded btn-gradient-danger btn-sm float-left" onclick="window.history.go(-1); return false;">
            <i class="mdi mdi-keyboard-backspace"></i>
          </button>
          <center><h4 class="mr-5 mt-1"><b>Transaksi</b></h4></center>
        </div>
        <div class="card-body">
          @if (\Session::has('success'))
            <div class="alert alert-success text-center">{{ \Session::get('success') }}</div>
          @elseif(\Session::has('error'))
            <div class="alert alert-danger text-center">{{ \Session::get('error') }}</div>
          @endif

            <table class="table table-borderless">
                <tr>
                    <th class="text-right" width="40%">Kode Transaksi</th>
                    <th class="text-center" width="20%">:</th>
                    <td width="40%">{{ $transaction->code }}</td>
                </tr>
                <tr>
                    <th class="text-right">Customer</th>
                    <th class="text-center">:</th>
                    <td>{{ $transaction->customer->name }}</td>
                </tr>
                <tr>
                    <th class="text-right">Dibuat pada</th>
                    <th class="text-center">:</th>
                    <td>{{ $transaction->start_date }}</td>
                </tr>
                <tr>
                    <th class="text-right">Status Transaksi</th>
                    <th class="text-center">:</th>
                    <td><span class="badge badge-danger">Selesai</span> Pada {{ $transaction->end_date }}</td>
                </tr>
            </table>
            <table class="table table-borderless">
                <tr>
                    <th class="text-left">Pembuat Transaksi</th>
                    <td class="text-right">{{ $transaction->user->name }}</td>
                </tr>
            </table>
            <button class="btn btn-light float-right mr-2">
              <i class="mdi mdi-printer"></i> Cetak Kuitansi
            </button>
            <button onclick="as()" class="btn btn-light float-right mr-2">
              <i class="mdi mdi-file-document"></i> Cetak Transaksi
            </button>
            <button class="btn btn-light float-right mr-2" disabled>
              <i class="mdi mdi-check"></i> Klaim Transaksi selesai
            </button>
        </div>
      </div>
    </div>
    <div class="col-lg-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          <center><h4><b>List Item Transaksi</b></h4></center>
        </div>
        <div class="card-body">
          <table class="table data-table dataTables">
            <thead>
              <tr>
                <th> # </th>
                <th> Package </th>
                <th width="15%"> Qty </th>
                <th width="25%"> Harga </th>
                <th width="15%"> Status </th>
              </tr>
            </thead>
            <tbody>
              @php 
                $no = 1; 
                $total_harga = 0;
              @endphp
              @foreach ($transaction->transactionDetail as $item)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->package->nama_paket }}</td>
                    <td>{{ $item->qty . ' ' . $item->package->tipe_berat }}</td>
                    <td>{{ FormatHelp::rupiah($item->harga) }}</td>
                    @php $total_harga += $item->harga; @endphp
                    <td><button class="btn btn-sm btn-dark">{{ $item->status }}</button></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <table class="table table-secondary">
            <thead>
              <tr>
                <th> Jumlah Total Pembayaran: </th>
                <th class="float-right"><b>{{ FormatHelp::rupiah($total_harga) }}</b></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          <center><h4><b>Tambah Item Transaksi</b></h4></center>
        </div>
        <div class="card-body">
          <form>
            {{ csrf_field() }}
            <input type="hidden" name="id_transaction" value="{{ $transaction->id }}">
            <label for="name" class="col-form-label">Package:</label>
            <div class="form-group">
                <textarea name="nama_paket" id="nama_paket" class="form-control" cols="30" rows="3" disabled></textarea>
                <button type="button" class="btn btn-sm btn-gradient-dark float-right" disabled>Find</button>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Qty (Berapa berat):</label>
              <input type="text" id="qty" class="form-control" name="qty" disabled>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Jumlah Harga:</label>
              <input type="text" id="harga_view" class="form-control" name="harga_view" disabled>
            </div>
            <button class="btn btn-gradient-primary float-right" disabled>Add Item</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modals')
  @include('admin.transaction_management.modals.package-tb-modal')
@endsection


@push('script')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer {{ Auth::user()->api_token }}');
                }
            });
        });
    </script>

    @include('admin.transaction_management.form.JS.edit-JS')
@endpush