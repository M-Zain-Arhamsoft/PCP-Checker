<?php

namespace Database\Seeders;


use App\Models\PrimaryLead;
use Illuminate\Database\Seeder;


class PrimaryLeadsTableSeeder extends Seeder
{
    public function run()
    {
        $dummyData = [
            [
                'full_name' => 'Mr Johnjohn Copeland',
                'email' => 'johnderrickcopeland@yahoo.co.uk',
                'phone' => '07467946111',
            ],
            [
                'full_name' => 'Mr Lee Owen',
                'email' => 'lrjoinery@hotmail.co.uk',
                'phone' => '07860794653',
            ],
            // ... Add more data entries as needed ...
        ];

        foreach ($dummyData as $data) {
            $fullNameParts = explode(' ', $data['full_name']);
            $data['first_name'] = $fullNameParts[0];
            $data['last_name'] = implode(' ', array_slice($fullNameParts, 1));
            unset($data['full_name']); // Remove full_name as it's not a table column
            PrimaryLead::create($data);
        }
    }
}

