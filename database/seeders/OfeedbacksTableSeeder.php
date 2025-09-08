<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfeedbacksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ofeedbacks')->delete();
        
        \DB::table('ofeedbacks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 1,
                'qrpeserta' => '705269674237',
                'nama' => 'Tyara Carolina Zahra',
                'npm' => '124170157',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:29:30',
                'updated_at' => '2025-09-08 02:29:30',
            ),
            1 => 
            array (
                'id' => 2,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 2,
                'qrpeserta' => '295083618228',
                'nama' => 'zahra adelia',
                'npm' => '124170162',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:29:58',
                'updated_at' => '2025-09-08 02:29:58',
            ),
            2 => 
            array (
                'id' => 3,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 3,
                'qrpeserta' => '571920964541',
                'nama' => 'Elvina Amelia Putri',
                'npm' => '124170039',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:30:50',
                'updated_at' => '2025-09-08 02:30:50',
            ),
            3 => 
            array (
                'id' => 4,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 5,
                'qrpeserta' => '344366504739',
                'nama' => 'Nazla Amalia Bilqis ',
                'npm' => '124170114',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:31:23',
                'updated_at' => '2025-09-08 02:31:23',
            ),
            4 => 
            array (
                'id' => 5,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 4,
                'qrpeserta' => '754955767172',
                'nama' => 'Noer Fathimah Azzahra ',
                'npm' => '124170118',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:31:58',
                'updated_at' => '2025-09-08 02:31:58',
            ),
            5 => 
            array (
                'id' => 6,
                'oujian_id' => 3,
                'station_id' => 21,
                'peserta_id' => 6,
                'qrpeserta' => '595641367525',
                'nama' => 'Khalisyah Khairy Rachmawati',
                'npm' => '124170074',
                'feedback' => 'Kelebihan :

Kekurangan :

Masukan:',
                'created_at' => '2025-09-08 02:32:31',
                'updated_at' => '2025-09-08 02:32:31',
            ),
        ));
        
        
    }
}