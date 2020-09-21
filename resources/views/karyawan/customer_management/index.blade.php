@extends('layouts.app')

@section('title', 'Customer Karyawan')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Customers </h3>
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
          <h4 class="card-title">List Customer </h4>
          <button type="button" class="addBtn btn btn-gradient-primary btn-sm float-right"><i class="mdi mdi-plus menu-icon"></i> Create</button>
          
          <table class="table table-striped data-table">
            <thead>
              <tr>
                <th> # </th>
                <th> Name  </th>
                <th> Alamat </th>
                <th> Telephone </th>
                <th> Gender </th>
                <th width="10%"> Point </th>
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
  @include('karyawan.customer_management.modals.add-modal')
  @include('karyawan.customer_management.modals.edit-modal')
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
  
  @include('karyawan.customer_management.JS')
@endpush