<?php

namespace App\Imports;

use App\Penjualan;
use Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class PenjualanImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new DataPenjualanImport(),
        ];
    }

    
}
