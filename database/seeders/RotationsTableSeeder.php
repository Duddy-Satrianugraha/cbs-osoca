<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RotationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rotations')->delete();
        
        \DB::table('rotations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'location_id' => 1,
                'nama' => 'Rotasi 1',
                'full_name' => 'Sesi 1 Pagi-Lokasi A- Rotasi 1',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            1 => 
            array (
                'id' => 2,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'location_id' => 1,
                'nama' => 'Rotasi 2',
                'full_name' => 'Sesi 1 Pagi-Lokasi A- Rotasi 2',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            2 => 
            array (
                'id' => 3,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'location_id' => 2,
                'nama' => 'Rotasi 1',
                'full_name' => 'Sesi 1 Pagi-Lokasi B- Rotasi 1',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            3 => 
            array (
                'id' => 4,
                'ujian_id' => 1,
                'sesi_id' => 1,
                'location_id' => 2,
                'nama' => 'Rotasi 2',
                'full_name' => 'Sesi 1 Pagi-Lokasi B- Rotasi 2',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:46:33',
            ),
            4 => 
            array (
                'id' => 5,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'location_id' => 3,
                'nama' => 'Rotasi 1',
                'full_name' => 'Sesi 2 Siang-Lokasi A- Rotasi Rotasi 1',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
            5 => 
            array (
                'id' => 6,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'location_id' => 3,
                'nama' => 'Rotasi 2',
                'full_name' => 'Sesi 2 Siang-Lokasi A- Rotasi Rotasi 2',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
            6 => 
            array (
                'id' => 7,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'location_id' => 4,
                'nama' => 'Rotasi 1',
                'full_name' => 'Sesi 2 Siang-Lokasi B- Rotasi Rotasi 1',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
            7 => 
            array (
                'id' => 8,
                'ujian_id' => 1,
                'sesi_id' => 2,
                'location_id' => 4,
                'nama' => 'Rotasi 2',
                'full_name' => 'Sesi 2 Siang-Lokasi B- Rotasi Rotasi 2',
                'jml_station' => '7',
                'created_at' => '2025-04-09 15:47:32',
                'updated_at' => '2025-04-09 15:47:32',
            ),
        ));
        
        
    }
}