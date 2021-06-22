<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Seluruh Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
  <style>
    #header,
    #footer {
      position: fixed;
      left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }
    #header {
      top: 0;
        border-bottom: 0.1pt solid #aaa;
    }
    #footer {
      bottom: 0;
      border-top: 0.1pt solid #aaa;
    }
    .page-number:before {
        text-align: center;
        float: right;
        color: black;
      content: "Toko Sembako Barakallah  | Hal " counter(page);
    }

    .page-break {
        page-break-after: always;
    }

    h1 {
        font-size: 40px;
    }

    h2 {
        font-size: 30px;
    }

    p {
        font-size: 12px;
        line-height:80%;
    }

    td{
      font-size: 12px;
      text-align: left;
      vertical-align: middle;
    }

    th{
      text-align: center;
      font-size: 12px;
    }
    .table > tbody > tr > td {
     vertical-align: middle;
    }
    </style>
<div>
  <div id="footer">
    <div class="page-number"></div>
  </div>
  <img src="{{$base64}}" width="100%" height="140"/>
  <table class="table table-sm table-borderless" style="border: white;">
    <thead class="mb-0">
      <tr>
        <th style="text-align: center; vertical-align: middle; font-size: 25px;" class="text-underline"><u>Laporan Barang</u></th>
    </tr>
    <tr>
      <th style="text-align: center; vertical-align: middle;">Laporan Seluruh Barang</th>
    </tr>
    </thead>
  </table>
  @foreach ($data as $item => $barangs)
  @foreach ($bars as $barang)
          @if ($barang->kode_barang == $item)
          <div class="row justify-content-center">
            <div class="col-xl-4">
              <table class="table table-sm table-bordered">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th colspan="2">
                       <i class="fas fa-chart-bar"></i> {{$item}} : <strong>{{ $barang->jenis_barang.' '.
                        $barang->merk.' '.
                        $barang->varian.' '.
                        $barang->isi.' '.
                        $barang->satuan }}</strong>
                    
                    </th>
                  </tr>
                  <tr class="text-center">
                    <th colspan="2">
                       Harga : <strong>@currency($barang->harga)</strong> Per {{ $barang->isi.' '. $barang->satuan}}
                    </th>
                  </tr>
                </thead>
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
                </tbody>
              </table>
            </div>
          </div>
          @endif
  @endforeach
@endforeach

<table class="table text-right table-borderless">
  <tr>
    <td>Yang Bertanggung Jawab atas laporan ini,</td>
  </tr>
  <tr>
    <td style="height: 50px;"></td>
  </tr>
  <tr>
    <td><u>(............................................................)</u></td>
  </tr>
</table>

<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>