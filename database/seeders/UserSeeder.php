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


    }

}
