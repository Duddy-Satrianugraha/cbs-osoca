<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OnilaisTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('onilais')->delete();
        
        \DB::table('onilais')->insert(array (
            0 => 
            array (
                'id' => 1,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 15,
                'peserta_id' => 1,
                'qrpeserta' => '705269674237',
                'nama' => 'Tyara Carolina Zahra',
                'npm' => '124170157',
                'skor' => '{"1":"3","2":"2"}',
                'jumlah' => '5',
                'nilai' => '83.33',
                'created_at' => '2025-09-08 02:29:30',
                'updated_at' => '2025-09-08 02:29:30',
            ),
            1 => 
            array (
                'id' => 2,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 16,
                'peserta_id' => 2,
                'qrpeserta' => '295083618228',
                'nama' => 'zahra adelia',
                'npm' => '124170162',
                'skor' => '{"3":"3","4":"0"}',
                'jumlah' => '3',
                'nilai' => '50',
                'created_at' => '2025-09-08 02:29:58',
                'updated_at' => '2025-09-08 02:29:58',
            ),
            2 => 
            array (
                'id' => 3,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 17,
                'peserta_id' => 3,
                'qrpeserta' => '571920964541',
                'nama' => 'Elvina Amelia Putri',
                'npm' => '124170039',
                'skor' => '{"5":"2","6":"1"}',
                'jumlah' => '3',
                'nilai' => '50',
                'created_at' => '2025-09-08 02:30:50',
                'updated_at' => '2025-09-08 02:30:50',
            ),
            3 => 
            array (
                'id' => 4,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 18,
                'peserta_id' => 5,
                'qrpeserta' => '344366504739',
                'nama' => 'Nazla Amalia Bilqis ',
                'npm' => '124170114',
                'skor' => '{"7":"2","8":"2"}',
                'jumlah' => '4',
                'nilai' => '66.67',
                'created_at' => '2025-09-08 02:31:23',
                'updated_at' => '2025-09-08 02:31:23',
            ),
            4 => 
            array (
                'id' => 5,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 19,
                'peserta_id' => 4,
                'qrpeserta' => '754955767172',
                'nama' => 'Noer Fathimah Azzahra ',
                'npm' => '124170118',
                'skor' => '{"9":"3","10":"1"}',
                'jumlah' => '4',
                'nilai' => '66.67',
                'created_at' => '2025-09-08 02:31:58',
                'updated_at' => '2025-09-08 02:31:58',
            ),
            5 => 
            array (
                'id' => 6,
                'oujian_id' => 3,
                'station_id' => 21,
                'sesi_id' => 20,
                'peserta_id' => 6,
                'qrpeserta' => '595641367525',
                'nama' => 'Khalisyah Khairy Rachmawati',
                'npm' => '124170074',
                'skor' => '{"11":"1","12":"1"}',
                'jumlah' => '2',
                'nilai' => '33.33',
                'created_at' => '2025-09-08 02:32:31',
                'updated_at' => '2025-09-08 02:32:31',
            ),
        ));
        
        
    }
}