<?php
if (!function_exists('generate_captcha')) {
    function generate_captcha()
    {
        $a = rand(1, 10);
        $b = rand(1, 10);
        $operator = rand(0, 1) ? '+' : '-';

        // Pastikan hasil pengurangan tidak negatif
        if ($operator === '-' && $a < $b) {
            [$a, $b] = [$b, $a]; // tukar posisi
        }

        $angka = [
            0 => 'nol',
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh'
        ];

        $kataOperator = $operator === '+' ? 'ditambah' : 'dikurang';

        // Simpan jawaban di session
        $jawaban = $operator === '+' ? ($a + $b) : ($a - $b);
        session(['osce_captcha' => $jawaban]);

        return "Berapa hasil dari " . $angka[$a] . " $kataOperator " . $angka[$b] ." ?";
    }
}

if (!function_exists('verify_captcha')) {
    function verify_captcha($input)
    {
        return session('osce_captcha') == $input;
    }
}

if (!function_exists('tgl_indo')) {
    // Format tanggal indonesia pakai hari {{ tanggal_indo('2025-01-20', true) }}
    function tgl_indo($tanggal, $denganHari = false)
    {
        if (!$tanggal) {
            return ''; // aman jika null atau kosong
        }

        $namaHari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $namaBulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $timestamp = strtotime($tanggal);
        if (!$timestamp) {
            return ''; // aman jika format tanggal invalid
        }

        $hari = $namaHari[date('l', $timestamp)];
        $tgl = date('j', $timestamp);
        $bln = (int) date('n', $timestamp);
        $thn = date('Y', $timestamp);

        $hasil = "$tgl " . $namaBulan[$bln] . " $thn";
        return $denganHari ? "$hari, $hasil" : $hasil;
    }

    if (!function_exists('wrap_range')) {
        function wrap_range($start, $max) {
            $result = [];

            // Dari start ke max
            for ($i = $start; $i <= $max; $i++) {
                $result[] = $i;
            }

            // Dari 1 ke sebelum start
            for ($i = 1; $i < $start; $i++) {
                $result[] = $i;
            }

            return $result;
        }
    }

    if (!function_exists('wrap_range_reverse')) {
        function wrap_range_reverse($start, $max) {
            $result = [];

            // Dari start turun ke 1
            for ($i = $start; $i >= 1; $i--) {
                $result[] = $i;
            }

            // Dari max turun ke start+1
            for ($i = $max; $i > $start; $i--) {
                $result[] = $i;
            }

            return $result;
        }
    }
if (!function_exists('numran')) {
     function numran(int $length = 10): string
            {
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
        }
}
