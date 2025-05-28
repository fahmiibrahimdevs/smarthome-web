<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthMQTTSeeder extends Seeder
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
                'uuid'      => '99fa9bc5-632d-4a9b-bv12-bas98d5fc83f',
                'host'      => '159.223.61.133',
                'username'  => 'mecharoot',
                'password'  => 'mecharnd595',
                'port'      => '9001',
            ],
        ];

        DB::table('mqtt')->insert($data);
    }
}
