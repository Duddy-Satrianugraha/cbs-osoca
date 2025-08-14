<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Super admin",
            'username' => "ultraman",
            'slug' => 'xxx_999_1',
            'email' => 'ultra@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas IT",
            'username' => "it",
            'slug' => 'xxx_999_2',
            'email' => 'it@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas koc",
            'username' => "koc",
            'slug' => 'xxx_999_3',
            'email' => 'koc@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas admin",
            'username' => "admin",
            'slug' => 'xxx_999_4',
            'email' => 'admin@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas Materi",
            'username' => "materi",
            'slug' => 'xxx_999_5',
            'email' => 'materi@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas Mahasiswa",
            'username' => "mahasiswa",
            'slug' => 'xxx_999_6',
            'email' => 'mahasiswa@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas penguji",
            'username' => "penguji",
            'slug' => 'xxx_999_7',
            'email' => 'penguji@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas Mahasiswa 1",
            'username' => "999999991",
            'slug' => 'xxx_999_8',
            'email' => 'mahasiswa1@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas Mahasiswa 2",
            'username' => "999999992",
            'slug' => 'xxx_999_9',
            'email' => 'mahasiswa2@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Mas Mahasiswa 3",
            'username' => "999999993",
            'slug' => 'xxx_999_10',
            'email' => 'mahasiswa3@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Mas Mahasiswa 4",
            'username' => "999999994",
            'slug' => 'xxx_999_11',
            'email' => 'mahasiswa4@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Mas Mahasiswa 5",
            'username' => "999999995",
            'slug' => 'xxx_999_12',
            'email' => 'mahasiswa5@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Mas Mahasiswa 6",
            'username' => "999999996",
            'slug' => 'xxx_999_13',
            'email' => 'mahasiswa6@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Mas Mahasiswa 7",
            'username' => "999999997",
            'slug' => 'xxx_999_14',
            'email' => 'mahasiswa7@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => "Mas Mahasiswa 8",
            'username' => "999999998",
            'slug' => 'xxx_999_15',
            'email' => 'mahasiswa8@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Pasien simulasi satu",
            'username' => "ps1",
            'slug' => 'xxx_919_01',
            'email' => 'ps1@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Pasien simulasi dua",
            'username' => "ps2",
            'slug' => 'xxx_919_02',
            'email' => 'ps2@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Pelatih Pasien Simulasi",
            'username' => "pps",
            'slug' => 'xxx_939_01',
            'email' => 'pps@fk.ugj',
            'email_verified_at' => now(),
            'password' => Hash::make('buka'),
            'remember_token' => Str::random(10),
        ]);
    }

}
