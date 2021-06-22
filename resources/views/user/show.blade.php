@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-users ml-2"></i> Data Pengguna</h1>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Data Pengguna {{$user->name}}</p>

    <div class="row">
      <div class="col">
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          @if (Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ Session::get('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (Session::has('errors'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>
          @endif
          <form action="{{route('user.update',$user->id)}}" method="POST">
            @csrf
          <div class="card card-primary">
            <div class="card-header">
              <div class="card-title">Ubah Data</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" name="name" class="form-control" placeholder="Masukkan Nama...." value="{{$user->name}}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input name="email" type="email" class="form-control" placeholder="Masukkan Email...." value="{{$user->email}}">
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
              <button type="submit" class="btn btn-success mr-1 mt-1">Perbarui </button>
              <a href="{{route('pengguna')}}" class="btn btn-primary ml-1 mt-1" data-dismiss="modal"> Kembali</a>
          </div>
          </div>
        </form>

        <form action="{{route('user.gantiPassword',$user->id)}}" method="POST">
          @csrf
        <div class="card card-warning">
          <div class="card-header">
            <div class="card-title">Ubah Password</div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password Lama....">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru....">
                  </div>
                </div>
              </div>
          </div>
          <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success mr-1 mt-1">Ganti Password </button>
        </div>
      </form>
            <!-- /.card-body -->
          </div>

      </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/select2/css/select2.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
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
<script src="/plugins/select2/js/select2.full.js"></script>
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $("select").select2({
      tags: true
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      tags: true
    })
  })
</script>
@stop