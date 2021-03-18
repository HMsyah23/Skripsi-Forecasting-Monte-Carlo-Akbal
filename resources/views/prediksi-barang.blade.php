@extends('adminlte::page')

@section('title', 'Hasil Prediksi')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-wave-square ml-2"></i> Hasil Prediksi</h1>
      <button class="btn btn-success mr-2"> <i class="fas fa-print"></i> Cetak</button>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Prediksi hasil simulasi, silahkan pilih Barang untuk melihat hasil prediksi.</p>
    <div class="row">
      <div class="col">
        <div class="card">
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          <div class="card-body">
            <!-- select -->
            <div class="form-group">
              <select class="form-control">
                <option>Nama Barang 1</option>
                <option>Nama Barang 2</option>
              </select>
            </div>
            <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                <tr>
                  <th>No</th>
                  <th>Bulan</th>    
                  <th>Angka Acak</th>
                  <th>Prediksi Barang</th>
                </tr>      
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td>Januari</td>
                    <td>0.538</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Februari</td>
                    <td>0.235</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Maret</td>
                    <td>0.401</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>April</td>
                    <td>0.782</td>
                    <td>50</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Mei</td>
                    <td>0.151</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Juni</td>
                    <td>0.547</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Juli</td>
                    <td>0.176</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Agustus</td>
                    <td>0.510</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>September</td>
                    <td>0.654</td>
                    <td>60</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Oktober</td>
                    <td>0.212</td>
                    <td>40</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>November</td>
                    <td>0.301</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Desember</td>
                    <td>0.906</td>
                    <td>40</td>
                  </tr>
              </tbody>
              <tfoot>
                <tfoot>
                  <td colspan="3">Prediksi Rata - Rata Penjualan Per Bulan Untuk Satu Tahun Kedepan</td>
                  <td><b>52 Pcs</b></td>
                </tfoot>
              </tfoot>
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