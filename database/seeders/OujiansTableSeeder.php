<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OujiansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oujians')->delete();
        
        \DB::table('oujians')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Osoca Semester 6',
                'ta' => '2025/2026',
                'jml_station' => '5',
                'jml_sesi' => '6',
                'tgl_ujian' => '2025-08-11',
                'user_id' => 5,
                'created_at' => '2025-08-27 01:14:55',
                'updated_at' => '2025-08-27 01:18:47',
            ),
        ));
        
        
    }
}