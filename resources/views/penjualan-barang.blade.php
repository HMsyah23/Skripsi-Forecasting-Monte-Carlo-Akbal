@extends('adminlte::page')

@section('title', 'Data Penjualan Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-chart-bar ml-2"></i> Data Penjualan Barang</h1>
      <div class="d-flex justify-content-end">
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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Penjualan
            </h3>

            <div class="card-tools">

              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            @forelse ($penjualans as $item => $barangs)
            <div class="col-xl-4 col-lg-4 col-md-6">
              <div class="card collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">
                    {{ $item.' : '.$barangs[0]->barang->jenis_barang.' '.
                      $barangs[0]->barang->merk.' '.
                      $barangs[0]->barang->varian.' '.
                      $barangs[0]->barang->isi.' '.
                      $barangs[0]->barang->satuan }}
                  </h3>

                  <div class="card-tools">
                    @php
                              $jum = 0;
                          @endphp
                          @forelse ($barangs as $barang)
                            @php
                                $jum = $jum + $barang->terjual;
                            @endphp
                          @empty
                          @endforelse
                    <span title="3 New Messages" class="badge badge-primary">{{ $jum }}</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                    {{-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fas fa-comments"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i> --}}
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead class="bg-primary">
                      <tr>
                        <th>Tanggal</th>
                        <th>Terjual</th>
                      </tr>      
                    </thead>
                    <tbody>
                      @php
                              $jum = 0;
                          @endphp
                        @forelse ($barangs as $barang)
                        <tr>
                          <td>{{$barang->tanggal->isoFormat('dddd, D MMM Y')}}</td>
                          <td>{{$barang->terjual}}</td>
                        </tr>
                          @php
                              $jum = $jum + $barang->terjual;
                          @endphp
                        @empty
                            <tr>
                              <td colspan="14">Tidak Ada Data Penjualan</td>
                            </tr>
                        @endforelse
                        <tr>
                          <th>Total :</th>
                          <th><strong>{{ $jum }}<strong></th>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            @empty
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr name="line_items" class="text-center">
                    <td colspan="4">
                      <span><i class="fas fa-shopping-cart fa-6x"></i></span> <br>
                      <span class="h4">Belum Ada Data Penjualan Yang Diimport</span><br>
                      <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-file-excel"></i> Import Data Penjualan</button>
                      <a href="#" data-placement="top" data-toggle="modal" data-target="#duplikatModal">
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table> 
      @endforelse
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
@stop