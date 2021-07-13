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