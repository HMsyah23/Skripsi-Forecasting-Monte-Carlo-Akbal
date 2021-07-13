@extends('adminlte::page')

@section('title', 'Data Penjualan Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-chart-bar ml-2"></i> Data Penjualan Barang</h1>
      <div class="d-flex justify-content-end">
        <a href="{{route('tambahData')}}" class="btn btn-success mr-2"> <i class="fas fa-plus"></i> Tambah Data Penjualan Barang</a> 
        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-file-excel"></i> Import</button>
        @if ($penjualans == null)
        @else
        <a href="{{route('analisa')}}" class="btn btn-success mr-2"> <i class="fas fa-info"></i> Analisa</a>
        @endif
      </div>
    </div>
@stop

@section('content')
    @if ($penjualans == null)
      <p class="alert alert-info"> <i class="fas fa-info"></i> Silahkan Import Data Excel Terlebih Dahulu</p>    
    @else
      <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data penjualan barang selama Satu Bulan Terakhir.</p>    
    @endif
    <div class="row">
      <div class="col">
        @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif  
                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! Session::get('error') !!}
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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Penjualan
            </h3>

            <div class="card-tools">
              <div class="form-group">
                <select class="form-control" name="periode" id="periodeSelect">
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
          <!-- /.card-header -->
          <div class="card-body">
            <div id="dataTable"></div>
            
    </div>
  </div>
</div>
    </div>

    <!-- Modal -->
    <form action="{{ route('import.data-penjualan') }}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Data Penjualan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input name="data-penjualan" type="file">
            </div>
            <div class="modal-footer">
              <a href="{{asset('format/format_pendataan.xlsx')}}"><u>Download Contoh Format Data Excel</u></a> 
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-file-excel"></i> Import</button>
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
      "paging": true,
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
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          cache: false
      }
  });

  
  function loadDataTable(periode){
      $.ajax({
          url: 'penjualan/getDataPenjualan/'+periode,
          success:function(data){
              $('#dataTable').html(data);
          }
      })
  }

  let periode = $('#periodeSelect').val();

  loadDataTable(periode);

  $(document).ready(function(){
  $('#periodeSelect').change(function(){
    let periode = $(this).val();
    loadDataTable(periode);
  });
});

</script>
@stop