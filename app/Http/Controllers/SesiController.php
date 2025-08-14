<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Ujian;
use App\Models\Location;
use App\Models\Rotation;
use App\Models\Station;
use App\Models\Peserta;
use App\Models\Soal;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $ujian = Ujian::find($id);
        return view('admin.sesi.new', compact('ujian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    private function angkaKeHuruf($angka) {

        if ($angka >= 1 && $angka <= 26) {
            return chr(64 + $angka);
        }
        $huruf = '';
        while ($angka > 0) {
            $angka--;
            $huruf = chr($angka % 26 + 65) . $huruf;
            $angka = intdiv($angka, 26);
        }
        return $huruf;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'jml_lokasi' => 'required|numeric',
            'jml_rotasi' => 'required|numeric',
            'jml_station' => 'required|numeric',
            'tgl_ujian' => 'required|date',
            'ujian_id' => 'required',
        ]);
        try{
            DB::beginTransaction();
        $validatedData['slug'] = now()->format('YmdHis');
        $sesi = Sesi::create($validatedData);

        for($h = 1; $h <= $validatedData['jml_station']; $h++){
            $station = new station;
            $station->sesi_id = $sesi->id;
            $station->name = 'Station '.$h;
            $station->urutan = $h;
            $station->save();

        }

        for($i = 1; $i <= $validatedData['jml_lokasi']; $i++){
            $l = $this->angkaKeHuruf($i);
            $location = new Location;
            $location->nama = 'Lokasi '.$l;
            $location->sesi_id = $sesi->id;
            $location->jml_station = $validatedData['jml_station'];
            $location->ujian_id = $validatedData['ujian_id'];
            $location->save();

            for($k = 1; $k <= $validatedData['jml_station']; $k++){
                $idstat = Station::where('sesi_id', $sesi->id)->where('urutan', $k)->first()->id;
                $soal = new Soal;
                $soal->slug = Str::random(10).$location->id;
                $soal->sesi_id = $sesi->id;
                $soal->ujian_id = $validatedData['ujian_id'];
                $soal->station_id = $idstat;
                $soal->location_id = $location->id;
                $soal->urutan = $k;
                $soal->save();

            }

            for($j = 1; $j <= $validatedData['jml_rotasi']; $j++){
                $rotasi = new Rotation;
                $rotasi->nama = 'Rotasi '.$j;
                $rotasi->full_name = $sesi->name.'-'.$location->nama.'- Rotasi '.$j;
                $rotasi->sesi_id = $sesi->id;
                $rotasi->ujian_id = $validatedData['ujian_id'];
                $rotasi->location_id = $location->id;
                $rotasi->jml_station = $validatedData['jml_station'];
                $rotasi->save();

                for($m = 1; $m <= $validatedData['jml_station']; $m++){
                    $peserta = new Peserta;
                    $peserta->sesi_id = $sesi->id;
                    $peserta->location_id = $location->id;
                    $peserta->rotation_id = $rotasi->id;
                    $peserta->urutan = $m;
                    $peserta->save();
                }
            }
        }
        DB::commit();
        return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'success-Sesi baru berhasil dibuat');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'danger-Sesi gagal dibuat '.$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        $st = Template::all();
        $stations = Station::where('sesi_id', $sesi->id)->get();
        return view('admin.sesi.slist', compact('sesi', 'st', 'stations' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesi $sesi)
    {
        return view('admin.sesi.edit', compact('sesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesi $sesi)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'jml_lokasi' => 'required|numeric',
            'jml_rotasi' => 'required|numeric',
            'jml_station' => 'required|numeric',
            'tgl_ujian' => 'required|date',
            'ujian_id' => 'required',
        ]);
        try{
            DB::beginTransaction();
        $needRebuild =
            $validatedData['jml_station'] != $sesi->jml_station ||
            $validatedData['jml_lokasi'] != $sesi->jml_lokasi ||
            $validatedData['jml_rotasi'] != $sesi->jml_rotasi ||
            $validatedData['ujian_id'] != $sesi->ujian_id;

        // Update field dasar
        $sesi->update([
            'name' => $validatedData['name'],
            'tgl_ujian' => $validatedData['tgl_ujian'],
            'jml_lokasi' => $validatedData['jml_lokasi'],
            'jml_rotasi' => $validatedData['jml_rotasi'],
            'jml_station' => $validatedData['jml_station'],
            'ujian_id' => $validatedData['ujian_id'],
        ]);

        // Smart update untuk station
        $existingStations = Station::where('sesi_id', $sesi->id)->get()->keyBy('urutan');

        for ($k = 1; $k <= $validatedData['jml_station']; $k++) {
            if ($existingStations->has($k)) {
                $station = $existingStations[$k];
                $station->update([
                    'name' => 'Station '.$k,
                    // template_id tidak diubah
                ]);
            } else {
                Station::create([
                    'sesi_id' => $sesi->id,
                    'name' => 'Station '.$k,
                    'urutan' => $k,
                    'template_id' => null, // default, bisa diubah jika diperlukan
                ]);
            }
        }

        // Hapus station kelebihan
        foreach ($existingStations as $urutan => $station) {
            if ($urutan > $validatedData['jml_station']) {
                $station->delete();
            }
        }

        // Jika perlu rebuild relasi lain
        if ($needRebuild) {
            Location::where('sesi_id', $sesi->id)->delete();
            Soal::where('sesi_id', $sesi->id)->delete();
            Rotation::where('sesi_id', $sesi->id)->delete();
            Peserta::where('sesi_id', $sesi->id)->delete();

            for($i = 1; $i <= $validatedData['jml_lokasi']; $i++) {
                $l = $this->angkaKeHuruf($i);
                $location = Location::create([
                    'nama' => 'Lokasi '.$l,
                    'sesi_id' => $sesi->id,
                    'jml_station' => $validatedData['jml_station'],
                    'ujian_id' => $validatedData['ujian_id'],
                ]);

                for($k = 1; $k <= $validatedData['jml_station']; $k++) {
                    $idstat = Station::where('sesi_id', $sesi->id)->where('urutan', $k)->first()->id;
                    Soal::create([
                        'slug' => Str::random(10).$location->id,
                        'sesi_id' => $sesi->id,
                        'ujian_id' => $validatedData['ujian_id'],
                        'station_id' => $idstat,
                        'location_id' => $location->id,
                        'urutan' => $k,
                    ]);
                }

                for($j = 1; $j <= $validatedData['jml_rotasi']; $j++) {
                   $rotasi = Rotation::create([
                        'nama' => 'Rotasi '.$j,
                        'full_name' => $sesi->name.'-'.$location->nama.'- Rotasi '.$j,
                        'sesi_id' => $sesi->id,
                        'ujian_id' => $validatedData['ujian_id'],
                        'location_id' => $location->id,
                        'jml_station' => $validatedData['jml_station'],
                    ]);
                    for($m = 1; $m <= $validatedData['jml_station']; $m++){
                        $peserta = new Peserta;
                        $peserta->sesi_id = $sesi->id;
                        $peserta->location_id = $location->id;
                        $peserta->rotation_id = $rotasi->id;
                        $peserta->urutan = $m;
                        $peserta->save();
                    }
                }
            }
        }
        DB::commit();
        return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'success-Sesi berhasil diperbarui, mohon periksa kembali data station');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'danger-Sesi gagal diperbarui '.$e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesi $sesi)
    {
        try{
            DB::beginTransaction();
            Station::where('sesi_id', $sesi->id)->delete();
            Soal::where('sesi_id', $sesi->id)->delete();
            Rotation::where('sesi_id', $sesi->id)->delete();
            Location::where('sesi_id', $sesi->id)->delete();
            $sesi->delete();
            DB::commit();
            return redirect()->route('admin.ujian.show', $sesi->ujian()->first()->id)->with('msg', 'success-Sesi berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ujian.show', $sesi->ujian()->first()->id)->with('msg', 'danger-Sesi gagal dihapus '.$e->getMessage());
        }
    }

    public function copy_sesi($uid){
        $ujian= Ujian::find($uid);
        $sesi = $ujian->sesi()->get();
        return view('admin.sesi.copy', compact('ujian', 'sesi'));

    }

    public function copy(Request $request, $uid){
        //dd($request->all());
        $validated =  $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'tgl_ujian' => 'required|date',
        ]);

        try{
            DB::beginTransaction();
        $oldsesi = Sesi::find($request->old_id_sesi);
        $newsesi = new Sesi;
        $newsesi->name =  $validated['nama_sesi'];
        $newsesi->tgl_ujian = $validated['tgl_ujian'];
        $newsesi->jml_lokasi = $oldsesi->jml_lokasi;
        $newsesi->jml_rotasi = $oldsesi->jml_rotasi;
        $newsesi->jml_station = $oldsesi->jml_station;
        $newsesi->ujian_id = $uid;
        $newsesi->slug = now()->format('YmdHis');
        $newsesi->save();

        $oldstation = $oldsesi->stations()->get();
        foreach($oldstation as $datao){
            $newstation = new Station;
            $newstation->sesi_id = $newsesi->id;
            $newstation->name = $datao->name;
            $newstation->urutan = $datao->urutan;
            $newstation->template_id = $datao->template_id;
            $newstation->istirahat = $datao->istirahat;
            $newstation->save();
        }
        $oldlokasi = $oldsesi->locations()->get();
        foreach($oldlokasi as $datap){
            $newlokasi = new Location;
            $newlokasi->sesi_id = $newsesi->id;
            $newlokasi->ujian_id = $uid;
            $newlokasi->nama = $datap->nama;
            $newlokasi->jml_station = $datap->jml_station;
            $newlokasi->save();

            $oldsoal = Soal::where('sesi_id', $oldsesi->id)->where('location_id', $datap->id)->get();
            foreach($oldsoal as $data){
                $newsoal = new Soal;
                $newsoal->sesi_id = $newsesi->id;
                $newsoal->ujian_id = $uid;
                $newsoal->location_id = $newlokasi->id;
                $newsoal->station_id = $data->station_id;
                $newsoal->slug = Str::random(10).$newlokasi->id;
                $newsoal->urutan = $data->urutan;
                $newsoal->save();
            }

            $oldrotasi = $datap->rotations()->get();
            foreach($oldrotasi as $data){
                $newrotasi = new Rotation;
                $newrotasi->nama = $data->nama;
                $newrotasi->full_name = $newsesi->name.'-'.$newlokasi->nama.'- Rotasi '.$data->nama;
                $newrotasi->sesi_id = $newsesi->id;
                $newrotasi->location_id = $newlokasi->id;
                $newrotasi->jml_station = $data->jml_station;
                $newrotasi->ujian_id = $uid;
                $newrotasi->save();
                for($m = 1; $m <= $data->jml_station; $m++){
                    $peserta = new Peserta;
                    $peserta->sesi_id = $newsesi->id;
                    $peserta->location_id = $newlokasi->id;
                    $peserta->rotation_id = $newrotasi->id;
                    $peserta->urutan = $m;
                    $peserta->save();
                }
            }

        }
        DB::commit();
        return redirect()->route('admin.ujian.show', $uid)->with('msg', 'success-Sesi berhasil di copy');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ujian.show', $uid)->with('msg', 'danger-Sesi gagal di copy '.$e->getMessage());
        }
    }
}

