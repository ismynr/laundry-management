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
          <center><h4><b>Transaksi</b></h4></center>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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
                    @if ($transaction->end_date)
                        <td><span class="badge badge-danger">Selesai</span> Pada {{ $transaction->end_date }}</td>
                    @else
                        <td><span class="badge badge-success">Berjalan</span></td>
                    @endif
                </tr>
            </table>
            <table class="table table-borderless">
                <tr>
                    <th class="text-left">Pembuat Transaksi</th>
                    <td class="text-right">{{ $transaction->user->name }}</td>
                </tr>
            </table>
            <button onclick="" class="btn btn-light float-right mr-2" title="Klaim transaksi terlebih dahulu" disabled>
              <i class="mdi mdi-printer"></i> Cetak Kuitansi
            </button>
            <button onclick="" class="btn btn-light float-right mr-2">
              <i class="mdi mdi-file-document"></i> Cetak Transaksi
            </button>
            <button onclick="" class="btn btn-light float-right mr-2">
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
          <table class="table data-table dataTables" id="table-detailTr">
            <thead>
              <tr>
                <th> # </th>
                <th> Package </th>
                <th> Qty </th>
                <th> Jumlah </th>
                <th width="15%"> Action </th>
              </tr>
            </thead>
            <tbody></tbody>
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
          <form id="addForm-item">
            {{ csrf_field() }}
            <input type="hidden" name="id_transaction" value="{{ $transaction->id }}">
            <label for="name" class="col-form-label">Package:</label>
            <div class="form-group">
                <input type="hidden" id="id_package" name="id_package">
                <small class="error_id_package text-danger hidden"></small>
                {{-- VIEW ONLY --}}
                <input type="hidden" id="harga_package" name="harga_package">
                <textarea name="nama_paket" id="nama_paket" class="form-control" cols="30" rows="2" readonly></textarea>
                <button type="button" id="find-package" class="btn btn-sm btn-dark float-right">Find</button>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Qty (Berapa berat):</label>
              <input type="text" id="qty" class="form-control" name="qty" value="1">
              <small class="error_qty text-danger hidden"></small>
            </div>
            <div class="form-group">
              <label for="name" class="col-form-label">Jumlah Harga:</label>
              <input type="text" id="harga" class="form-control" name="harga" readonly>
              <small class="error_harga text-danger hidden"></small>
            </div>
            <button type="submit" id="addItemDetail" class="btn btn-gradient-primary float-right" >Add Item</button>
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