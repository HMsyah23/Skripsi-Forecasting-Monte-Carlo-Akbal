@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-users ml-2"></i> Data Pengguna</h1>
      <button class="btn btn-success mr-2" data-toggle="modal" data-target="#tambahModal"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data pengguna yang dapat mengakes sistem.</p>
    <div class="row">
      <div class="col">
        <div class="card">
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
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Peran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if ($user->role == 0)
                      <td>Pemilik</td>
                    @else
                      <td>Pegawai</td>
                    @endif
                    <td>
                      <div class="d-flex">
                        <button class="btn btn-sm btn-primary mr-1 mb-1" data-toggle="modal" data-target="#exampleModal-{{$user->id}}"><i class="fas fa-eye" ></i></button>
                        <a href="{{route('user.show',$user->id)}}" class="btn btn-sm btn-warning mr-1 mb-1"><i class="fas fa-edit"></i></a>
                        @if ($user->role == 1)
                          <button class="btn btn-sm btn-danger mr-1 mb-1" data-toggle="modal" data-target="#hapusModal-{{$user->id}}"><i class="fas fa-trash"></i></button>
                        @endif
                      </div>
                    </td>
                  </tr>  

                  <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title" id="exampleModalLabel">Detail Barang {{$user->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                              <ul>
                                <li>Nama   : {{$user->name}}</li>
                                <li>Email  : {{$user->email}}</li>
                                <li>Peran  : 
                                  @if ($user->role == 0)
                                      Pemilik
                                  @else
                                      Pegawai
                                  @endif
                                </li>
                              </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-file-excel"></i> Import</button> --}}
                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="modal fade" id="hapusModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header justify-content-center bg-danger">
                              <div class="modal-title">
                                  Hapus Data {{$user->name}} <i class="fas fa-question"></i>
                              </div>
                          </div>
                          <div class="modal-footer justify-content-center">
                              <form action="{{route('user.destroy',$user->id)}}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-success">Iya</button>
                              </form>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          </div>
                      </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <form action="{{ route('user.store') }}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="tambahModalLabel">Tambah Data Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama...." value="{{old('namag')}}">
                  </div>
                </div>
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Masukkan Email....." value="{{old('email')}}">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Masukkan Password....." value="{{old('password')}}">
                    <input type="text" name="role" value="1" hidden>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form> 
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