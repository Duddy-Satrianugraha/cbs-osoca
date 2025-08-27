<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OstationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ostations')->delete();
        
        \DB::table('ostations')->insert(array (
            0 => 
            array (
                'id' => 21,
                'oujian_id' => 3,
                'urutan' => 1,
                'name' => 'station 1',
                'qrstation' => '288305518431',
                'nama_penguji' => NULL,
                'current' => 1,
                'next' => 2,
                'created_at' => '2025-08-27 01:14:55',
                'updated_at' => '2025-08-27 01:14:55',
            ),
            1 => 
            array (
                'id' => 22,
                'oujian_id' => 3,
                'urutan' => 2,
                'name' => 'station 2',
                'qrstation' => '425599910732',
                'nama_penguji' => NULL,
                'current' => 1,
                'next' => 2,
                'created_at' => '2025-08-27 01:14:55',
                'updated_at' => '2025-08-27 01:14:55',
            ),
            2 => 
            array (
                'id' => 23,
                'oujian_id' => 3,
                'urutan' => 3,
                'name' => 'station 3',
                'qrstation' => '695872793433',
                'nama_penguji' => NULL,
                'current' => 1,
                'next' => 2,
                'created_at' => '2025-08-27 01:14:55',
                'updated_at' => '2025-08-27 01:14:55',
            ),
            3 => 
            array (
                'id' => 24,
                'oujian_id' => 3,
                'urutan' => 4,
                'name' => 'station 4',
                'qrstation' => '990757894834',
                'nama_penguji' => NULL,
                'current' => 1,
                'next' => 2,
                'created_at' => '2025-08-27 01:18:47',
                'updated_at' => '2025-08-27 01:18:47',
            ),
            4 => 
            array (
                'id' => 25,
                'oujian_id' => 3,
                'urutan' => 5,
                'name' => 'station 5',
                'qrstation' => '560777223535',
                'nama_penguji' => NULL,
                'current' => 1,
                'next' => 2,
                'created_at' => '2025-08-27 01:18:47',
                'updated_at' => '2025-08-27 01:18:47',
            ),
        ));
        
        
    }
}