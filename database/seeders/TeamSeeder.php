<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'tu_id' => 1,
            'name' => 'Semester 1 dan 2',
            'team' => 'tahap1',
        ]);
        Team::create([
            'tu_id' => 2,
            'name' => 'Semester 3 dan 4',
            'team' => 'tahap2',
        ]);
        Team::create([
            'tu_id' => 3,
            'name' => 'semester 5 dan 6',
            'team' => 'tahap3',
        ]);
        Team::create([
            'tu_id' => 4,
            'name' => 'Semester 7 dan 8',
            'team' => 'tahap4',
        ]);
    }
}
