<?php

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guru::create([
            'nama_lengkap' => 'Z Mardino Santosa',
            'nik' => '12345',
            'bidang_studi' => 'bahasa',
            'kelamin' => 'l',
            'alamat' => 'jl. sukabumi no. 11',
            'handphone' => '085299977945'
        ]);
    }
}
