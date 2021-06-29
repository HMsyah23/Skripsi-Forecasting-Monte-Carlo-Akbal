<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Penjualan;
use App\Imports\BarangsImport;
use App\Imports\PenjualanImport;
use App\Exports\BarangsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;
use Session;

class BarangController extends Controller
{

    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function buat()
    {
        $barangs = Barang::all();
        $kode = Barang::orderBy('kode_barang', 'desc')->first();
        $kode = substr($kode->kode_barang,1,3) + 1;
        $kode = 'B'.$kode;
        return view('barang.create', compact('barangs','kode'));
    }
    

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->except('_method','_token','submit');

      $validator = Validator::make($request->all(), [
         'kode_barang' => 'required|string|min:4|max:5',
         'jenis_barang' => 'required|string|max:30',
         'merk' => 'required|string|max:30',
         'varian' => 'max:50',
         'satuan' => 'required|string|max:15',
         'isi' => 'required|string|max:10',
         'harga' => 'required|numeric',
      ]);

      if ($validator->fails()) {
         return redirect()->Back()->withInput()->withErrors($validator);
      }

      if($record = Barang::firstOrCreate($data)){
         Session::flash('success', 'Data Berhasil Ditambahkan!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('barang');
      }else{
         Session::flash('message', 'Data Gagal Tersimpan!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back();
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        $barangs = Barang::all();
        return view('barang.show', compact('barang','barangs'));
    }


    public function edit(Barang $barang)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string|min:3',
            'jenis_barang' => 'required|string|min:3',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
        $subject = Barang::find($id);

        if($subject->update($data)){
            Session::flash('success', 'Data Berhasil Diperbarui!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('barang');
        }else{
            Session::flash('message', 'Data Gagal Diperbarui!');
            Session::flash('alert-class', 'alert-danger');
        }

        return Back()->withInput();
    }


    public function destroy($id)
    {
        $kode_barang = Barang::find($id)->kode_barang;
        $jenis_barang = Barang::find($id)->jenis_barang;
        $merk = Barang::find($id)->merk;
        $varian = Barang::find($id)->varian;
        Barang::destroy($id);
        return redirect()->back()->with('success', 'Data '.$kode_barang.' : '.$jenis_barang.' '.$merk.' '.$varian.' Berhasil Dihapus! ',200);
    }
}
