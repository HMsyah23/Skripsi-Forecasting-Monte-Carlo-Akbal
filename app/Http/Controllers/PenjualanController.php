<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Penjualan;
use App\Imports\BarangsImport;
use App\Imports\PenjualanImport;
use App\Exports\BarangsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    public function index()
    {
        $penjualans = Penjualan::all()->groupBy('kode_barang');
        $barangs = barang::all();
        return view('penjualan-barang',compact('penjualans'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
        Penjualan::truncate();
        Excel::import(new PenjualanImport, $r->file('data-penjualan'));

        return redirect()->back()->with('success', 'All good!');
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
            $a=14;
            $c=21;
            $Z=22;
            $m=66;
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

        // dd($data);

        return view('prediksi.penjualan-barang',compact('bars','data'));
    }


    public function getBarang($kode_barang){
        $penjualans = Penjualan::where('kode_barang',$kode_barang)->get()->groupBy('kode_barang');
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
            $a=14;
            $c=21;
            $Z=22;
            $m=66;
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
        
        return view('prediksi.getBarang',compact('bars','data'));
    }
}
