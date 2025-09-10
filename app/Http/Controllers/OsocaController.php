<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Openguji;
use App\Models\Osesi;
use App\Models\Otemplate;
use App\Models\Onilai;
use App\Models\Orubrik;
use App\Models\Ofeedback;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function tostation(){
        session()->forget('Penguji');
        session()->forget('Sesi');
        session()->forget('Peserta');
        return redirect(route('osoca.penguji.login'));

    }

    Public function penguji(){
        if(session()->has('Penguji')){
            return redirect(route('osoca.mhs.login'))->with('msg', 'success-Selamat datang kembali dok,Silahkan scan kartu peserta');
        }
         if (session()->has('Peserta')) {
                return redirect(route('osoca.ujian'))->with('msg', 'success-Selamat datang kembali dok, Selamat menguji peserta');
            }
            $data = $this->data_osoca();
            //dd($data);
        return view('osoca.penguji', compact('data'));
    }

    Public function penguji_check(Request $request){
        $request->validate([
            'soal_slug' => ['required','numeric'],

        ]);
        $qr_penguji = $request->soal_slug;
        $penguji = Openguji::where('qr_penguji', $qr_penguji)->first();
        $osoca = $this->data_osoca();
        $osoca['station'] ->penguji_id = $penguji->id;
        $osoca['station'] ->nama_penguji = $penguji->nama;
        $osoca['station'] ->save();
        if($penguji){
            session([
                'Penguji' => $penguji->id,
            ]);
            return redirect(route('osoca.mhs.login'))->with('msg', 'success-Selamat datang dok, Selamat menguji');
        }
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
            if (!session()->has('Penguji')) {
                return redirect(route('osoca.penguji.login'))->with('msg', 'danger-Silahkan scan kartu penguji');
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

    public function penilaianX(Request $request){
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

        DB::commit();

        session()->forget('Sesi');
        session()->forget('Peserta');
        session(['current' => $next,
                 'next' => $next + 1,
                ]);

        return redirect(route('osoca.mhs.login'))->with('msg', 'success-Data berhasil disimpan');
    } catch (Exception $e) {
        DB::rollBack();
        session(['current' => $next - 1,
                 'next' => $next,
                ]);
        return redirect(route('osoca.ujian'))->with('msg', 'danger-Data gagal disimpan '.$e->getMessage());
        }
  }

  public function penilaian(Request $request)
        {
            // 1) Validasi
            $validated = $request->validate([
                'penilaian'   => ['required','string'], // JSON string
                'feedback'    => ['nullable','string'],
                'next'        => ['required','integer','min:0'],
                'template_id' => ['required','integer','exists:otemplates,id'],
            ]);

            // Decode & hitung
            $arrPenilaian = json_decode($validated['penilaian'], true);
            if (!is_array($arrPenilaian)) {
                return back()->with('msg', 'danger-Format penilaian tidak valid');
            }
            // pastikan semua nilai numerik
            $angka = array_map('floatval', $arrPenilaian);
            $jumlah = array_sum($angka);

            $ujian_id = session('Osoca');
            if (!$ujian_id) {
                return back()->with('msg', 'danger-Session ujian hilang');
            }
            $ujian = Oujian::find($ujian_id);
            if (!$ujian) {
                return back()->with('msg', 'danger-Ujian tidak ditemukan');
            }

            // Hitung rubrik (3 = skor maksimum per rubrik?)
            $jmlRubrik = Orubrik::where('otemplate_id', $validated['template_id'])->count();
            if ($jmlRubrik <= 0) {
                return back()->with('msg', 'danger-Rubrik tidak tersedia');
            }
            $rubrikMax = $jmlRubrik * 3;
            $pembagi   = 100 / $rubrikMax;
            $mar       = $pembagi * $jumlah;

            $mark = $ujian->remedial ? min($mar, 67) : $mar;
            $mark = round($mark, 2);

            try {
                DB::transaction(function () use ($validated, $ujian_id, $ujian, $jumlah, $mark, $arrPenilaian) {
                    // Ambil peserta dari session
                    $pesertaId = session('Peserta');
                    $sesiId    = session('Sesi');
                    $stationUrutan = session('Station');

                    if (!$pesertaId || !$sesiId || !$stationUrutan) {
                        throw new \RuntimeException('Session peserta/sesi/station tidak lengkap');
                    }

                    $peserta = Opeserta::findOrFail($pesertaId);
                    $peserta->update(['status' => true]);

                    // Lock baris station agar aman dari race condition
                    $station = Ostation::where('urutan', $stationUrutan)
                        ->where('oujian_id', $ujian_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    $station->current = $validated['next'];
                    $station->next    = $validated['next'] + 1;
                    $station->save();

                    // Cegah duplikasi nilai untuk peserta-station yang sama
                    $sudahAda = Onilai::where('oujian_id', $ujian_id)
                        ->where('station_id', $station->id)
                        ->where('qrpeserta', $peserta->qrpeserta)
                        ->exists();

                    if ($sudahAda) {
                        throw new \RuntimeException('Nilai untuk peserta ini di station tersebut sudah ada.');
                    }

                    // Simpan nilai
                    Onilai::create([
                        'oujian_id'  => $ujian_id,
                        'station_id' => $station->id,
                        'sesi_id'    => $sesiId,
                        'peserta_id' => $peserta->id,
                        'qrpeserta'  => $peserta->qrpeserta,
                        'nama'       => $peserta->name,
                        'npm'        => $peserta->npm,
                        'skor'       => json_encode($arrPenilaian), // simpan JSON rapi
                        'jumlah'     => $jumlah,
                        'nilai'      => $mark,
                    ]);

                    // Simpan feedback (opsional: hanya jika ada isi)
                    Ofeedback::create([
                        'oujian_id'  => $ujian_id,
                        'station_id' => $station->id,
                        'peserta_id' => $peserta->id,
                        'qrpeserta'  => $peserta->qrpeserta,
                        'nama'       => $peserta->name,
                        'npm'        => $peserta->npm,
                        'feedback'   => $validated['feedback'] ?? null,
                    ]);
                });

                // Session diubah setelah commit agar state konsisten
                session()->forget(['Sesi','Peserta']);
                session([
                    'current' => $validated['next'],
                    'next'    => $validated['next'] + 1,
                ]);

                return redirect()->route('osoca.mhs.login')
                    ->with('msg', 'success-Data berhasil disimpan');

            } catch (\Throwable $e) {
                // JANGAN majukan sesi kalau gagal
                return redirect()->route('osoca.ujian')
                    ->with('msg', 'danger-Data gagal disimpan '.$e->getMessage());
            }
}
}
