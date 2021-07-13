@extends('adminlte::page')

@section('title', 'Data Penjualan Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-chart-bar ml-2"></i> Data Penjualan Barang</h1>
      <div class="d-flex justify-content-end">
        {{-- <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-file-excel"></i> Import</button>
        @if ($penjualans == null)
        @else
        <a href="{{route('analisa')}}" class="btn btn-success mr-2"> <i class="fas fa-info"></i> Analisa</a>
        @endif
      </div> --}}
    </div>
@stop

@section('content')
    @if ($penjualans == null)
      <p class="alert alert-info"> <i class="fas fa-info"></i> Silahkan Import Data Excel Terlebih Dahulu</p>    
    @else
      <p class="alert alert-info"> <i class="fas fa-info"></i> Input Jumlah Penjualan Barang</p>    
    @endif
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Penjualan
            </h3>

            <div class="card-tools">
              <div class="card-tools">
                <a class="btn btn-default" href="{{route('penjualan-barang')}}">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif 
            <div class="form-group">
              <form action="{{route('simpanPenjualan')}}" method="post">
              <label for="">Pilih Barang</label>
              <select class="form-control" name="id_barang">
                @foreach ($barangs as $barang)
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
                          @csrf
                          @if ($errors->has('sarang'))
                              <div class="alert alert-danger">{{ $errors->first('sarang') }}</div>
                          @endif

                          @if (Session::has('message'))
                              <div class="alert alert-danger">{{ Session::get('message') }}</div>
                          @endif

                      <div id="cont" class="mt-2 text-center d-flex align-items-center"></div>
                      <button type="submit" id="bt" class="btn btn-success mb-1" onclick="submit()">Simpan Data</button>
                </form>
              <button type="button" id="addRow" class="btn btn-danger" onclick="addRow()"><i class="fas fa-plus"></i> Tambah Data Penjualan</button>          
            </div>
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
  var arrHead = new Array();	// array for header.
  arrHead = ['No', 'Tanggal','Jumlah Terjual',''];

  document.addEventListener('DOMContentLoaded', // first create TABLE structure with the headers. 
  function createTable() {
      var empTable = document.createElement('table');
      empTable.className = "table mb-0";
      empTable.setAttribute('id', 'empTable'); // table id.

      var tr = empTable.insertRow(-1);
      for (var h = 0; h < arrHead.length; h++) {
          var th = document.createElement('th'); // create table headers
          th.innerHTML = arrHead[h];
          if(h == 0) {
              th.setAttribute('width', '5%');
          }
          tr.appendChild(th);
      }

      var div = document.getElementById('cont');
      div.appendChild(empTable);  // add the TABLE to the container.
  }, false);

  

  let a = 0;
  // now, add a new to the TABLE.
  function addRow() {
      var empTab = document.getElementById('empTable');

      var rowCnt = empTab.rows.length;   // table row count.
      var tr = empTab.insertRow(rowCnt); // the table row.
      tr = empTab.insertRow(rowCnt);
      for (var c = 0; c < arrHead.length; c++) {

          var td = document.createElement('td'); // table definition.
          td = tr.insertCell(c);
          if (c == 1) {      // the first column.
              // add a button in every new row in the first column.
              
              let ele = document.createElement('input');
              ele.setAttribute('type', 'date');
              ele.setAttribute('required','');
              ele.setAttribute('value', '');
              ele.setAttribute('name', `penjualan[${a}][tanggal]`);
              ele.className = "form-control";
          
              td.appendChild(ele);
          } else if (c == 2) {      // the first column.
              // add a button in every new row in the first column.
              
              let ele = document.createElement('input');
              ele.setAttribute('type', 'number');
              ele.setAttribute('required','');
              ele.setAttribute('value', '');
              ele.setAttribute('min', 0);
              ele.setAttribute('name', `penjualan[${a}][terjual]`);
              ele.className = "form-control";
              td.appendChild(ele);
          }  else if (c == 0) {
              a = a + 1;
              // 2nd, 3rd and 4th column, will have textbox.
              var ele = document.createElement('input');
              ele.setAttribute('type', 'text');
              ele.setAttribute('name', `penjualan[${a}][id]`);
              ele.setAttribute('disabled','true');
              ele.setAttribute('size',4);
              ele.setAttribute('value', a);
              ele.className = "form-control";

              td.appendChild(ele);
          } else if (c == 3) {      // the first column.
              // add a button in every new row in the first column.
              var button = document.createElement('input');
              
              // set input attributes.
              button.setAttribute('type', 'button');
              button.setAttribute('value', 'Hapus');
              button.className = "btn btn-sm btn-danger";

              // add button's 'onclick' event.
              button.setAttribute('onclick', 'removeRow(this)');

              td.appendChild(button);
          }
      }
  }

  // delete TABLE row function.
  function removeRow(oButton) {
      var empTab = document.getElementById('empTable');
      a = a - 1;
      empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
  }
</script>
@stop