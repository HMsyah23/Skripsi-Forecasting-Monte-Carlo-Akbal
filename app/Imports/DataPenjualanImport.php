<?php

namespace App\Imports;

use App\Penjualan;
use Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DataPenjualanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penjualan([
            'kode_barang'     => $row['kode_barang'],
            'tanggal'  => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])),
            'terjual'  => $row['terjual'],
        ]);
    }
}
