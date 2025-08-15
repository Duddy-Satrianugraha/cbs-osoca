<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrubriksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orubriks')->delete();
        
        \DB::table('orubriks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'otemplate_id' => 1,
                'urutan' => 1,
                'name' => 'Penjelasan pathogenesis dan manifestasi klinis yang muncul',
                'Nilai_0' => '<p>Mahasiswa tidak mampu<br>menjelaskan pathogenesis penyakit<br>dan manifestasi klinis yang muncul.</p>',
            'Nilai_1' => '<p>Mahasiswa menjelaskan pathogenesis<br>penyakit dan manifestasi klinis yang<br>muncul dengan tepat</p><ol><li>Lalat simulium (mengandung<br>mikrofilaria)<br></li><li>Larva stadium 3 masuk<br>kedalam jaringa kulit<br></li><li>Cacing betina berada di bawah<br>kulit dan menghasilkan<br>mikrofilaria<br></li><li>Menyebar ke kulit dan mata<br></li><li>Manifestasi klinis (1-2)</li></ol>',
            'Nilai_2' => '<p>Mahasiswa mampu menjelaskan<br>pathogenesis penyakit dan manifestasi<br>klinis yang muncul dengan tepat</p><ol><li>Lalat simulium (mengandung<br>mikrofilaria)<br></li><li>Larva stadium 3 masuk<br>kedalam jaringa kulit<br></li><li>Cacing betina berada di bawah<br>kulit dan menghasilkan<br>mikrofilaria<br></li><li>Menyebar ke kulit dan mata<br></li><li>Manifestasi klinis (3-4)</li></ol>',
            'Nilai_3' => '<p>Mahasiswa mampu menjelaskan<br>pathogenesis penyakit dan manifestasi<br>klinis yang muncul dengan tepat dan<br>lengkap</p><ol><li>Lalat simulium (mengandung<br>mikrofilaria)<br></li><li>Larva stadium 3 masuk<br>kedalam jaringa kulit<br></li><li>Cacing betina berada di bawah<br>kulit dan menghasilkan<br>mikrofilaria<br></li><li>Menyebar ke kulit dan mata<br></li><li>Manifestasi klinis (1-2)</li></ol><ul><li><ul><li>Hilangnya kejernihan kornea<br></li><li>Kehilangan pigmen kulit<br>(kulit macan tutul)<br></li><li>Pembesaran KGB</li><li> Eosinophilia<br></li><li>Leukositosis</li></ul></li></ul>',
                'aktif0' => 1,
                'aktif1' => 1,
                'aktif2' => 1,
                'aktif3' => 1,
                'bobot' => 1,
                'created_at' => '2025-08-15 03:57:01',
                'updated_at' => '2025-08-15 06:54:33',
            ),
            1 => 
            array (
                'id' => 2,
                'otemplate_id' => 1,
                'urutan' => 2,
                'name' => 'Penjelasan hubungan trias epidemiologi yang sesuai',
                'Nilai_0' => '<p>Mahasiswa tidak mampu<br>menjelaskan hubungan trias<br>epidemiologi</p>',
                'Nilai_1' => '<p>Mahasiswa mampu menjelaskan<br>hubungan 1 komponen trias<br>epidemiologi dengan tepat</p>',
                'Nilai_2' => '<p>Mahasiswa mampu menjelaskan<br>hubungan 2 komponen trias<br>epidemiologi dengan tepat</p>',
                'Nilai_3' => '<p>Mahasiswa mampu menjelaskan hubungan<br>3 komponen trias epidemiologi dengan<br>tepat dan lengkap.</p><ul><li>Faktor Agent</li><li>Faktor Host</li><li>Faktor Lingkungan</li></ul>',
                'aktif0' => 1,
                'aktif1' => 1,
                'aktif2' => 1,
                'aktif3' => 1,
                'bobot' => 1,
                'created_at' => '2025-08-15 03:57:01',
                'updated_at' => '2025-08-15 06:54:33',
            ),
        ));
        
        
    }
}