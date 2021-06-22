@extends('adminlte::page')

@section('title', 'Detail Perhitungan Penjualan Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-chart-bar ml-2"></i> Detail Perhitungan Penjualan Barang</h1>
      <div class="d-flex justify-content-end">
        <a href="{{route('laporan.barang')}}" class="btn btn-success mr-2"> <i class="fas fa-file-pdf"></i> Cetak Laporan Seluruh Barang</a>
        {{-- <a href="{{route('analisa')}}" class="btn btn-success mr-2"> <i class="fas fa-info"></i> Analisa</a> --}}
      </div>
    </div>
@stop

@section('content')
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Hasil Analisis Data Barang</h3>
            {{-- <div class="card-tools">
              <div class="form-group">
                <select class="form-control form-control-sm" id="barangSelect">
                  @foreach ($bars as $barang)
                  <option
                  @if ($barang->kode_barang === 'B001')
                    selected
                  @endif
                  value="{{$barang->kode_barang}}">{{ $barang->jenis_barang.' '.
                  $barang->merk.' '.
                  $barang->varian.' '.
                  $barang->isi.' '.
                  $barang->satuan}}</option> 
                  @endforeach
                </select>
              </div>
            </div> --}}
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <select class="form-control" id="barangSelect">
                @foreach ($bars as $barang)
                <option
                @if ($barang->kode_barang === 'B001')
                  selected
                @endif
                value="{{$barang->kode_barang}}">{{ $barang->jenis_barang.' '.
                $barang->merk.' '.
                $barang->varian.' '.
                $barang->isi.' '.
                $barang->satuan}}</option> 
                @endforeach
              </select>
            </div>
            <div id="dataTable"></div>
          </div>
          <!-- /.card-body -->
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

  function loadDataTable(x){
      $.ajax({
          url: 'getDataBarang/'+x,
          success:function(data){
              $('#dataTable').html(data);
          }
      })
  }

  loadDataTable('B001');

  $(document).ready(function(){
  $('#barangSelect').change(function(){
    var id = $(this).val();
    loadDataTable(id);
  });
});

</script>
@stop