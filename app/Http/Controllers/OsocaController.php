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

    public function tolist(){
        session()->forget('Sesi');
        session()->forget('Peserta');
        return redirect(route('osoca.mhs.login'));
    }

      public function mhs()
    {
         if (!session()->has('Osoca')) {
                return redirect(route('osoca.login'))->with('msg', 'danger-Silahkan scan kartu station');
            }
          if (session()->has('Peserta')) {
                return redirect(route('osoca.ujian'))->with('msg', 'success-Selamat menguji peserta');
            }
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

        $sesi = Osesi::where('oujian_id', $peserta->oujian_id)->where('urutan', session('current'))->first();
         session([
                'Sesi' => $sesi->id,
                'Peserta' => $peserta->id,
            ]);
      Return redirect(route('osoca.ujian'));
    }

    public function ujian(){
        if (!session()->has('Osoca')) {
                return redirect(route('osoca.login'))->with('msg', 'danger-Silahkan scan kartu station');
            }
            if (!session()->has('Peserta')) {
                return redirect(route('osoca.mhs.login'))->with('msg', 'danger-Silahkan scan kartu Peserta');
            }

            $sesi = Osesi::find(session('Sesi'));
            $peserta = Opeserta::find(session('Peserta'));
            $otemplate = Otemplate::find($sesi->otemplate_id);
           
            $osodata = $this->data_osoca();
           
                $temp = $otemplate->rubrix()->get();
            // dd($temp);
                $rubrik = [];
                foreach ($temp as $data) {
                    $rubrik[] = [
                        'id' => $data->id,
                        'name' => $data->name,
                        'nilai_0' => $data->Nilai_0,
                        'nilai_1' => $data->Nilai_1,
                        'nilai_2' => $data->Nilai_2,
                        'nilai_3' => $data->Nilai_3,
                        'aktif0' => $data->aktif0,
                        'aktif1' => $data->aktif1,
                        'aktif2' => $data->aktif2,
                        'aktif3' => $data->aktif3,
                        'bobot' => $data->bobot,
                    ];
                }
                $template = $otemplate;
                $pol = ($osodata['mhs']->count() == $osodata['mhs']->where('status', true)->count());
                
            return view('osoca.dashbord', compact('osodata', 'rubrik', 'peserta', 'template', 'sesi', 'pol'));
        
        //dd(session()->all());


    }
       
    public function penilaian(Request $request){
        //dd(session()->all());
        dd($request->all());

        $penilaian = json_decode($request->penilaian, true);
        $feedback = $request->feedback;
        $globalRating = json_decode($request->globalRating, true);
        $next = $request->next + 1; //buat update session current_peserta
    }
}
