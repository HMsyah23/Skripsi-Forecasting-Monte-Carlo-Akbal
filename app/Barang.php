<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penjualan;

class Barang extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class,'kode_barang','kode_barang');
    }
}
