<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ostation;
use Illuminate\Http\Request;

class OsocaController extends Controller
{
    private function data_osoca(){
       // dd(session()->all());
        $ujian = Oujian::find(session('Osoca'));
        $station = Ostation::find(session('Station'));
        $mhs = Opeserta::where('oujian_id', $ujian->id)->where('station', $station->id)->orderBy('sesi', 'ASC')->get();
        $sesi = $station->current;
        $data = compact('ujian', 'sesi','station', 'mhs');
        return $data;
    }

      public function mhs()
    {
        $data = $this->data_osoca();
        return view('osoca.sesi', compact('data'));
    }

    public function sesi(Request $request)
    {
    }
}
