@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-shopping-bag ml-2"></i> Data Barang</h1>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i>Tambah Data Barang</p>

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
          <form action="{{ route('barang.store') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-dialog card-dialog-centered" role="document">
                <div class="card-content">
                  <div class="card-header bg-success">
                    <h5 class="card-title" id="tambahcardLabel">Tambah Data Barang</h5>
                    <div class="card-tools">
                      <a class="btn btn-default" href="{{route('barang')}}">
                        <i class="fas fa-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Kode Barang</label>
                          <input type="text" disabled  class="form-control" placeholder="Masukkan Kode Barang...." value="{{$kode}}">
                          <input type="hidden" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang...." value="{{$kode}}">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Jenis Barang</label>
                          <select name="jenis_barang" class="form-control select2bs4" style="width: 100%;">
                            @foreach ($barangs->unique('jenis_barang') as $bars)
                              <option value="{{$bars->jenis_barang}}">{{$bars->jenis_barang}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Merk</label>
                          <input name="merk" type="text" class="form-control" placeholder="Masukkan Merk....." value="{{old('merk')}}">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Varian</label>
                          <input name="varian" type="text" class="form-control" placeholder="Masukkan Varian...." value="{{old('varian')}}">
                        </div>
                      </div>
                    </div>
      
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Satuan</label>
                          <select name="satuan" class="form-control select2bs4" style="width: 100%;">
                            @foreach ($barangs->unique('satuan') as $bars)
                              <option value="{{$bars->satuan}}">{{$bars->satuan}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Isi</label>
                          <input name="isi" type="number" class="form-control" placeholder="Masukkan Isi....." value="{{old('isi')}}">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Harga</label>
                          <input name="harga" type="number" class="form-control" placeholder="Masukkan Harga...." value="{{old('harga')}}">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="card">Tutup</button> --}}
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                  </div>
                </div>
              </div>
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