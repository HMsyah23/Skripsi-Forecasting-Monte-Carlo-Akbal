<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang,App\Penjualan;

class StokBarang extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function barang(){
        return $this->belongsTo(Barang::class,'kode_barang','kode_barang');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class,'kode_barang','kode_barang');
    }
}
