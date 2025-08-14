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
        $mhs= User::where('username','mahasiswa')->first();
        $penguji= User::where('username','penguji')->first();

        $mhs1= User::where('username','999999991')->first();
        $mhs2= User::where('username','999999992')->first();
        $mhs3= User::where('username','999999993')->first();
        $mhs4= User::where('username','999999994')->first();
        $mhs5= User::where('username','999999995')->first();
        $mhs6= User::where('username','999999996')->first();
        $mhs7= User::where('username','999999997')->first();
        $mhs8= User::where('username','999999998')->first();
        $ps1= User::where('username','ps1')->first();
        $ps2= User::where('username','ps2')->first();
        $pps = User::where('username','pps')->first();

        $r_ultra = Role::where('u_id', 99)->first()->id;
        $r_it = Role::where('u_id', 98)->first()->id;
        $r_koc = Role::where('u_id', 1)->first()->id;
        $r_admin = Role::where('u_id', 2)->first()->id;
        $r_materi = Role::where('u_id', 3)->first()->id;
        $r_mhs = Role::where('u_id', 4)->first()->id;
        $r_penguji = Role::where('u_id', 5)->first()->id;
        $r_ps = Role::where('u_id', 6)->first()->id;
        $r_pps = Role::where('u_id', 7)->first()->id;

        $ultra->roles()->attach($r_ultra);
        $it->roles()->attach($r_it);
        $koc->roles()->attach($r_koc);
        $admin->roles()->attach($r_admin);
        $materi->roles()->attach($r_materi);
        $mhs->roles()->attach($r_mhs);
        $penguji->roles()->attach($r_penguji);
        $mhs1->roles()->attach($r_mhs);
        $mhs2->roles()->attach($r_mhs);
        $mhs3->roles()->attach($r_mhs);
        $mhs4->roles()->attach($r_mhs);
        $mhs5->roles()->attach($r_mhs);
        $mhs6->roles()->attach($r_mhs);
        $mhs7->roles()->attach($r_mhs);
        $mhs8->roles()->attach($r_mhs);
        $ps1->roles()->attach($r_ps);
        $ps2->roles()->attach($r_ps);
        $pps->roles()->attach($r_pps);


    }
}
