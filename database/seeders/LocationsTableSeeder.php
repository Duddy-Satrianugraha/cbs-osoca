<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('locations')->delete();
        
        \DB::table('locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'nama' => 'Lokasi A',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            1 => 
            array (
                'id' => 2,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'nama' => 'Lokasi B',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            2 => 
            array (
                'id' => 3,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'nama' => 'Lokasi A',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
            3 => 
            array (
                'id' => 4,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'nama' => 'Lokasi B',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
        ));
        
        
    }
}