@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
    .image-circle{
        border-radius: 50%;
        width: 175px;
        height: 175px;
        border: 4px solid #FFF;
        margin: 10px;
    }
    .follow{
        background:linear-gradient(to right,#90caf9,#047edf 99%);
        border-radius: 10px;
        padding: 15px;
        line-height: 20px;
        margin-top: 10px;
    }
    .outter{
        padding: 0px;
        border: 1px solid #047edf;
        border-radius: 50%;
        width: 200px;
        height: 200px;
    }
</style>
<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Profile Anda </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sekilas</h4>
            @if (\Session::has('success'))
                <div class="alert alert-success text-center">{{ \Session::get('success') }}</div>
            @elseif(\Session::has('error'))
                <div class="alert alert-danger text-center">{{ \Session::get('error') }}</div>
            @endif
            <div class="container">
                <div class="row login_box">
                    <div class="col-md-12 col-xs-12" align="center">
                        <div class="outter mb-2"><img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="image-circle"/></div>   
                        <h3><b>{{  $profile->name }}</b></h3>
                        <h5 class="text-uppercase">{{ $profile->role }} </h5>
                        <h5>{{ FormatHelp::hari_tanggal($profile->created_at) }} </h5>
                    </div>
                </div>
                <div class="row follow">
                    <div class="col-md-6 col-xs-6 text-center text-white">
                        Pelayanan (Bulan) <br/>
                        <b> {{ $countTrans }} </b><br/>
                        Transaksi
                    </div>
                    <div class="col-md-6 col-xs-6 text-center text-white">
                        Pelayanan (Semua) <br/>
                        <b> {{ $profile->transaction->count() }} </b><br/>
                        Transaksi
                    </div>  
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Akun Login</h4>
            {{-- KHUSUS VALIDATION ERROR --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.profile.update', $profile->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama:</label>
                    <input type="text" id="edit_name" class="form-control" name="name" value="{{ $profile->name}}">
                </div>
                <div class="form-group">
                    <label for="name" class="col-form-label">Email:</label>
                    <input type="email" id="edit_email" class="form-control" name="email" value="{{ $profile->email}}">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Password: <small class="text-danger">*Kosongkan jika tidak ingin diganti</small></label>
                    <input type="password" id="edit_password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-form-label">Password Confirmation:</label>
                    <input type="password" id="edit_password_confirmation" class="form-control" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-gradient-info float-right">Save</button>
            </form>
          </div>
        </div>
    </div>

    {{-- <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Profile Data</h4>
            
          </div>
        </div>
    </div> --}}
  </div>
@endsection