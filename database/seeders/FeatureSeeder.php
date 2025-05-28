<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeatureSeeder extends Seeder
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
                'uuid'          => "49378b8e-0936-481e-b96d-c4a21d6050b5",
                'id_categories' => "39a880c0-9ae6-41c9-ba92-fba9e8696b84",
                'name_feature'  => '[POWER] LAMP'
            ],
            // [
            //     'uuid'          => "c177026d-14c5-4581-af70-1957ec1a278c",
            //     'id_categories' => "39a880c0-9ae6-41c9-ba92-fba9e8696b84",
            //     'name_feature'  => '[POWER] AC'
            // ],
            [
                'uuid'          => "bc356703-b374-4fd8-a551-084ff843df04",
                'id_categories' => "99ed9132-9ba6-4303-8dd3-f654c140237a",
                'name_feature'  => '[REMOTE] AC'
            ],
            [
                'uuid'          => "0b3c3c8f-b971-44e3-bf29-f3e1b4d329fc",
                'id_categories' => "99ed9132-9ba6-4303-8dd3-f654c140237a",
                'name_feature'  => '[REMOTE] CURTAIN'
            ],
            [
                'uuid'          => "d82d40a8-002d-4566-a499-7df64d42131b",
                'id_categories' => "9577f2b7-0bd1-4c59-8c31-66ea8f8d2be5",
                'name_feature'  => '[MONITORING] KWH MONITORING'
            ],
            [
                'uuid'          => "98b4b4f3-0431-409b-9d42-ebf2e801192f",
                'id_categories' => "79a230ab-e552-43ed-be89-4acfec779025",
                'name_feature'  => '[SENSOR TH] TEMPERATURE SENSOR'
            ],
        ];

        DB::table('feature')->insert($data);
    }
}
