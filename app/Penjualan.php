<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang,App\StokBarang;

class Penjualan extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function barang(){
        return $this->belongsTo(Barang::class,'kode_barang','kode_barang');
    }

    public function stokBarang(){
        return $this->belongsTo(Barang::class,'kode_barang','kode_barang');
    }

    protected $dates = ['tanggal'];

}
