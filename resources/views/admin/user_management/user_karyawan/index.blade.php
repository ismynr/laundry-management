@extends('layouts.app')

@section('title', 'Customer Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Karyawan Users </h3>
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
          <h4 class="card-title">List Karyawan </h4>
          <button type="button" class="addBtn btn btn-gradient-primary btn-sm float-right"><i class="mdi mdi-plus menu-icon"></i> Create</button>
          
          <table class="table table-striped data-table table-responsive">
            <thead>
              <tr>
                <th> # </th>
                <th> Name  </th>
                <th> Email </th>
                <th width="27%"> Action </th>
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
  @include('admin.user_management.user_karyawan.modals.add-modal') {{-- add user --}}
  @include('admin.user_management.user_karyawan.modals.edit-modal') {{-- edit user --}}
  @include('admin.user_management.user_karyawan.modals.save-karyawan-modal') {{-- add and edit karyawan --}}
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
  
  @include('admin.user_management.user_karyawan.JS')
@endpush