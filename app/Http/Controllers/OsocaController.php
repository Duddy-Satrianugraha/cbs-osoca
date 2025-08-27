<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Osesi;
use App\Models\Otemplate;
use Illuminate\Http\Request;

class OsocaController extends Controller
{
    private function data_osoca(){
       // dd(session()->all());
        $ujian = Oujian::find(session('Osoca'));
        //dd($ujian);
        $station = Ostation::where("oujian_id",$ujian->id)->where("urutan",session('Station'))->first();
        //dd($station);
        $mhs = Opeserta::where('oujian_id', $ujian->id)->where('station', $station->urutan)->orderBy('sesi', 'ASC')->get();
        $sesi = $station->current;
        $data = compact('ujian', 'sesi','station', 'mhs');
        return $data;
    }

     public function logout(){
        session()->flush();
        return redirect(route('osoca.login'));
    }

      public function mhs()
    {
        $data = $this->data_osoca();
        return view('osoca.sesi', compact('data'));
    }

    public function mhs_check(Request $request)
    {   $request->validate([
        'sesi-qr' => 'required',
            ]);
        $qr = $request->input('sesi-qr');

        $peserta = Opeserta::where('qrpeserta', $qr)->where('oujian_id', session('Osoca'))->where('station', session('Station'))->first();
       // dd($peserta);
        if(!$peserta){
            return redirect(route('osoca.mhs.login'))->with('msg','danger-Peserta salah masuk Ruangan atau tidak terdaftar');
        }

        if($peserta->sesi != session('current')){
            return redirect(route('osoca.mhs.login'))->with('msg','danger-Peserta Tidak Sesuai Urutan');
        }
        dd($peserta);
        $sesi = Osesi::where('oujian_id', $peserta->oujian_id)->where('urutan', $peserta->sesi)->first();
        $template = Otemplate::find($sesi->otemplate_id);
        $rubrik = $template->rubrix;
        dd($request->all());
    }
}
