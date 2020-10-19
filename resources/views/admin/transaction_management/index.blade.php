@extends('layouts.app')

@section('title', 'Transaction Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-coin"></i>
      </span> Transactions </h3>
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
        <div class="card-body">
          <h4 class="card-title">Antrian Transaksi </h4>
          <table class="table table-striped data-table">
            <thead>
              <tr>
                <th> # </th>
                <th width="20%"> Code </th>
                <th> Nama Customer </th>
                <th> Status </th>
                <th> Total Harga </th>
                <th width="5"> Jml Trans </th>
                <th width="20%"> Action </th>
              </tr>
            </thead>
            <tbody> </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modals')

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
  
  @include('admin.transaction_management.JS')
@endpush