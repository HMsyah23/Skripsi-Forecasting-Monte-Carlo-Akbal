@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-users ml-2"></i> Data Pengguna</h1>
      <button class="btn btn-success mr-2"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data pengguna yang dapat mengakes sistem.</p>
    <div class="row">
      <div class="col">
        <div class="card">
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @for ($i = 1; $i < 5; $i++)
                  <tr>
                    <td>{{$i}}</td>
                    <td>
                      <img class="img-fluid" src="{{asset('img/logo.png')}}" alt="No Pic" style="width: 25px;">
                    </td>
                    <td>Nama Dummy {{$i}}</td>
                    <td>Admin {{$i}}</td>
                    <td>admin{{$i}}@admin.com</td>
                    <td>
                      <div class="d-flex">
                        <button class="btn btn-sm btn-primary mr-1 mb-1"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-warning mr-1 mb-1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>   
                  @endfor
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