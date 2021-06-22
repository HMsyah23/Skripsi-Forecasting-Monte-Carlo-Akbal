<?php

namespace App\Imports;

use App\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'kode_barang'  => $row['kode_barang'],
            'jenis_barang'  => $row['jenis_barang'],
            'merk'         => $row['merk'],
            'varian'       => $row['varian'],
            'satuan'       => $row['satuan'],
            'isi'          => $row['isi'],
            'harga'        => $row['harga'],
        ]);
    }
}
