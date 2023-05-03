<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pegawai
        $pegawai = Pegawai::create([
            'nama' => 'Alex Pegawai',
            'no_tlp' => '089671xxxxxx',
            'jenis_kelamin' => 'Pria',
            'alamat' => 'Bali, Indonesia',
            'username' => 'pegawai',
            'password' => Hash::make('pegawai'),
            'jabatan' => 'Pegawai',
        ]);
        
        // Nasabah
    }
}
