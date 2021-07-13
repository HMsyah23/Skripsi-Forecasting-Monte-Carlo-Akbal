<?php

namespace App\Http\Controllers;

use PDF;
use Storage;
use App\StokBarang,App\Barang,App\Penjualan;
use Illuminate\Http\Request;
use Session;

class LaporanController extends Controller
{
    public function laporanSeluruhBarang(){
		$penjualans = Penjualan::all()->groupBy('kode_barang');
        $bars= Barang::all();
        $data = $penjualans->toArray();

        foreach ($data as $item => $barangs) {
            foreach ($bars as $barang) {
                if ($barang->kode_barang == $item) {
                    if($barang->stokBarangs->isEmpty()){
                        Session::flash('message', 'Terjadi Kesalahan, Terdapat Data Yang Belum Distok');
                        Session::flash('alert-class', 'alert-danger');
                        return Back();
                    }
                }
            }
        }
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

        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datas = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);

        // dd($pengajars);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.semuaBarang',compact('data','bars','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}

    public function laporanBarang($kode_barang){
		$penjualans = Penjualan::where('kode_barang',$kode_barang)->get()->groupBy('kode_barang');
        $bars= Barang::where('kode_barang',$kode_barang)->get();
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

        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datas = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);

        // dd($pengajars);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.barang',compact('data','bars','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}

    public function laporanBarangAja(){
        $bars= Barang::all();
        
        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datas = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);

        // dd($pengajars);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.barangAja',compact('bars','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}

    public function laporanBarangStok(){
        $stokBarangs= StokBarang::all()->groupBy('periode');    

        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datas = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);

        // dd($pengajars);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.barangStok',compact('stokBarangs','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}
}
