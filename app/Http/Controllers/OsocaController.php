<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Osesi;
use App\Models\Otemplate;
use App\Models\Onilai;
use App\Models\Orubrik;
use App\Models\Ofeedback;
use Exception;
use Illuminate\Support\Facades\DB;
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
        if($peserta->status){
            return redirect(route('osoca.mhs.login'))->with('msg','danger-Peserta sudah diujikan');
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
    
    public function template(){
        $sesi = Osesi::find(session('Sesi'));
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
        return view('osoca.template', compact('osodata', 'rubrik', 'template'));
    }
       
    public function penilaian(Request $request){
       //dd($request->all());

        $jumlah = array_sum(json_decode($request->penilaian, true));
        $feedback = $request->feedback ?? null;
        $next = $request->next; //buat update session current_peserta
        $template_id = $request->template_id;
        $ujian_id = session('Osoca');
        $ujian = Oujian::find($ujian_id);
        $rubrik = Orubrik::where('otemplate_id', $template_id)->count()*3;
        //dd($rubrik);
        $pembagi =  100/ $rubrik;
        $mar  =  $pembagi * $jumlah;
        if($ujian->remedial){
            if($mar >= 67){
                $mark = 67;
            }else {
                $mark = $mar;
            }
        } else { $mark = $mar;}

     try{
        DB::beginTransaction();
        $peserta = Opeserta::find(session('Peserta'));
        $peserta->status = true;
        $peserta->save();

        $station = Ostation::Where('urutan',session('Station'))->where('oujian_id',$ujian_id)->first();
        $station->current = $request->next;
        $station->next = $request->next + 1;
        $station->save();

        $nilai = New Onilai;
        $nilai->oujian_id = $ujian_id;
        $nilai->station_id = $station->id;
        $nilai->sesi_id = session('Sesi');
        $nilai->qrpeserta = $peserta->qrpeserta;
        $nilai->nama = $peserta->name;
        $nilai->npm = $peserta->npm;
        $nilai->skor = $request->penilaian;
        $nilai->jumlah = $jumlah;
        $nilai->nilai = $mark;
        $nilai->save();
   
        $ofeedback = New Ofeedback;
        $ofeedback->oujian_id = $ujian_id;
        $ofeedback->station_id = $station->id;
        $ofeedback->peserta_id = $peserta->id;
        $ofeedback->qrpeserta = $peserta->qrpeserta;
        $ofeedback->nama = $peserta->name;
        $ofeedback->npm = $peserta->npm;
        $ofeedback->feedback = $feedback;
        $ofeedback->save();
        
       

        session()->forget('Sesi');
        session()->forget('Peserta');
        session(['current' => $next,
                 'next' => $next + 1,
                ]);
        DB::commit();
        return redirect(route('osoca.mhs.login'))->with('msg', 'success-Data berhasil disimpan');
    } catch (Exception $e) {
        DB::rollBack();
        session(['current' => $next - 1,
                 'next' => $next,
                ]);
        return redirect(route('osoca.ujian'))->with('msg', 'danger-Data gagal disimpan '.$e->getMessage()); 
        }


        

    }
}
