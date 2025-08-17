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
                'id' => 1,
                'name' => 'Osoca Semester 4',
                'user_id' => 5,
                'ta' => '2025/2026',
                'jml_station' => '20',
                'jml_sesi' => '11',
                'tgl_ujian' => '2025-08-25',
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
        ));
        
        
    }
}