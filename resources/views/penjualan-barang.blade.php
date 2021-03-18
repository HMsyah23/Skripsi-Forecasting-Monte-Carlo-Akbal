@extends('adminlte::page')

@section('title', 'Data Penjualan Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-chart-bar ml-2"></i> Data Penjualan Barang</h1>
      <div class="d-flex justify-content-end">
        <button class="btn btn-success mr-2"> <i class="fas fa-file-excel"></i> Export</button>
        <button class="btn btn-success mr-2"> <i class="fas fa-print"></i> Cetak</button>
      </div>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data penjualan barang beberapa tahun sebelumnya yang ditampilkan dengan bulan.</p>
    <div class="row">
      <div class="col">
        <div class="card">
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
              <thead class="bg-primary">
                <tr>
                  <th rowspan='2'>Tahun</th>
                  <th rowspan='2'>Nama Barang</th>    
                  <th colspan='12'>Bulan</th>
                  <th rowspan='2'>Aksi</th>
                </tr>
                <tr>
                  <th>Januari</th>
                  <th>Februari</th>
                  <th>Maret</th>
                  <th>April</th>
                  <th>Mei</th>
                  <th>Juni</th>
                  <th>Juli</th>
                  <th>Agustus</th>
                  <th>September</th>
                  <th>Oktober</th>
                  <th>November</th>
                  <th>Desember</th>
                </tr>      
              </thead>
              <tbody>
                <tr>
                  <td rowspan="4" style="text-align: center; vertical-align: middle;">2020</td>
                  <td>Nama Produk 1</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>30</td>
                  <td>10</td>
                  <td>100</td>
                  <td>30</td>
                  <td>60</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>40</td>
                  <td>
                    <button class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Nama Produk 1</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>30</td>
                  <td>10</td>
                  <td>100</td>
                  <td>30</td>
                  <td>60</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>40</td>
                  <td>
                    <button class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Nama Produk 1</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>30</td>
                  <td>10</td>
                  <td>100</td>
                  <td>30</td>
                  <td>60</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>40</td>
                  <td>
                    <button class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>Nama Produk 1</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>30</td>
                  <td>10</td>
                  <td>100</td>
                  <td>30</td>
                  <td>60</td>
                  <td>50</td>
                  <td>10</td>
                  <td>20</td>
                  <td>40</td>
                  <td>
                    <button class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@stop