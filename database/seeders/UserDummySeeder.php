<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Pelanggan;

class UserDummySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@klinik.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $userPegawai = User::create([
            'username' => 'pegawai1',
            'email' => 'pegawai@klinik.test',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
        ]);

        Pegawai::create([
            'id_user' => $userPegawai->id,
            'nama' => 'Budi Pegawai',
            'alamat' => 'Jl. Contoh No. 1',
            'no_telepon' => '081234567890',
            'jabatan' => 'Kasir',
        ]);

        $userPelanggan = User::create([
            'username' => 'pelanggan1',
            'email' => 'pelanggan@klinik.test',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'id_user' => $userPelanggan->id,
            'nama' => 'Siti Pelanggan',
            'alamat' => 'Jl. Pelanggan No. 2',
            'jenis_kelamin' => 'P',
            'no_telepon' => '089876543210',
        ]);
    }
}