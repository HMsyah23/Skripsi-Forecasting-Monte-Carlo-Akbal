@extends('adminlte::page')

@section('title', 'Data Barang')

@section('content_header')
    <div class="row justify-content-between">
      <h1> <i class="fas fa-shopping-bag ml-2"></i> Data Barang</h1>
      <div class="d-flex justify-content-end">
      <a href="{{route('barang.buat')}}" class="btn btn-success mr-2"> <i class="fas fa-plus-circle"></i> Tambah Data</a>
      @if (Auth::user()->role == 0)
        <a href="{{route('laporan.barang.aja')}}" class="btn btn-success mr-2"> <i class="fas fa-file-pdf"></i> Cetak Laporan Seluruh Barang</a>
      @endif
      </div>
    </div>
@stop

@section('content')
    <p class="alert alert-info"> <i class="fas fa-info"></i> Daftar data barang.</p>

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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode Barang</th>
                  <th>Jenis Barang</th>
                  <th>Merk Barang</th>
                  <th>Isi</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($barangs as $barang)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$barang->kode_barang}}</td>
                    <td>{{$barang->jenis_barang}}</td>
                    <td>{{$barang->merk}}</td>
                    <td>{{$barang->isi.' '.$barang->satuan}}</td>
                    <td>@currency($barang->harga)</td>
                    <td>
                      <div class="d-flex">
                        <button class="btn btn-sm btn-primary mr-1 mb-1" data-toggle="modal" data-target="#exampleModal-{{$barang->kode_barang}}"><i class="fas fa-eye" ></i></button>
                        <a href="{{route('barang.show',$barang->id)}}" class="btn btn-sm btn-warning mr-1 mb-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger mr-1 mb-1" data-toggle="modal" data-target="#hapusModal-{{$barang->kode_barang}}"><i class="fas fa-trash"></i></button>
                      </div>
                    </td>
                  </tr>  
                  <!-- Modal -->
                  <form action="{{ route('import.data-penjualan') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="exampleModal-{{$barang->kode_barang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Barang {{$barang->kode_barang}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                <ul>
                                  <li>Kode Barang   : {{$barang->kode_barang}}</li>
                                  <li>Jenis Barang  : {{$barang->jenis_barang}}</li>
                                  <li>Merk Barang   : {{$barang->merk}}</li>
                                    @if ($barang->varian == null)
                                      <li>Varian Barang : Tidak Ada</li>  
                                    @else
                                      <li>Varian Barang : {{$barang->varian}}</li>                                       
                                    @endif
                                  <li>Isi           : {{$barang->isi.' '.$barang->satuan}}</li>
                                  <li>Harga         : @currency($barang->harga)</li>
                                </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-file-excel"></i> Import</button> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </form> 

                    <div class="modal fade" id="hapusModal-{{$barang->kode_barang}}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header justify-content-center bg-danger">
                              <div class="modal-title">
                                  Hapus Data {{$barang->kode_barang}} : {{$barang->jenis_barang.' '.$barang->merk.' '.$barang->varian}} <i class="fas fa-question"></i>
                              </div>
                          </div>
                          <div class="modal-footer justify-content-center">
                              <form action="{{route('barang.destroy',$barang->id)}}" method="POST">
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
    <form action="{{ route('barang.store') }}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="tambahModalLabel">Tambah Data Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang...." value="{{old('kode_barang')}}">
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
    $("select").select2({
      tags: true,
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      tags: true,
    })
  })
</script>
@stop