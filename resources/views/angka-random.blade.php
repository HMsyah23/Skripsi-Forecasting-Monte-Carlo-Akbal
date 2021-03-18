@extends('adminlte::page')

@section('title', 'Angka Random')

@section('content_header')
    <h1> <i class="fas fa-random"></i> Angka Random</h1>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Menentukan angka random yang digunakan untuk perhitungan metode <b>Monte Carlo</b>.</p>
    <div class="row">
        <div class="col-lg-4 col-6">
          <div class="color-palette-set">
            <div class="bg-danger color-palette pl-2"><span> Tentukan Nilai Random Secara Otomatis</span></div>
          </div>
          <button class="btn btn-warning mt-2"><i class="fas fa-sync-alt"></i> Hitung Otomatis</button>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <div class="color-palette-set mb-2">
            <div class="bg-danger color-palette pl-2"><span> Tentukan Nilai Random Secara Manual</span></div>
          </div>
          @for ($i = 1; $i < 11; $i++)
          <div class="form-group row mb-1">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Angka {{$i}}</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Masukkan Angka {{$i}}">
            </div>
          </div>
          @endfor
          <button class="btn btn-warning mt-2"><i class="fas fa-check"></i> Hitung Manual</button>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <div class="color-palette-set mb-2">
            <div class="bg-danger color-palette pl-2"><span> Menampilkan Angka Random yang akan disimpan</span></div>
          </div>
          @for ($i = 1; $i < 11; $i++)
          <div class="form-group row mb-1">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Angka {{$i}}</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Angka Random {{$i}}" disabled>
            </div>
          </div>
          @endfor
          <button class="btn btn-success mt-2"><i class="fas fa-save"></i> Simpan</button>
        </div>
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