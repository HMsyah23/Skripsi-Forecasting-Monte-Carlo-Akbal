<?php

namespace App\Http\Controllers;

use App\Barang;
use App\StokBarang;
use App\Penjualan;
use Session;
use Storage;
use App\Imports\BarangsImport;
use App\Imports\PenjualanImport;
use App\Exports\BarangsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Validator;

class PenjualanController extends Controller
{

    public function index()
    {
        $penjualans = Penjualan::all()->groupBy('kode_barang');
        $barangs = barang::all();
        return view('penjualan-barang',compact('penjualans'));
    }

    public function getPenjualan($periode)
    {
        $penjualans = Penjualan::whereMonth('tanggal',$periode)->get()->groupBy('kode_barang');
        $barangs = barang::all();
        return view('penjualan',compact('penjualans'));
    }


    public function tambahData()
    {
        $penjualans = Penjualan::all()->groupBy('kode_barang');
        $barangs = barang::all();
        $start = Carbon::now()->startOfMonth()->format('d-m-Y');
        $end = Carbon::now()->endOfMonth()->format('d-m-Y');

        $period = CarbonPeriod::create($start, $end);
        // Convert the period to an array of dates
        $dates = $period->toArray();
        return view('prediksi.tambahData',compact('dates','barangs','penjualans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        // dd($r->penjualan);

        $r->validate([
            'id_barang' => 'required',
            'penjualan' => 'required',
        ], [
            'penjualan.required'        => 'Penjualan Tidak Boleh Kosong',
        ]);

        $nama = Barang::where('kode_barang',$r->id_barang)->first();
        $nama = $nama->jenis_barang.' '.$nama->merk.' '.$nama->varian.' '.$nama->isi.' '.$nama->satuan;
        $stok = StokBarang::all()->groupby('periode');
        

        foreach ($r->penjualan as $key => $value) {
            if ($value['tanggal'] == null) {
                Session::flash('error', "Terdapat Tanggal Yang Kosong");
                return redirect()->back();
            }
            if ($value['terjual'] == null) {
                Session::flash('error', "Terdapat Form Terjual Yang Kosong");
                return redirect()->back();
            }
        }
        
        $new_array = array();
        $exists_array    = array();
        foreach( $r->penjualan as $element ) {
            if( !in_array( $element['tanggal'], $exists_array )) {
                $exists_array[]    = $element['tanggal'];
            }
            else{
                Session::flash('error', "Terdapat Tanggal yang sama");
                return redirect()->back();
            }
            $new_array[] = $element;
        }
        
        foreach ($r->penjualan as $key => $value) {
            if ($stok->has(intval(Carbon::parse($value['tanggal'])->format('m')))) {
                
            } else {
                Session::flash('error', "Data ".$nama." Pada Tanggal ".Carbon::parse($value['tanggal'])->isoFormat('D MMMM Y')." Gagal Tersimpan, Persediaan Bulan ".Carbon::parse($value['tanggal'])->isoFormat('MMMM')." Belum Distok");
                return redirect()->back();
            }
        }

        foreach ($r->penjualan as $key => $value) {
            $validasi = Penjualan::where('kode_barang',$r->id_barang)->where('tanggal',$value['tanggal'])->first();
            if ($validasi != null) {
                Session::flash('error', "Data Transaksi ".$nama." Pada Tanggal ".Carbon::parse($value['tanggal'])->isoFormat('D MMMM Y')." Sudah Input");
                return redirect()->back();
            }
        }

        $collection = collect($r->penjualan);

        $jum = new \stdClass();
        
        foreach ($collection as $key => $value) {
            if ($stok->has(intval(Carbon::parse($value['tanggal'])->format('m')))) {     
                if (Carbon::parse($collection[$key]['tanggal'])->format('m')) {
                    $a = Carbon::parse($collection[$key]['tanggal'])->format('m');
                    if(!isset($jum->$a)){
                        $jum->$a = 0;
                    }
                    $jum->$a = $collection[$key]['terjual'] + $jum->$a;
                }
            }
        }

        foreach ($jum as $key => $value) {
            if  ($value > StokBarang::where('periode',intval($key))->first()->tersisa) {
                Session::flash('error', "Stok ".$nama." Kurang");
                return redirect()->back();
            }
        }

        foreach ($jum as $key => $value) {
            $stokBarang = StokBarang::where('periode',intval($key))->first();
            $stok = StokBarang::where('periode',intval($key))->first()->tersisa;
            $stokBarang->update([
                'tersisa' => $stok - $value,
            ]);
        }
        
        foreach ($r->penjualan as $key => $value) {
            $barang = Penjualan::create([
                'kode_barang'   => $r->id_barang,
                'tanggal'       => $value['tanggal'],
                'terjual'       => $value['terjual'],
            ]);
        }

        return redirect()->route('penjualan-barang')->with('message', 'Data '.$nama.' Berhasil Ditambahkan');
    }


    public function show(Penjualan $penjualan)
    {
        //
    }


    public function edit(Penjualan $penjualan)
    {
        //
    }


    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }


    public function destroy(Penjualan $penjualan)
    {
        //
    }

    public function import(Request $r) 
    {
        $data = $r->except('_method','_token','submit');

        $validator = Validator::make($r->all(), [
            'data-penjualan' => 'required||mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }

        // Penjualan::truncate();
        $data = Excel::toArray(new PenjualanImport, $r->file('data-penjualan'));
        $data = $data[0];
        if ((array_keys($data[0])[0] != "kode_barang") || (array_keys($data[0])[1] != "tanggal") || (array_keys($data[0])[2] != "terjual")) {
            return redirect()->back()->with('error', '<strong>Format yang diimport Tidak Sesuai</strong> <a href="../format/format_pendataan.xlsx"><u>Silahkan Download Contoh Format Data Excel</u></a> ');
        }
        
        foreach ($data as $key => $value) {
            // dump($value);
            $data[$key]['tanggal'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(($value['tanggal']))->format('Y-m-d');
        }

        $collection = collect($data);
        $collection1 = $collection->groupBy([function($val) {
            return Carbon::parse($val['tanggal'])->format('m');
        },'kode_barang']);
        $collection2 = $collection->groupBy([function($val) {
            return Carbon::parse($val['tanggal'])->format('m');
        },'kode_barang']);
        
        foreach ($collection1 as $key1 => $value) {
            foreach ($value as $key2 => $transaksi) {
                $jum = 0;
                foreach ($transaksi as $key3 => $value) {
                    $jum = $value['terjual'] + $jum;
                    $penjualan = Penjualan::where('kode_barang',$key2)->where('tanggal',$value['tanggal'])->first();
                    if ($penjualan != null) {
                        return redirect()->back()->with('error', '<strong>Terjadi Kesalahan, Data Gagal Di import</strong> (Terdapat Bentrok Data) <br> Data Pada Tanggal : '.$value['tanggal'].' Telah diinput sebelumnya <br> Silahkan Periksa Kembali File Anda');
                    }
                }
                $transaksi['jumlah'] = $jum;
                $stok = StokBarang::where('kode_barang',$key2)->where('periode',intval($key1))->first()->tersisa;
                $barang = Barang::where('kode_barang',$key2)->first();
                $nama = $barang->jenis_barang.' '.$barang->merk.' '.$barang->varian.' '.$barang->isi.' '.$barang->satuan;
                if($transaksi['jumlah'] > $stok){
                    return redirect()->back()->with('error', '<strong>Terjadi Kesalahan, Data Gagal Di import</strong> (Jumlah Barang '. $nama.' Melebihi Stok yang tersedia) <br>Stok Tersedia : '.$stok.'<br> Jumlah Barang : '.$transaksi['jumlah']);
                }
            }
        }

        foreach ($collection2 as $key1 => $value) {
            foreach ($value as $key2 => $transaksi) {
                $jum = 0;
                foreach ($transaksi as $key3 => $value) {
                    $jum = $value['terjual'] + $jum;
                }
                $transaksi['jumlah'] = $jum;
                $stokBarang = StokBarang::where('kode_barang',$key2)->where('periode',intval($key1))->first();
                $stok = StokBarang::where('kode_barang',$key2)->where('periode',intval($key1))->first()->tersisa;
                $barang = Barang::where('kode_barang',$key2)->first();
                $stokBarang->update([
                    'tersisa' => $stok - $transaksi['jumlah'],
                ]);
            }
        }

        Excel::import(new PenjualanImport, $r->file('data-penjualan'));
        return redirect()->back()->with('message', 'Data Penjualan Berhasil Diimport');
    }

    public function export() 
    {
        return Excel::download(new BarangsExport, 'users.xlsx');
    }

    public function analisa()
    {
        $penjualans = Penjualan::all()->groupBy('kode_barang');
        $bars = barang::all();
        $data = $penjualans->toArray();
        
        $var = '43 - 425';
        $ex = explode( '-', $var );
        foreach ($data as $item => $barangs) {
            $jum = 0;
            $tot = 0;
            foreach ($barangs as $barang) {
                $jum = $jum + $barang['terjual'];
            }
            $data[$item]['jumlah'] = $jum;

            $i = 0;
            $kumulatif = 0;
            $q = 0;
            foreach ($barangs as $barang) {
                $data[$item][$i]['probabilitas'] = number_format($barang['terjual']/$jum,3);
                $data[$item][$i]['kumulatif'] = number_format($kumulatif + $data[$item][$i]['probabilitas'],3);
                $data[$item][$i]['interval'] = ($kumulatif * 1000 + $q)." - ".(number_format($kumulatif + $data[$item][$i]['probabilitas'],3)* 1000);
                $q = 1;
                $kumulatif = $kumulatif + $data[$item][$i]['probabilitas'];
                $tot = $tot + $data[$item][$i]['probabilitas'];
                $i =+ $i + 1;
                
            }
            $i = 0;
            $j = 0;
            // Variabel Angka Acak
            $json = Storage::disk('public')->get('parameter.json');
            $param = json_decode($json, true);
            $a=$param['parameter']['a'];
            $c=$param['parameter']['c'];
            $Z=$param['parameter']['z'];
            $m=$param['parameter']['m'];
            $dat = $a * $Z+$c;
            // Variabel Angka Acak

            $prediksi = 0;

            a:
            foreach($barangs as $barang){
                $zi = $dat % $m;
                $zii = $zi * 10;
                if($j >= 31){
                    goto b;
                }
                $ex = explode( ' - ', $data[$item][$i]['interval'] );
                if ($zii >= $ex[0]) {                                 
                    if ($zii <= $ex[1]) {   
                        $data[$item][$j]['angka_mod'] = $zi;
                        $data[$item][$j]['angka_acak'] = $zii;
                        $data[$item][$j]['angka_prediksi'] = $data[$item][$i]['terjual'];
                        $dat = $a * $zi + $c;                 
                        $j = $j + 1;
                        $prediksi = $prediksi + $data[$item][$i]['terjual'];
                        $i = 0;
                        goto a;
                    }   else {
                        $i = $i + 1;
                        goto a;
                    }
                }
            }
            b:
            $data[$item]['prediksi_barang'] = $prediksi;
            $data[$item]['total'] = number_format($tot,2);
        
        }

        return view('prediksi.penjualan-barang',compact('bars','data'));
    }


    public function getBarang($periode,$kode_barang){
        $penjualans = Penjualan::where('kode_barang',$kode_barang)->whereMonth('tanggal',$periode)->get()->groupBy('kode_barang');
        
        $barang = Penjualan::where('kode_barang',$kode_barang)->whereMonth('tanggal',$periode)->first();
        $bars = barang::all();
        $data = $penjualans->toArray();

        foreach ($data as $item => $barangs) {
            $jum = 0;
            $tot = 0;
            foreach ($barangs as $barang) {
                $jum = $jum + $barang['terjual'];
            }
            $data[$item]['jumlah'] = $jum;

            $i = 0;
            $kumulatif = 0;
            $q = 0;
            foreach ($barangs as $barang) {
                $data[$item][$i]['probabilitas'] = number_format($barang['terjual']/$jum,3);
                $data[$item][$i]['kumulatif'] = number_format($kumulatif + $data[$item][$i]['probabilitas'],3);
                $data[$item][$i]['interval'] = ($kumulatif * 1000 + $q)." - ".(number_format($kumulatif + $data[$item][$i]['probabilitas'],3)* 1000);
                $q = 1;
                $kumulatif = $kumulatif + $data[$item][$i]['probabilitas'];
                $tot = $tot + $data[$item][$i]['probabilitas'];
                $i =+ $i + 1;
                
            }
            $i = 0;
            $j = 0;
            // Variabel Angka Acak
            $json = Storage::disk('public')->get('parameter.json');
            $param = json_decode($json, true);
            $a=$param['parameter']['a'];
            $c=$param['parameter']['c'];
            $Z=$param['parameter']['z'];
            $m=$param['parameter']['m'];
            $dat = $a * $Z+$c;
            // Variabel Angka Acak

            $prediksi = 0;

            a:
            foreach($barangs as $barang){
                $zi = $dat % $m;
                $zii = $zi * 10;
                if($j >= 31){
                    goto b;
                }
                $ex = explode( ' - ', $data[$item][$i]['interval'] );
                if ($zii >= $ex[0]) {                                 
                    if ($zii <= $ex[1]) {   
                        $data[$item][$j]['angka_mod'] = $zi;
                        $data[$item][$j]['angka_acak'] = $zii;
                        $data[$item][$j]['angka_prediksi'] = $data[$item][$i]['terjual'];
                        $dat = $a * $zi + $c;                 
                        $j = $j + 1;
                        $prediksi = $prediksi + $data[$item][$i]['terjual'];
                        $i = 0;
                        goto a;
                    }   else {
                        $i = $i + 1;
                        goto a;
                    }
                }
            }
            b:
            $data[$item]['prediksi_barang'] = $prediksi;
            $data[$item]['total'] = number_format($tot,2);
        
        }
        $kurang = false;
        
        if ($penjualans->isEmpty()) {
            return view('prediksi.getBarang',compact('kurang','bars','data'));
        }

        if (count($penjualans[$barang['kode_barang']]) < 30) {
            $kurang = true;
            return view('prediksi.getBarang',compact('kurang','bars','data'));
        }

        if($periode >= 12){
            $nextMonth = 1;
        } else{
            $nextMonth = $periode + 1;
        }
        $stok = StokBarang::where('kode_barang',$kode_barang)->where('periode',$periode)->first();
        
        if(StokBarang::where('kode_barang',$kode_barang)->where('periode',$nextMonth)->exists()){
            $tersedia = StokBarang::where('kode_barang',$kode_barang)->where('periode',$nextMonth)->first();
            $sisa = StokBarang::where('kode_barang',$kode_barang)->where('periode',$nextMonth)->first()->tersisa;
            if ($tersedia->stok_awal == $sisa) {
                $tersedia->update([
                    'kode_barang'   => $kode_barang,
                    'stok_awal'     => $data[$kode_barang]['prediksi_barang'] + $stok->tersisa,
                    'tersisa'       => $data[$kode_barang]['prediksi_barang'] + $stok->tersisa,
                    'periode'       => $nextMonth,
                ]);
            } 
        }else {
            $barang = StokBarang::create([
                'kode_barang'   => $kode_barang,
                'stok_awal'     => $data[$kode_barang]['prediksi_barang'] + $stok->tersisa,
                'tersisa'       => $data[$kode_barang]['prediksi_barang'] + $stok->tersisa,
                'periode'       => $nextMonth,
            ]);
        }

        return view('prediksi.getBarang',compact('kurang','bars','data'));
    }

    public function reset(){
        $stokBarangs = StokBarang::all();

        foreach ($stokBarangs as $key => $value) {
            $stokBarang = StokBarang::find($value['id']);
            $stokBarang->update([
                'tersisa' => $value['stok_awal'],
            ]);
        }
        
        Penjualan::truncate();
        return redirect()->route('penjualan-barang')->with('message', 'Data Berhasil Direset');
    }
}
