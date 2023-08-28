<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SsbLeadsTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Insert 20 entries with default values
        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'created_at' => $now,
                'updated_at' => $now,
                'documented_date' => $now,
                'case_id' => 123,
                'uid' => 'UID_'.$i,
                'source_id' => 'Source_'.$i,
                // Add more fields with default values here

                // ...
            ];

            DB::table('ssb_leads')->insert($data);
        }
    }
}
