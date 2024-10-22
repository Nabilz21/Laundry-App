<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
        DB::table('users')->insert([
            [
            'nama' => 'Pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => Hash::make('pelanggan'),
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
