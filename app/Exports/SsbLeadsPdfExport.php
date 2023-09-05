<?php

namespace App\Exports;

use App\Models\SsbLead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class SsbLeadsPdfExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return SsbLead::all();
    }
}
