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
                'otemplate_id' => 1,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            1 => 
            array (
                'id' => 2,
                'oujian_id' => 1,
                'urutan' => 2,
                'otemplate_id' => 2,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            2 => 
            array (
                'id' => 3,
                'oujian_id' => 1,
                'urutan' => 3,
                'otemplate_id' => 3,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            3 => 
            array (
                'id' => 4,
                'oujian_id' => 1,
                'urutan' => 4,
                'otemplate_id' => 4,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            4 => 
            array (
                'id' => 5,
                'oujian_id' => 1,
                'urutan' => 5,
                'otemplate_id' => 5,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            5 => 
            array (
                'id' => 6,
                'oujian_id' => 1,
                'urutan' => 6,
                'otemplate_id' => 6,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            6 => 
            array (
                'id' => 7,
                'oujian_id' => 1,
                'urutan' => 7,
                'otemplate_id' => 4,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            7 => 
            array (
                'id' => 8,
                'oujian_id' => 1,
                'urutan' => 8,
                'otemplate_id' => 5,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            8 => 
            array (
                'id' => 9,
                'oujian_id' => 1,
                'urutan' => 9,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            9 => 
            array (
                'id' => 10,
                'oujian_id' => 1,
                'urutan' => 10,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 06:33:54',
                'updated_at' => '2025-08-16 12:38:15',
            ),
            10 => 
            array (
                'id' => 14,
                'oujian_id' => 1,
                'urutan' => 11,
                'otemplate_id' => NULL,
                'created_at' => '2025-08-16 13:17:25',
                'updated_at' => '2025-08-16 13:17:25',
            ),
        ));
        
        
    }
}