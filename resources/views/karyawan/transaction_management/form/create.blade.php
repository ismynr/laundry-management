@extends('layouts.app')

@section('title', 'Create Transaction Karyawan')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Create Transactions </h3>
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
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
            <form id="addForm" action="{{ route('karyawan.transactions.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="container">
                  @php
                  function getGUIDnoHash(){
                    mt_srand((double)microtime()*10000);
                    $charid = md5(uniqid(rand(), true));
                    $c = unpack("C*",$charid);
                    $c = implode("",$c);
                    return substr($c,0,15);
                  }
                @endphp 
                  <div class="form-group">
                      <label for="name" class="col-form-label">Code Transaksi:</label>
                      <input type="text" id="code" class="form-control" name="code" readonly value="TR-{{ getGUIDnoHash() }}">
                  </div>
                  <div class="form-group">
                      <label for="name" class="col-form-label">Customer:</label>
                      <select class="select2_id_customer form-control select2" id="id_customer" name="id_customer"></select>
                  </div>
                    <button type="submit" class="btn btn-gradient-primary float-right" >Buat Transaksi</button>
                </div>
            </form>
        </div>
      </div>
    </div>
@endsection

@section('modals')
  @include('karyawan.transaction_management.modals.package-tb-modal')
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

    @include('karyawan.transaction_management.form.JS.create-JS')
@endpush