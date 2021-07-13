<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penjualan,App\StokBarang;

class Barang extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class,'kode_barang','kode_barang');
    }

    public function stokBarangs()
    {
        return $this->hasMany(StokBarang::class,'kode_barang','kode_barang');
    }
}
