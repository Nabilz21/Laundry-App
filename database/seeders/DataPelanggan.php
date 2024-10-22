<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DataPelanggan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggan')->insert([
            [
                'user_id' => 2,
                'alamat' => 'Mojokerto',
                'no_hp' => '0897647334',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
