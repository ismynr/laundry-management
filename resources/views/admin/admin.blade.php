@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard</h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">Penjualan {{ FormatHelp::bulanIni() }} <i class="mdi mdi-chart-line mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-2">{{ FormatHelp::rupiah($STMonth) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">Pesanan {{ FormatHelp::bulanIni() }} <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-2">{{ $CTMonth }} </h2>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3">Pengeluaran {{ FormatHelp::bulanIni() }} <i class="mdi mdi-diamond mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-2">{{ FormatHelp::rupiah($SEMonth) }} </h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="clearfix">
            <h4 class="card-title float-left">Statistik Penjualan Tahun ini</h4>
            <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
          </div>
          <canvas id="visit-sale-chart" class="mt-4"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Recent Transaction</h4>
          <div class="table-responsive table-hover" style="cursor: pointer">
            <table class="table">
              <thead>
                <tr>
                  <th class="font-weight-bold"> Code </th>
                  <th class="font-weight-bold"> Customer </th>
                  <th class="font-weight-bold"> Jml Transaksi  </th>
                  <th class="font-weight-bold"> Tracking </th>
                  <th class="font-weight-bold"> Dibuat pada </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($RecentTrans as $item)
                  <tr data-href="{{ route('admin.transactions.edit', $item->id) }}">
                    <td> {{ $item->code }} </td>
                    <td> 
                      <i class="mdi mdi-brightness-1 {{ $item->end_date == null ? 'text-success':'text-dark'}} "></i>
                      {{ $item->customer->name }} </td>
                    <td> {{ count($item->transactionDetail) }} </td>
                    <td>
                      @php
                      $diterima=0; $proses=0;$diambil=0;
                      foreach ($item->transactionDetail as $item2) {
                        switch ($item2->status) {
                          case 'diterima':
                            $diterima++;
                            break;
                          case 'proses':
                            $proses++;
                            break;
                          case 'diambil':
                            $diambil++;
                            break;
                        }
                      }
                      @endphp
                      <label class="badge btn-inverse-info" title="diterima">{{ $diterima }} </label>
                      <label class="badge btn-inverse-success" title="proses">{{ $proses }} </label>
                      <label class="badge btn-inverse-dark" title="diambil">{{ $diambil }} </label>
                    </td>
                    <td> {{ FormatHelp::hari($item->created_at) }} </td>
                  </tr>
                @empty
                    <tr>
                      <td colspan="5">Tidak ada data</td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Recent Activity</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="font-weight-bold"> Action </th>
                  <th class="font-weight-bold"> Time </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($RecentActivity as $item)
                  <tr>
                    <td> {{ $item->description }} </td>
                    <td> {{ FormatHelp::timeAgo($item->created_at) }} </td>
                  </tr>
                @empty
                    <tr>
                      <td colspan="5">Tidak ada data</td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  @include('admin.JS')
@endpush
