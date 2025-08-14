<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stations')->delete();
        
        \DB::table('stations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sesi_id' => 1,
                'name' => 'Station 1',
                'urutan' => '1',
                'template_id' => 1,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            1 => 
            array (
                'id' => 2,
                'sesi_id' => 1,
                'name' => 'Station 2',
                'urutan' => '2',
                'template_id' => 2,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            2 => 
            array (
                'id' => 3,
                'sesi_id' => 1,
                'name' => 'Station 3',
                'urutan' => '3',
                'template_id' => 3,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            3 => 
            array (
                'id' => 4,
                'sesi_id' => 1,
                'name' => 'Station 4',
                'urutan' => '4',
                'template_id' => NULL,
                'istirahat' => '1',
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            4 => 
            array (
                'id' => 5,
                'sesi_id' => 1,
                'name' => 'Station 5',
                'urutan' => '5',
                'template_id' => 5,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            5 => 
            array (
                'id' => 6,
                'sesi_id' => 1,
                'name' => 'Station 6',
                'urutan' => '6',
                'template_id' => 6,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            6 => 
            array (
                'id' => 7,
                'sesi_id' => 1,
                'name' => 'Station 7',
                'urutan' => '7',
                'template_id' => 4,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:46:33',
                'updated_at' => '2025-04-09 15:47:12',
            ),
            7 => 
            array (
                'id' => 8,
                'sesi_id' => 2,
                'name' => 'Station 1',
                'urutan' => '1',
                'template_id' => 1,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            8 => 
            array (
                'id' => 9,
                'sesi_id' => 2,
                'name' => 'Station 2',
                'urutan' => '2',
                'template_id' => 2,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            9 => 
            array (
                'id' => 10,
                'sesi_id' => 2,
                'name' => 'Station 3',
                'urutan' => '3',
                'template_id' => 3,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            10 => 
            array (
                'id' => 11,
                'sesi_id' => 2,
                'name' => 'Station 4',
                'urutan' => '4',
                'template_id' => NULL,
                'istirahat' => '1',
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            11 => 
            array (
                'id' => 12,
                'sesi_id' => 2,
                'name' => 'Station 5',
                'urutan' => '5',
                'template_id' => 5,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            12 => 
            array (
                'id' => 13,
                'sesi_id' => 2,
                'name' => 'Station 6',
                'urutan' => '6',
                'template_id' => 6,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
            13 => 
            array (
                'id' => 14,
                'sesi_id' => 2,
                'name' => 'Station 7',
                'urutan' => '7',
                'template_id' => 4,
                'istirahat' => NULL,
                'created_at' => '2025-04-09 15:47:31',
                'updated_at' => '2025-04-09 15:47:31',
            ),
        ));
        
        
    }
}