<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'uuid'          => '39a880c0-9ae6-41c9-ba92-fba9e8696b84',
                'name_category' => 'POWER',
            ],
            [
                'uuid'          => '99ed9132-9ba6-4303-8dd3-f654c140237a',
                'name_category' => 'REMOTE',
            ],
            [
                'uuid'          => '9577f2b7-0bd1-4c59-8c31-66ea8f8d2be5',
                'name_category' => 'KWH MONITORING',
            ],
            [
                'uuid'          => '79a230ab-e552-43ed-be89-4acfec779025',
                'name_category' => 'SENSOR TH',
            ],
        ];

        DB::table('categories')->insert($data);
    }
}
