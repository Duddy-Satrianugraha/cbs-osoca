<?php

namespace App\Http\Controllers\Osce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Sesi;
use App\Models\Location;
use App\Models\Station;
use App\Models\Template;
use App\Models\Option;
use App\Models\Rotation;
use App\Models\Peserta;
use App\Models\Rubrik;
use App\Models\User;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\Umpanbalik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OsceController extends Controller
{
    private function data_osce(){
        $ujian = Ujian::find(session('ujian_id'));
        $sesi = Sesi::find(session('sesi_id'));
        $lokasi = Location::find(session('lokasi_id'));
        $station = Station::find(session('station_id'));

        $data = compact('ujian', 'sesi', 'lokasi', 'station');
        return $data;
    }
    private function date_template($station_id)
    {
        $template = Template::with('rubriks')->find($station_id);

        // Ambil semua 'kyd' sekaligus
        $kyd_options = Option::where('type', 'kyd')->get()->keyBy('name');

        $rubrik = $template->rubriks->map(function ($data) use ($kyd_options) {
            $komp = $kyd_options[$data->urutan]->value ?? 'Tidak ditemukan';
            return [
                'id' => $data->id,
                'komp' => $komp,
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
        })->toArray();

        // Ambil semua nama kompetensi dari template
        $kyds = explode(',', $template->komptensi_yang_diujikan);
        $nama_kyds = array_map(function ($kyd) use ($kyd_options) {
            return $kyd_options[$kyd]->value ?? 'Tidak ditemukan';
        }, $kyds);
        $template->nama_kyds = $nama_kyds;

        // Ambil kategori sistem tubuh dan tingkat kemampuan kasus (ambil sekaligus)
        $options = Option::whereIn('type', ['kst', 'skdi'])->get()->groupBy('type');

        $template->nama_kategori_sistem_tubuh = $options['kst']
            ->firstWhere('name', $template->kategori_sistem_tubuh)->value ?? 'Tidak ditemukan';

        $template->nama_tkk = $options['skdi']
            ->firstWhere('name', $template->tingkat_kemampuan_kasus)->value ?? 'Tidak ditemukan';

        return compact('kyds', 'template', 'rubrik');
    }

    public function penguji(){
        $osce = $this->data_osce();
        $template = Template::find($osce['station']->template_id);
        //dd(compact('ujian', 'sesi', 'lokasi', 'station', 'template'));
       return view('osce.auth.register', array_merge($osce, compact('template')));
    }

    public function rotasi(){
        if(!session()->has('Osce')){
            return redirect(route('osce.login'))->with('msg', 'danger-Silahkan scan kartu station');
        }
        if(!session()->has('penguji_id')){
            return redirect(route('osce.penguji.login'))->with('msg', 'danger-Silahkan scan kartu penguji');
        }
        $osce = $this->data_osce();
        $template = Template::find($osce['station']->template_id);
        $rotasi = Rotation::where('location_id', $osce['lokasi']->id)->get();
        $penguji = User::find(session('penguji_id'));
        $list_rotasi = [];
        foreach ($rotasi as $data) {
            if(is_null($data->status)){
                $statr = null;
            } else {
            $statr = json_decode($data->status, true);
            }
            $current = $osce['station']->urutan;
            $statusValuer = is_array($statr) && isset($statr[$current]) ? true : false;
            if(!$statusValuer){
            $list_rotasi[] = [
                'id' => $data->id,
                'nama' => $data->nama,
            ];
            }
        }

        return view('osce.auth.rotasi', array_merge($osce, compact('list_rotasi','rotasi', 'penguji', 'template')));

    }

    public function chek_penguji(Request $request){
        //dd($request->all());
        $request->validate([
            'penguji_slug' => 'required',
        ]);

        $penguji= User::where('slug', $request->penguji_slug)->firstOrFail();
        if($penguji){
            $soal = Soal::find(session('Osce'));
            $soal->penguji_id = $penguji->id;
            $soal->save();
            session([
                'penguji_id' => $penguji->id,
            ]);
            return redirect(route('osce.rotasi'))->with('msg', 'success-Selamat menguji OSCE '.$penguji->name);
        } else {
            return redirect(route('osce.penguji.login'))->with('msg', 'danger-Penguji tidak ditemukan');
        }

    }

    public function penunjang(){
        $osce = $this->data_osce();
        $template = Template::find($osce['station']->template_id);
        return view('osce.penunjang', array_merge($osce, compact('template')));
    }

    public function penunjangStatus()
        { $soal = Soal::find(session('Osce'));
             $status = $soal->tmps;
            return response()->json(['status' => $status]);
        }

        public function showPenunjang()
        {
            $soal = Soal::find(session('Osce'));
            $soal->tmps = $soal->tmps ? 0 : 1;
            $soal->save();
            //dd($soal->tmps);
            return response()->json([
                'status' => $soal->tmps,
            ]);
        }

    public function template()
    {
        $osce = $this->data_osce();
        $station_id = $osce['station']->id;
        $data_template = $this->date_template($station_id);
        return view('osce.ntemplate', array_merge($osce, $data_template));
    }

    Public function ujian_rotasi(string $id){
        $rotasi = Rotation::find($id);
        if($rotasi){
            session([
                'rotasi_id' => $rotasi->id,
                'current_peserta' => 0,
                ]);
                return redirect(route('osce.index'))->with('msg', 'success-Selamat menguji OSCE '.$rotasi->nama);
        } else {
            return redirect(route('osce.rotasi'))->with('msg', 'danger-Rotation tidak ditemukan');
        }
    }

    public function ujian()
{
    // Validasi session awal
    if (!session()->has('Osce')) {
        return redirect(route('osce.login'))->with('msg', 'danger-Silahkan scan kartu station');
    }
    if (!session()->has('penguji_id')) {
        return redirect(route('osce.penguji.login'))->with('msg', 'danger-Silahkan scan kartu penguji');
    }
    if (!session()->has('rotasi_id')) {
        return redirect(route('osce.rotasi'))->with('msg', 'danger-Mohon pilih rotasi');
    }

    // Ambil data utama
    $osce = $this->data_osce();
    $station = $osce['station'];
    $station_id = $station->id;
    $current_station_urutan = $station->urutan;

    $data_template = $this->date_template($station_id);

    $rotasi = Rotation::find(session('rotasi_id'));

    // Ambil seluruh peserta dan user-nya sekaligus
    $pesertaList = $rotasi->pesertas()->with('user')->get()->keyBy('urutan');
    $urutanPeserta = wrap_range_reverse($current_station_urutan, $rotasi->jml_station);

    // Susun daftar peserta
    $list_peserta = [];
    foreach ($urutanPeserta as $index => $urutan) {
        $pes = $pesertaList->get($urutan);

        if (!$pes) continue;

        $stat = $pes->status ? json_decode($pes->status, true) : [];
        $statusValue = $stat[$current_station_urutan] ?? null;

        $user = $pes->user;
        $list_peserta[] = [
            'id' => $index + 1,
            'nama' => $user->name ?? 'Tidak ada peserta',
            'username' => $user->username ?? '--',
            'urutan' => $pes->urutan,
            'status' => $statusValue,
        ];
    }

    asort($list_peserta);

    $penguji = User::find(session('penguji_id'));

    // Peserta saat ini
    $current_index = session('current_peserta');
    $urutan_p = $list_peserta[$current_index]['urutan'] ?? null;

    $curent_user = Peserta::where('rotation_id', $rotasi->id)
        ->where('urutan', $urutan_p)
        ->first();

    if ($curent_user && $curent_user->user_id) {
        $next_peserta = User::find($curent_user->user_id);
        $next_pendaftaran = $curent_user->pendaftaran_id;
    } else {
        $next_peserta = null;
        $next_pendaftaran = null;
    }

    $curent_urutan = $list_peserta[$current_index]['id'] ?? null;
    $mhs = session()->has('mhs_id') ? User::find(session('mhs_id')) : null;

    // Penentu akhir stasiun
    $batas = $current_index + 1;
    $pol = ($batas == $osce['sesi']->jml_station);

    // Kirim ke view
    return view('osce.dashbord', array_merge(
        $osce,
        $data_template,
        compact(
            'rotasi',
            'penguji',
            'pol',
            'list_peserta',
            'next_peserta',
            'next_pendaftaran',
            'curent_urutan',
            'curent_user',
            'mhs'
        )
    ));
}


    public function mhs(Request $request){
        if($request->mhs_slug == $request->peserta_slug){
            $mhs = User::where('slug', $request->peserta_slug)->first();
            session([
                'pendaftaran_id' => $request->pendaftaran_id,
                'mhs_id' => $mhs->id,
            ]);
            return redirect(route('osce.index'))->with('msg', 'success-Menguji mahasiswa '.$mhs->name);
            } else {
                return redirect(route('osce.index'))->with('msg', 'danger-Mahsiswa tidak sesuai urutan');
            }
        }
    public function penilaian(Request $request){
        //dd(session()->all());

        $penilaian = json_decode($request->penilaian, true);
        $feedback = $request->feedback;
        $globalRating = json_decode($request->globalRating, true);
        $next = $request->next + 1; //buat update session current_peserta

        $converted = [];
        $bobot = [];
        $nilai = [];
            foreach ($penilaian as $key => $value) {
                $kyd = Rubrik::where('id', $key)->first();
                $nilai [(int)$kyd->urutan] = $value;
                $bobot[(int)$kyd->urutan] = $kyd->bobot;
                $converted [(int)$kyd->urutan]= $value * $kyd->bobot;
            }
            $gr = $globalRating['GlobalRating'];
            $st = Station::find(session('station_id'));
            $rotasi = Rotation::find(session('rotasi_id'));
            $rstat = is_null($rotasi->status) ? [] : json_decode($rotasi->status, true);
                if (!is_array($rstat)) $rstat = [];
                $rstat[$st->urutan] = $st->urutan;
            $peserta = Peserta::where('id', $request->peserta_id)->first();
            $stat = is_null($peserta->status) ? [] : json_decode($peserta->status, true);
                if (!is_array($stat)) $stat = [];

                // Tambahkan associative entry
                $stat[$st->urutan] = $st->urutan;
            //dd($rstat);
             //buat update session current_peserta
            try {
                DB::beginTransaction();
                if($peserta){
                    $peserta->status = json_encode($stat);
                    $peserta->save();
                }



            $marks = new Nilai();
            $marks->user_id = session('mhs_id');
            $marks->pendaftaran_id = session('pendaftaran_id');
            $marks->station_id = session('station_id');
            $marks->nilai = json_encode($nilai);
            $marks->bobot = json_encode($bobot);
            $marks->nilai_bobot = json_encode($converted);
            $marks->global_rating = $gr;
            $marks->save();

            $umpanbalik = new Umpanbalik();
            $umpanbalik->user_id = session('mhs_id');
            $umpanbalik->pendaftaran_id = session('pendaftaran_id');
            $umpanbalik->station_id = session('station_id');
            $umpanbalik->umpanbalik = $feedback;
            $umpanbalik->save();
                if($request->limit){
                    if($rotasi){
                        $rotasi->status = json_encode($rstat);
                        $rotasi->save();
                    }
                }

            DB::commit();
            if($request->limit){
                session()->forget('current_peserta');
                session()->forget('rotasi_id');
                session()->forget('pendaftaran_id');
                session()->forget('mhs_id');
                return redirect()->route('osce.rotasi')->with('msg', 'success-Penilaian berhasil disimpan, Silakan pilih Rotasi selanjutnya');
            } else {
                session(['current_peserta' => $next]);
                session()->forget('pendaftaran_id');
                session()->forget('mhs_id');
                return redirect()->route('osce.index')->with('msg', 'success-Penilaian berhasil disimpan di Database');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'danger-Mohon ulangi penilaian karena'.$e->getMessage());
        }

    }

    public function tidak_hadir(Request $request){
         $next = $request->next + 1; //buat update session current_peserta
         $st = Station::find(session('station_id'));
         $rotasi = Rotation::find(session('rotasi_id'));
            $rstat = is_null($rotasi->status) ? [] : json_decode($rotasi->status, true);
                if (!is_array($rstat)) $rstat = [];
                $rstat[$st->urutan] = $st->urutan;
         $peserta = Peserta::where('id', $request->peserta_id)->first();
         $stat = is_null($peserta->status) ? [] : json_decode($peserta->status, true);
             if (!is_array($stat)) $stat = [];

             // Tambahkan associative entry
             $stat[$st->urutan] = $st->urutan;
         //dd($stat);
          //buat update session current_peserta
         try {

             if($peserta){
                 $peserta->status = json_encode($stat);
                 $peserta->save();
             }
             if($request->limit){
                if($rotasi){
                    $rotasi->status = json_encode($rstat);
                    $rotasi->save();
                }
            }
             DB::commit();
             if($request->limit){
                session()->forget('current_peserta');
                session()->forget('rotasi_id');
                session()->forget('pendaftaran_id');
                session()->forget('mhs_id');
                return redirect()->route('osce.rotasi')->with('msg', 'success-Penilaian berhasil disimpan, Terimakasih telah menguji mahasiswa kami, Silakan pilih Rotasi selanjutnya');
            } else {
                session(['current_peserta' => $next]);
                session()->forget('pendaftaran_id');
                session()->forget('mhs_id');
                return redirect()->route('osce.index')->with('msg', 'success-Penilaian berhasil disimpan di Database');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'danger-Mohon ulangi penilaian karena'.$e->getMessage());
        }

    }

    public function pasien(Request $request){
        $pasien = User::where('slug', $request->pasien_slug)->first();
        session([
            'pasien_name' => $pasien->name,
        ]);
        return redirect(route('osce.index'))->with('msg', 'success-Pasien berhasil disimpan');
    }

    public function logout(){
        session()->flush();
        return redirect(route('osce.login'));
    }
}
