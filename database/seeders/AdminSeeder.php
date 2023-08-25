<?php

namespace Database\Seeders;

use App\Models\Admin;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nama' => 'Admin',
            'no_tlp' => '081234567890',
            'jenis_kelamin' => 'Pria',
            'alamat' => 'Bali, Indonesia',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@gmail.com',
        ]);
    }
}
