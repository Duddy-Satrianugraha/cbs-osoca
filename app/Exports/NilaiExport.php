<?php

Namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiExport implements FromView, ShouldAutoSize
{
    public function __construct(
        public $ujian,
        public $peserta
    ) {}

    public function view(): View
    {
        return view('export.nilai', [
            'ujian'    => $this->ujian,
            'peserta'  => $this->peserta,
        ]);
    }
}
