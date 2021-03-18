@extends('adminlte::page')

@section('title', 'Perhitungan Monte Carlo')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-wave-square ml-2"></i> Perhitungan Monte Carlo</h1>
      {{-- <button class="btn btn-success mr-2"> <i class="fas fa-print"></i> Cetak</button> --}}
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Detail dari perhitungan metode <b>Monte Carlo</b></p>
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
            <h4 class="mt-2">1. Menetapkan suatu distribusi probabilitas bagi variabel yang penting.</h4>
            <p class="text-muted">Mengambil variabel penting yang akan digunakan untuk proses perhitungan metode monte carlo</p>
            <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                <tr>
                  <th >No</th>
                  <th >Bulan</th>    
                  <th >Hasil</th>
                </tr>      
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td>Januari</td>
                    <td>50</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Februari</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Maret</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>April</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Mei</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Juni</td>
                    <td>100</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Juli</td>
                    <td>30</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Agustus</td>
                    <td>60</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>September</td>
                    <td>50</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Oktober</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>November</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Desember</td>
                    <td>40</td>
                  </tr>
              </tbody>
            </table>
            <h4 class="mt-2">2. Membuat distribusi probabilitas kumulatif bagi setiap variabel.</h4>
            <p class="text-muted">Mengubah distribusi probabilitas biasa menjadi sebuah distribusi probabilitas kumulatif (cumulative probability distribution)</p>
            <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                <tr>
                  <th >No</th>
                  <th >Bulan</th>    
                  <th >Frekuensi / Bulan</th>
                  <th >Probabilitas Kejadian</th>
                  <th >Probabilitas Kumulatif</th>
                </tr>      
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td>Januari</td>
                    <td>50</td>
                    <td>50/430 = 0.12</td>
                    <td>0.12</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Februari</td>
                    <td>10</td>
                    <td>10/430 = 0.02</td>
                    <td>0.14</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Maret</td>
                    <td>20</td>
                    <td>20/430 = 0.05</td>
                    <td>0.19</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>April</td>
                    <td>30</td>
                    <td>30/430 = 0.07</td>
                    <td>0.26</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Mei</td>
                    <td>10</td>
                    <td>10/430 = 0.02</td>
                    <td>0.28</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Juni</td>
                    <td>100</td>
                    <td>100/430 = 0.23</td>
                    <td>0.52</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Juli</td>
                    <td>30</td>
                    <td>30/430 = 0.07</td>
                    <td>0.59</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Agustus</td>
                    <td>60</td>
                    <td>60/430 = 0.14</td>
                    <td>0.72</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>September</td>
                    <td>50</td>
                    <td>50/430 = 0.12</td>
                    <td>0.84</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Oktober</td>
                    <td>10</td>
                    <td>10/430 = 0.02</td>
                    <td>0.86</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>November</td>
                    <td>20</td>
                    <td>20/430 = 0.05</td>
                    <td>0.91</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Desember</td>
                    <td>40</td>
                    <td>40/430 = 0.09</td>
                    <td>1.00</td>
                  </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="2"></th>  
                  <th>430</th>
                  <th colspan="2">1.00</th>
                </tr>
              </tfoot>
            </table>
            <h4 class="mt-2">3. Menetapkan sebuah interval angka acak bagi setiap variabel.</h4>
            <p class="text-muted">Setelah distribusi probabilitas kumulatif bagi setiap variabel yang digunakan dalam simulasi ditetapkan, maka diberikan serangkaian angka yang mewakili setiap nilai atau output yang memungkinkan</p>
            <table class="table table-bordered table-striped">
              <thead class="bg-primary">
                <tr>
                  <th>No</th>
                  <th>Bulan</th>    
                  <th>Probabilitas</th>
                  <th>Probabilitas Kumulatif</th>
                  <th>Interval Angka Acak</th>
                </tr>      
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td>Januari</td>
                    <td>0.12</td>
                    <td>0.12</td>
                    <td>0.01 - 0.12</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Februari</td>
                    <td>0.02</td>
                    <td>0.14</td>
                    <td>0.13 - 0.14</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Maret</td>
                    <td>0.05</td>
                    <td>0.19</td>
                    <td>0.15 - 0.19</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>April</td>
                    <td>0.07</td>
                    <td>0.26</td>
                    <td>0.20 - 0.26</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Mei</td>
                    <td>0.02</td>
                    <td>0.28</td>
                    <td>0.27 - 0.28</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Juni</td>
                    <td>0.23</td>
                    <td>0.52</td>
                    <td>0.29 - 0.52</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Juli</td>
                    <td>0.07</td>
                    <td>0.59</td>
                    <td>0.53 - 0.59</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Agustus</td>
                    <td>0.14</td>
                    <td>0.72</td>
                    <td>0.60 - 0.72</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>September</td>
                    <td>0.12</td>
                    <td>0.84</td>
                    <td>0.73 - 0.84</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Oktober</td>
                    <td>0.02</td>
                    <td>0.86</td>
                    <td>0.85 - 0.86</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>November</td>
                    <td>0.05</td>
                    <td>0.91</td>
                    <td>0.87 - 0.91</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Desember</td>
                    <td>0.09</td>
                    <td>1.00</td>
                    <td>0.92 - 1.00</td>
                  </tr>
              </tbody>
            </table>
            <h4 class="mt-2">4. Membangkitkan Angka Acak.</h4>
            <p class="text-muted">Angka acak dapat diatur pada menu Random</p>
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
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>620/12 = 51.6 <b>(52)</b></td>
                </tfoot>
              </tfoot>
            </table>
            <h4 class="mt-2">5. Menyimpulkan Data</h4>
            <p class="text-muted">Interpretasi Data yang sudah diproses menggunakan metode monte carlo</p>
            <table class="table table-bordered table-stripped">
              <thead>
                <tr>
                  <td>Prediksi Penjualan Produk Nama Barang 1 Untuk 1 Tahun Kedepan yaitu sebesar <b>52</b> Pcs/Bulan nya</td>
                </tr>
              </thead>
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