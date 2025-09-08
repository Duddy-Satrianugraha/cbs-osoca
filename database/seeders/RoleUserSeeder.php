<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ultra= User::where('username','ultraman')->first();
        $it= User::where('username','it')->first();
        $koc= User::where('username','koc')->first();
        $admin= User::where('username','admin')->first();
        $materi= User::where('username','materi')->first();


        $r_ultra = Role::where('u_id', 99)->first()->id;
        $r_it = Role::where('u_id', 98)->first()->id;
        $r_koc = Role::where('u_id', 1)->first()->id;
        $r_admin = Role::where('u_id', 2)->first()->id;
        $r_materi = Role::where('u_id', 3)->first()->id;


        $ultra->roles()->attach($r_ultra);
        $it->roles()->attach($r_it);
        $koc->roles()->attach($r_koc);
        $admin->roles()->attach($r_admin);
        $materi->roles()->attach($r_materi);
    }
}
