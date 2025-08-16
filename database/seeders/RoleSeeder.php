<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'u_id' => 99,
            'name' => 'Ultraman',
            'nama' => 'Super User',
        ]);
        Role::create([
            'u_id' => 98,
            'name' => 'IT',
            'nama' => 'Tim IT',
        ]);
        Role::create([
            'u_id' => 1,
            'name' => 'Koc',
            'nama' => 'Ketua OSOKA',
        ]);
        Role::create([
            'u_id' => 2,
            'name' => 'Admin',
            'nama' => 'Administrator',
        ]);
        Role::create([
            'u_id' => 3,
            'name' => 'Materi',
            'nama' => 'Item Bank Administrator',
        ]);
        Role::create([
            'u_id' => 4,
            'name' => 'Mhs',
            'nama' => 'Mahasiswa',
        ]);
        Role::create([
            'u_id' => 5,
            'name' => 'Penguji',
            'nama' => 'Penguji',
        ]);
        Role::create([
            'u_id' => 6,
            'name' => 'ps',
            'nama' => 'Pasien Simulasi',
        ]);
        Role::create([
            'u_id' => 7,
            'name' => 'pps',
            'nama' => 'Pelatih Pasien Simulasi',
        ]);
    }
}
