@extends('adminlte::page')

@section('title', 'Bantuan')

@section('content_header')
      <h1> <i class="fas fa-info-circle ml-2"></i> Bantuan</h1>
@stop

@section('content')
    {{-- <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar Bantuan yang akan digunakan sebgai percobaan simulasi.</p> --}}
    <div class="row">
      <div class="col">
        <table class="table table-striped">
              <tbody>
                <tr><td><i class="fas fa-check-circle"></i> Administrator login terlebih dahulu</td></tr>
                <tr><td><i class="fas fa-check-circle"></i> Pilih menu data barang untuk memasukkan data barang</td></tr>
                <tr><td><i class="fas fa-check-circle"></i> Kemudian pilih menu data permintaan barang lalu export file excel data barang periode sebelumnya</td></tr>
                <tr><td><i class="fas fa-check-circle"></i> Setelah itu beralih kehalaman angka random, lalu masukan nilai random yang nantinya akan digunakan untuk perhitungan metode Monte Carlo</td></tr>
                <tr><td><i class="fas fa-check-circle"></i> Jika sudah selesai memasukkan angka random, pindah kehalaman prediksi barang untuk melihat hasil analisa yang dijalankan oleh sistem</td></tr>
                <tr><td><i class="fas fa-check-circle"></i> Untuk melihat grafik, pengguna dapat berpindah kehalaman grafik</td></tr>
              </tbody>
        </table>
      </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
    
@stop