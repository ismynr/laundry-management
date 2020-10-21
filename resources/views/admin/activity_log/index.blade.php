@extends('layouts.app')

@section('title', 'Log Activity')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-cached mr-2"></i>
      </span> Activity Log </h3>
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
          <h4 class="card-title">Activity Log </h4>
          <table class="table table-striped data-table">
            <thead>
              <tr>
                <th> # </th>
                <th> Nama Aktifitas </th>
                <th> Deskripsi </th>
                <th> Tipe User  </th>
                <th> Waktu </th>
                <th> Id Subject</th>
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
  
  @include('admin.activity_log.JS')
@endpush