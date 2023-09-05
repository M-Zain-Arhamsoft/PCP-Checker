<?php

namespace App\Imports;

use App\Models\SsbLead;
use Maatwebsite\Excel\Concerns\ToModel;

class SsbLeadsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SsbLead([
            //
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'documented_date' => $row['documented_date'],
            'case_id' => $row['case_id'],
            'uid' => $row['uid'],
            'source_id' => $row['source_id'],
            'docs' => $row['docs'],
        ]);
    }
}
