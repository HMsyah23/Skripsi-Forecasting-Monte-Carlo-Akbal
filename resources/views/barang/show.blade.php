@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-shopping-bag ml-2"></i> Data Barang</h1>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Data Barang {{$barang->kode_barang}}</p>

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
          <form action="{{route('barang.update',$barang->id)}}" method="POST">
            @csrf
          <div class="card card-warning">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Kode Barang</label>
                      <input type="text" class="form-control" placeholder="Masukkan Kode Barang...." value="{{$barang->kode_barang}}" disabled>
                      <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang...." value="{{$barang->kode_barang}}" hidden>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Jenis Barang</label>
                      <select name="jenis_barang" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($barangs->unique('jenis_barang') as $bars)
                          <option value="{{$bars->jenis_barang}}" @if ($barang->jenis_barang == $bars->jenis_barang) selected @endif>{{$bars->jenis_barang}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Merk</label>
                      <input name="merk" type="text" class="form-control" placeholder="Masukkan Merk....." value="{{$barang->merk}}">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Varian</label>
                      <input name="varian" type="text" class="form-control" placeholder="Masukkan Varian...." value="{{$barang->varian}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Satuan</label>
                      <select name="satuan" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($barangs->unique('satuan') as $bars)
                          <option value="{{$bars->satuan}}" @if ($barang->satuan == $bars->satuan) selected @endif>{{$bars->satuan}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Isi</label>
                      <input name="isi" type="number" class="form-control" placeholder="Masukkan Isi....." value="{{$barang->isi}}">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Harga</label>
                      <input name="harga" type="number" class="form-control" placeholder="Masukkan Harga...." value="{{$barang->harga}}">
                    </div>
                  </div>
                </div>

                <!-- input states -->
                {{-- <div class="form-group">
                  <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                    success</label>
                  <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                    warning</label>
                  <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                </div> --}}
                {{-- <div class="form-group">
                  <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                    error</label>
                  <input type="text" class="form-control is-invalid" placeholder="Enter ...">
                  <small class="text-danger">hoeiwhgewho</small>
                </div> --}}
            </div>
            <div class="card-footer d-flex justify-content-end">
              <button type="submit" class="btn btn-success mr-1 mt-1">Perbarui </button>
              <a href="{{route('barang')}}" class="btn btn-primary ml-1 mt-1" data-dismiss="modal"> Kembali</a>
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