<?php

namespace App\Http\Controllers;

use App\Barang,App\StokBarang,App\Penjualan;
use Illuminate\Http\Request;
use Validator;
use Session;

class StokBarangController extends Controller
{
    
    public function index()
    {
        $stokBarangs = StokBarang::all();
        return view('stok.index', compact('stokBarangs'));
    }

    public function buat()
    {
        $barangs = Barang::all();
        $kode = Barang::orderBy('kode_barang', 'desc')->first();
        $kode = substr($kode->kode_barang,1,3) + 1;
        $kode = 'B'.$kode;
        return view('stok.create', compact('barangs','kode'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except('_method','_token','submit');

      $validator = Validator::make($request->all(), [
         'kode_barang' => 'required|string|min:4|max:5',
         'stok' => 'required',
      ]);

      if ($validator->fails()) {
         return redirect()->Back()->withInput()->withErrors($validator);
      }
      
      if (StokBarang::where('kode_barang',$request->kode_barang)->where('periode',$request->periode)->first() != null) {
        Session::flash('message', 'Data Gagal Tersimpan! Sudah Terdapat Data Pada Periode Terkait');
        Session::flash('alert-class', 'alert-danger');
        return Back();
    }

      $barang = StokBarang::create([
        'kode_barang'   => $request->kode_barang,
        'stok_awal'     => $request->stok,
        'tersisa'       => $request->stok,
        'periode'       => $request->periode,
    ]);

      if($barang){
         Session::flash('success', 'Data Berhasil Ditambahkan!');
         Session::flash('alert-class', 'alert-success');
         return redirect()->route('stok');
      }else{
         Session::flash('message', 'Data Gagal Tersimpan!');
         Session::flash('alert-class', 'alert-danger');
      }

      return Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = StokBarang::find($id);
        $barangs = Barang::all();
        return view('stok.show', compact('barang','barangs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|string',
            'periode' => 'required|string',
            'stok' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        }
        $subject = StokBarang::find($id);

        $subject->update([
            'stok_awal' => $request->stok,
            'tersisa' => $request->stok,
        ]);

        $nama = $subject->barang->jenis_barang.' '.$subject->barang->merk.' '.$subject->barang->varian;

            Session::flash('success', 'Data '.$nama.' Berhasil Diperbarui!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('stok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stok= StokBarang::find($id);
        if (Penjualan::where('kode_barang',$stok->kode_barang)->whereMonth('tanggal',$stok->periode)->get()->isEmpty() == false) {
            Session::flash('message', 'Data Gagal Terhapus! Tedapat Data Penjualan Yang masih Terkait dengan data Stok');
            Session::flash('alert-class', 'alert-danger');
            return Back();
        }
        StokBarang::destroy($id);
        return redirect()->back()->with('success', 'Data '.$stok->kode_barang.' : '.$stok->jenis_barang.' '.$stok->merk.' '.$stok->varian.' Berhasil Dihapus! ',200);
    }

    public function getStok($periode){
        $stokBarangs = StokBarang::where('periode',$periode)->get();
        return view('stok.getStok', compact('stokBarangs','periode'));
    }
}
