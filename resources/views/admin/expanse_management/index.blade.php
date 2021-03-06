@extends('layouts.app')

@section('title', 'Expanse Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cart-outline"></i>
      </span> Expanses </h3>
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
          <h4 class="card-title">List Biaya Pembelian Laundry</h4>
          </p>
          <table class="table table-striped data-table dataTable" id="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Yang Beli </th>
                <th> Deskripsi </th>
                <th> Harga </th>
                <th> Catatan </th>
                <th width="10%"> Action </th>
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
  @include('admin.expanse_management.modals.add-modal')
  @include('admin.expanse_management.modals.edit-modal')
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

    @include('admin.expanse_management.JS')
@endpush