<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Stok Awal</th>
      <th>Sisa Stok</th>
      <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
      @forelse ($stokBarangs as $barang)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$barang->barang->kode_barang}}</td>
        <td>{{$barang->barang->jenis_barang.' '.$barang->barang->merk.' '.$barang->barang->isi.' '.$barang->barang->satuan}}</td>
        <td>{{$barang->stok_awal}}</td>
        <td>{{$barang->tersisa}}</td>
        <td>
          <div class="d-flex">
            <button class="btn btn-sm btn-primary mr-1 mb-1" data-toggle="modal" data-target="#exampleModal-{{$barang->kode_barang}}"><i class="fas fa-eye" ></i></button>
            @if ($barang->stok_awal == $barang->tersisa)
              <a href="{{route('stok.show',$barang->id)}}" class="btn btn-sm btn-warning mr-1 mb-1"><i class="fas fa-edit"></i></a>  
            @else
              <a href="#" class="btn btn-sm btn-secondary mr-1 mb-1" data-toggle="tooltip" data-placement="top" title="Tidak Bisa Mengedit Data, Karena Data Telah Digunakan Pada Tabel Penjualan"><i class="fas fa-edit"></i></a>  
            @endif
            <form action="{{route('stok.destroy',$barang->id)}}" method="POST">
              @csrf
            <button type="submit" class="btn btn-sm btn-danger mr-1 mb-1"><i class="fas fa-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>  
      <!-- Modal -->
      <form action="{{ route('import.data-penjualan') }}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal-{{$barang->barang->kode_barang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Detail Stok Barang {{$barang->barang->kode_barang}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <ul>
                      <li>Kode Stok Barang   : {{$barang->barang->kode_barang}}</li>
                      <li>Jenis Stok Barang  : {{$barang->barang->jenis_barang}}</li>
                      <li>Merk Stok Barang   : {{$barang->barang->merk}}</li>
                        @if ($barang->barang->varian == null)
                          <li>Varian Stok Barang : Tidak Ada</li>  
                        @else
                          <li>Varian Stok Barang : {{$barang->barang->varian}}</li>                                       
                        @endif
                      <li>Isi           : {{$barang->barang->isi.' '.$barang->barang->satuan}}</li>
                      <li>Harga         : @currency($barang->barang->harga)</li>
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

        <div class="modal fade" id="hapusModal-{{$barang->barang->kode_barang}}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header justify-content-center bg-danger">
                  <div class="modal-title">
                      Hapus Data Stok {{$barang->barang->kode_barang}} : {{$barang->barang->jenis_barang.' '.$barang->barang->merk.' '.$barang->varian}} <i class="fas fa-question"></i>
                  </div>
              </div>
              <div class="modal-footer justify-content-center">
                  
                  <button type="submit" class="btn btn-success">Iya</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
          </div>
            </div>
          </div>
        </div>
      @empty
        <tr class="text-center">
          <td colspan="6">Tidak Ada Data</td>
        </tr>
      @endforelse
    </tbody>
</table>


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