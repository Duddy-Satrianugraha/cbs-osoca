<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OsesisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('osesis')->delete();
        
        \DB::table('osesis')->insert(array (
            0 => 
            array (
                'id' => 1,
                'oujian_id' => 1,
                'urutan' => 1,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            1 => 
            array (
                'id' => 2,
                'oujian_id' => 1,
                'urutan' => 2,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            2 => 
            array (
                'id' => 3,
                'oujian_id' => 1,
                'urutan' => 3,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            3 => 
            array (
                'id' => 4,
                'oujian_id' => 1,
                'urutan' => 4,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            4 => 
            array (
                'id' => 5,
                'oujian_id' => 1,
                'urutan' => 5,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            5 => 
            array (
                'id' => 6,
                'oujian_id' => 1,
                'urutan' => 6,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            6 => 
            array (
                'id' => 7,
                'oujian_id' => 1,
                'urutan' => 7,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            7 => 
            array (
                'id' => 8,
                'oujian_id' => 1,
                'urutan' => 8,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            8 => 
            array (
                'id' => 9,
                'oujian_id' => 1,
                'urutan' => 9,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            9 => 
            array (
                'id' => 10,
                'oujian_id' => 1,
                'urutan' => 10,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
            10 => 
            array (
                'id' => 11,
                'oujian_id' => 1,
                'urutan' => 11,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 06:33:54',
            ),
        ));
        
        
    }
}