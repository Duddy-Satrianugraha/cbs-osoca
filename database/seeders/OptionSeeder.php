<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'type' => "kst",
            'name' => '1',
            'value' => 'Sistem Saraf',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '2',
            'value' => 'Psikiatri',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '3',
            'value' => 'Sistem Indra',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '4',
            'value' => 'Sistem Respirasi',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '5',
            'value' => 'Sistem Kardiovaskular',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '6',
            'value' => 'Sistem Gastrointestinal, Hepatobilier, dan Pankreas',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '7',
            'value' => 'Sistem Ginjal dan Saluran Kemih',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '8',
            'value' => 'Sistem Reproduksi',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '9',
            'value' => 'Sistem Endokrin, Metabolisme, dan Nutrisi',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '10',
            'value' => 'Sistem Hematologi dan Imunologi',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '11',
            'value' => 'Sistem Muskuloskeletal',
        ]);
        Option::create([
            'type' => "kst",
            'name' => '12',
            'value' => 'Sistem Integumen',
        ]);

        Option::create([
            'type' => "kyd",
            'name' => '1',
            'value' => 'Anamnesis',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '2',
            'value' => 'Pemeriksaan fisik',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '3',
            'value' => 'Pemeriksaan Tanda Tanda Vital',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '4',
            'value' => 'Interpretasi data/kemampuan prosedural pemeriksaan penunjang',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '5',
            'value' => 'Penegakan diagnosis dan diagnosis banding',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '6',
            'value' => 'Tatalaksana nonfarmakoterapi',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '7',
            'value' => 'Tatalaksana farmakoterapi',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '8',
            'value' => 'Komunikasi dan edukasi pasien',
        ]);
        Option::create([
            'type' => "kyd",
            'name' => '9',
            'value' => 'Perilaku professional',
        ]);
        Option::create([
            'type' => "skdi",
            'name' => '1',
            'value' => ' Mampu mengenali dan menjelaskan',
        ]);
        Option::create([
            'type' => "skdi",
            'name' => '2',
            'value' => ' Mampu mendiagnosis dan merujuk',
        ]);
        Option::create([
            'type' => "skdi",
            'name' => '3A',
            'value' => ' Mampu mendiagnosis, melakukan penatalaksanaan awal, dan merujuk pada keadaan yang bukan gawat darurat. ',
        ]);
        Option::create([
            'type' => "skdi",
            'name' => '3B',
            'value' => ' Mampu mendiagnosis, melakukan penatalaksanaan awal, dan merujuk pada keadaan gawat darurat. ',
        ]);
        Option::create([
            'type' => "skdi",
            'name' => '4A',
            'value' => ' Mampu mendiagnosis, melakukan penatalaksanaan secara mandiri dan tuntas. ',
        ]);
        Option::create([
            'type' => "sex",
            'name' => 'male',
            'value' => 'Laki-laki',
        ]);
        Option::create([
            'type' => "sex",
            'name' => 'female',
            'value' => 'Perempuan',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "1",
            'value' => 'Pelatiahan Pasien Standar',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "2",
            'value' => 'PS Osce Semester',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "3",
            'value' => 'PS Osce UKMPPD',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "4",
            'value' => 'PS Trauma',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "5",
            'value' => 'PS Psikiatri',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "6",
            'value' => 'PS Bidai',
        ]);
        Option::create([
            'type' => "ahli",
            'name' => "7",
            'value' => 'PS infeksi',
        ]);
        Option::create([
            'type' => "jpp",
            'name' => "1",
            'value' => 'Labratorium',
        ]);
         Option::create([
            'type' => "jpp",
            'name' => "2",
            'value' => 'Radiologi',
        ]);
        Option::create([
            'type' => "jpp",
            'name' => "3",
            'value' => 'Lainnya',
        ]);


    }
}
