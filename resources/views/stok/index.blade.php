@extends('adminlte::page')

@section('title', 'Data Stok Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-shopping-bag ml-2"></i> Data Stok Barang</h1>
      <div class="d-flex justify-content-end">
      <a href="{{route('stok.buat')}}" class="btn btn-success mr-2"> <i class="fas fa-plus-circle"></i> Tambah Stok Barang</a>
      @if (Auth::user()->role == 0)
        <a href="{{route('laporan.barang.stok')}}" class="btn btn-success mr-2"> <i class="fas fa-file-pdf"></i> Cetak Laporan Seluruh Stok Barang</a>
      @endif
      <div class="form-group">
        <select class="form-control" id="periodeSelect">
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
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data Stok barang.</p>

    <div class="row">
      <div class="col">
        <div class="card">
          {{-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div> --}}
          <!-- /.card-header -->
          <div class="card-body">
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
          <div class="col" id="spinner" style="visibility: hidden">
            <button type="button" name="btn-enviar" class="btn btn-primary w-100">
            <span class="spinner spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true">
            </span>Tunggu Sebentar...  Sedang Memproses Data</button>
          </div>
            <div id="dataTable"></div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <form action="{{ route('barang.store') }}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="tambahModalLabel">Tambah Data Stok Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kode Stok Barang</label>
                    <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Stok Barang...." value="{{old('kode_barang')}}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Jenis Stok Barang</label>
                    <select name="jenis_barang" class="form-control select2bs4" style="width: 100%;">
                      @foreach ($stokBarangs->unique('jenis_barang') as $bars)
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
                      @foreach ($stokBarangs->unique('satuan') as $bars)
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
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      tags: true,
    })
  })
</script>

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          cache: false
      }
  });

  function loadDataTable(x){
      $.ajax({
          url: 'stok/getDataStok/'+x,
          success:function(data){
              $('#dataTable').html(data);
              let spinner = document.getElementById("spinner");
              spinner.style.visibility = 'hidden';
          },
            beforeSend: function(){
              let spinner = document.getElementById("spinner");
              spinner.style.visibility = 'visible';
          },
      })
  }

  loadDataTable({{Carbon\Carbon::now()->format('m')}});

  $(document).ready(function(){
  $('#periodeSelect').change(function(){
    var id = $(this).val();
    loadDataTable(id);
  });
});

</script>
@stop