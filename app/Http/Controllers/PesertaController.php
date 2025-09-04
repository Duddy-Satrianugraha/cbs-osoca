<?php

namespace App\Http\Controllers;

use App\Models\Ostation;
use App\Models\Oujian;
use App\Models\Opeserta;
use App\Models\Osesi;
use App\Models\Otemplate;
use Illuminate\Http\Request;

class PesertaController extends Controller
{

    public function check(){

       // dd(session()->all());
        $station = Ostation::find(session('Station'));

        return view('peserta.loginp', compact('station'));
    }

    public function logout(){
            session()->flush();
            return redirect(route('peserta.login'));
        }

    public function tolist(){
        session()->forget('Sesi');
        return redirect(route('peserta.index'));
    }

    Public function scan(Request $request){
        //dd($request->all());
        $request->validate([
            'soal_slug' => ['required','numeric'],
        ]);
        $soal_slug = $request->soal_slug;
        $station = Ostation::find(session('Station'));
        $sesi = Osesi::where('oujian_id', session('oujian'))->where('urutan', $station->current)->first();
       // dd($sesi);
        $peserta = Opeserta::where('qrpeserta', $soal_slug)->where('status', 0)->first();

        if($peserta){

            session([
                'osesi' => $sesi->id,
            ]);

            return redirect(route('peserta.soal'))->with('success', 'Waktu untuk melihat soal adalah 10 menit');
        } else {
            return redirect(route('peserta.index'))->with('msg', 'danger-peserta telah di uji atau tidak terdaftar');
        }
    }

    public function soal(){
        $ujian = Oujian::find(session('oujian'));
        $sesi = Osesi::find(session('osesi'));
        $template = Otemplate::find($sesi->otemplate_id);

        //dd($sesi);

        return view('peserta.template', compact('ujian', 'sesi', 'template'));
    }

}
