@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-shopping-bag ml-2"></i> Data Stok Barang</h1>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i>Tambah Data Stok Barang</p>

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
          @if (Session::has('message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
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
          <form action="{{ route('stok.store') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-dialog card-dialog-centered" role="document">
                <div class="card-content">
                  <div class="card-header bg-success">
                    <h5 class="card-title" id="tambahcardLabel">Tambah Data Barang</h5>
                    <div class="card-tools">
                      <a class="btn btn-default" href="{{route('stok')}}">
                        <i class="fas fa-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                          <label>Nama Barang</label>
                          <select name="kode_barang" class="form-control select2bs4" style="width: 100%;" required>
                            @foreach ($barangs as $bars)
                              <option value="{{$bars->kode_barang}}">{{$bars->jenis_barang.' '.$bars->merk.' '.$bars->varian.' '.$bars->isi.' '.$bars->satuan}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                          <label>Periode</label>
                          <select name="periode" class="form-control" required>
                              <option @if (Carbon\Carbon::now()->format('m') == 1) selected @endif value="1">Januari</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 2) selected @endif value="2">Februari</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 3) selected @endif value="3">Maret</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 4) selected @endif value="4">April</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 5) selected @endif value="5">Mei</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 6) selected @endif value="6">Juni</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 7) selected @endif value="7">Juli</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 8) selected @endif value="8">Agustus</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 9) selected @endif value="9">September</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 10) selected @endif value="10">Oktober</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 11) selected @endif value="11">November</option>
                              <option @if (Carbon\Carbon::now()->format('m') == 12) selected @endif value="12">Desember</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Stok Awal</label>
                          <input type="number" name="stok" class="form-control" placeholder="Masukkan Stok Awal...." min="0" required>
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

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      tags: true
    })
  })
</script>
@stop