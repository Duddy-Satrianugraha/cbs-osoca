<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SesisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sesis')->delete();
        
        \DB::table('sesis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ujian_id' => 1,
                'name' => 'Sesi 1 Pagi',
                'jml_lokasi' => '2',
                'jml_rotasi' => '2',
                'jml_station' => '7',
                'slug' => '20250409154633',
                'tgl_ujian' => '2025-05-01',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            1 => 
            array (
                'id' => 2,
                'ujian_id' => 1,
                'name' => 'Sesi 2 Siang',
                'jml_lokasi' => '2',
                'jml_rotasi' => '2',
                'jml_station' => '7',
                'slug' => '20250409154731',
                'tgl_ujian' => '2025-05-01',
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
        ));
        
        
    }
}