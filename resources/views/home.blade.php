@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> <i class="fas fa-home"></i> Dashboard</h1>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Selamat Datang pada Halaman Utama Sistem Prediksi Jumlah Penjualan Barang dengan metode monte carlo.</p>
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              {{-- <h3>150</h3> --}}

              <p>Data Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('barang')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}

              <p>Data Penjualan Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('penjualan-barang')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
              <div class="inner">
              {{-- <h3>65</h3> --}}

              <p>Prediksi Barang</p>
              </div>
              <div class="icon">
              <i class="ion ion-ios-analytics-outline"></i>
              </div>
              <a href="{{route('analisa')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
        <!-- ./col -->
        @if (Auth::user()->role == 0)
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}

              <p>Data Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="{{route('pengguna')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endif
        <!-- ./col -->
        
        <!-- ./col -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop