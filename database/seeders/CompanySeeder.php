<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'name' => 'Company Malta',
                'bank_account' => '592102010001491',
                'vat_rate' => 12.05,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'Company Cyprus',
                'bank_account' => '000020246590523',
                'vat_rate' => 4.5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'name' => 'Company Brazil',
                'bank_account' => '00345060206060',
                'vat_rate' => 7.21,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'name' => 'Company Dubai',
                'bank_account' => '88969594969494',
                'vat_rate' => 8.8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
