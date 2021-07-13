@if ($data == null)
<table class="table table-bordered table-striped table-responsive-xl">
  <thead class="bg-primary">
    <tr>
      <th>Tanggal</th>
      <th>Terjual</th>
      <th>Probabiltias</th>
      <th>Kumulatif</th>
      <th>Interval</th>
      <th>Angka Acak</th>
      <th>Prediksi</th>
    </tr>      
  </thead>
  <tbody>
    <tr class="text-center">
      <th colspan="7">
        Data Penjualan Kosong
      </th>
    </tr>    
  </tbody>
</table>
@elseif ($kurang)
<table class="table table-bordered table-striped table-responsive-xl">
  <thead class="bg-primary">
    <tr>
      <th>Tanggal</th>
      <th>Terjual</th>
      <th>Probabiltias</th>
      <th>Kumulatif</th>
      <th>Interval</th>
      <th>Angka Acak</th>
      <th>Prediksi</th>
    </tr>      
  </thead>
  <tbody>
    <tr class="text-center">
      <th colspan="7">
        Tidak Dapat Menganlisa Data, Data Penjualan Belum Lengkap
      </th>
    </tr>    
  </tbody>
</table>
@else
<div class="row">
  <div class="col text-center">
    <div class="card bg-light">
        <div class="card-body">
          @foreach ($data as $item => $barangs)
          @foreach ($bars as $barang)
                  @if ($barang->kode_barang == $item)
                  <h3> <i class="fas fa-chart-bar"></i> {{$item}} : <strong>{{ $barang->jenis_barang.' '.
                      $barang->merk.' '.
                      $barang->varian.' '.
                      $barang->isi.' '.
                      $barang->satuan }}</strong>
                  </h3>
                  <h5> Harga : <strong>@currency($barang->harga)</strong> Per {{ $barang->isi.' '. $barang->satuan}}</h5>
                  <div class="row justify-content-center">
                    <div class="col-xl-6">
                      <table class="table table-sm table-bordered" id="example1">
                        <tbody>
                          <tr>
                            <td>Kode Barang</td>
                            <td>{{$barang->kode_barang}}</td>
                          </tr> 
                          <tr>
                            <td>Jenis Barang</td>
                            <td>{{$barang->jenis_barang}}</td>
                          </tr> 
                          <tr>
                            <td>Merk Barang</td>
                            <td>{{$barang->merk}}</td>
                          </tr> 
                          @if ($barang->varian != null)
                            <tr>
                              <td>Varian Barang</td>
                              <td>{{$barang->varian}}</td>
                            </tr> 
                          @endif
                          <tr>
                            <td>Stok Awal Barang</td>
                            <td>{{$barang->stokBarangs[0]['stok_awal'] }} / {{ $barang->isi.' '. $barang->satuan}}</td>
                          </tr> 
                          <tr>
                            <td>Total Barang Terjual Bulan Ini</td>
                            <td>{{$barangs['jumlah']}} / {{ $barang->isi.' '. $barang->satuan}}</td>
                          </tr> 
                          <tr>
                            <td>Total Penjualan Bulan Ini</td>
                            <td>@currency($barangs['jumlah'] * $barang->harga)</td>
                          </tr> 
                          <tr>
                            <td>Prediksi Penjualan  Untuk Satu Bulan Kedepan</td>
                            <td>{{$barangs['prediksi_barang']}} / {{ $barang->isi.' '. $barang->satuan}}</td>
                          </tr> 
                          <tr>
                            <td>Prediksi Pendapatan Untuk Satu Bulan Kedepan</td>
                            <td>@currency($barangs['prediksi_barang'] * $barang->harga)</td>
                          </tr> 
                          <tr>
                            <td><strong>Sisa Stok Bulan Ini</strong></td>
                            <td>{{$barang->stokBarangs[0]['tersisa']}}</td>
                          </tr> 
                          <tr>
                            <td><strong>Prediksi Stok Barang yang harus disediakan Untuk Satu Bulan Kedepan</strong></td>
                            <td><strong>{{($barang->stokBarangs[0]['tersisa']) + $barangs['prediksi_barang']}}</strong></td>
                          </tr> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @if (Auth::user()->role == 0)
                  <div class="card-tools">
                    <a href="{{route('laporan.Cbarang',$barang->kode_barang)}}" class="btn btn-primary"> <i class="fas fa-file-pdf"></i> Cetak Laporan</a>
                  </div>
                  @endif
                  @endif
          @endforeach
        @endforeach
      </div>
    </div>
    
  </div>
</div>
<div class="row">
  <div class="col-lg-8">
    <table class="table table-sm table-bordered table-striped table-responsive-lg">
      <thead class="bg-primary">
        <tr>
          <th>Tanggal</th>
          <th>Terjual</th>
          <th>Probabiltias</th>
          <th>Kumulatif</th>
          <th>Interval</th>
        </tr>      
      </thead>
      <tbody>
        @forelse ($data as $item => $barangs)
        <tr class="text-center">
          @forelse ($barangs as $barang)
          @if ($loop->index <= 30)
          <tr>
            <td>{{Carbon\Carbon::parse($barang['tanggal'])->format('d-M-Y')}}</td>
            <td>{{$barang['terjual']}}</td>
            <td>{{$barang['probabilitas']}}</td>
            <td>{{$barang['kumulatif']}}</td>
            <td>{{$barang['interval']}}</td>
          </tr> 
          @endif
          
          @empty
              <tr>
                <td colspan="14">Tidak Ada Data Penjualan</td>
              </tr>
          @endforelse
          <tr>
            <th>Total</th>
            <th colspan="4"><strong>{{ $barangs['jumlah'] }}<strong></th>
          </tr>
        @empty
            
        @endforelse
        
      </tbody>
    </table>
  </div>
  <div class="col-lg-4">
    <table class="table table-sm table-bordered table-striped">
      <thead class="bg-primary">
        <tr class="text-center">
          <th colspan="3">Prediksi Barang Terjual Pada Bulan Berikutnya</th>
        </tr>
        <tr>
          <th>Tanggal</th>
          <th>Angka Acak</th>
          <th>Barang Terjual</th>
        </tr>      
      </thead>
      <tbody>
        @forelse ($data as $item => $barangs)
        <tr class="text-center">
          @forelse ($barangs as $barang)
          @if ($loop->index <= 30)
          <tr>
            <td>{{ Carbon\Carbon::parse($barang['tanggal'])->format('d')}}</td>
            <td>{{$barang['angka_acak']}}</td>
            <td>{{$barang['angka_prediksi']}}</td>
          </tr> 
          @endif
          
          @empty
              <tr>
                <td colspan="14">Tidak Ada Data Penjualan</td>
              </tr>
          @endforelse
          <tr>
            <th colspan="2">Total</th>
            <th><strong>{{ $barangs['prediksi_barang'] }}<strong></th>
          </tr>
        @empty
            
        @endforelse
        
      </tbody>
    </table>
  </div>
</div>
@endif
