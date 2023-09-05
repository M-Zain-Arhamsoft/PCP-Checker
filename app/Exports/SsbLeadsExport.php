<?php

namespace App\Exports;

use App\Models\SsbLead;
use Maatwebsite\Excel\Concerns\FromCollection;

class SsbLeadsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SsbLead::all();
    }
}
