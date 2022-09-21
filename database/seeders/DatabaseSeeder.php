<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nama' => 'Prima Pangestu',
            'email' => 'primapangestu66@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        \App\Models\Setting::create([
            'daftar_penyelenggara' => 150000,
            'info_bank' => 'BCA 30189818 a/n Prima Pangestu',
        ]);
    }
}
