<?php

namespace App\Exports;

use App\emrecords;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return emrecords::all();
    }
}
