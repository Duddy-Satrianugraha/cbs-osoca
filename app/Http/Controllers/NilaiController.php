<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Onilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $search = $request->query('search');
        $list = Oujian::query()
            ->when($search, function ($q, $s) {
                return $q->where('name', 'like', "%{$s}%");
            })
            ->paginate(10);

        return view('admin.onilai.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($uid)
    {
         $search = request('search');

    $peserta = Opeserta::query()
        ->where('oujian_id', $uid) // filter ujian dulu
        ->when($search, function ($q) use ($search) {
            $s = trim($search);

            // Contoh: jika input numerik, ikutkan opsi exact match ke NPM
            $q->where(function ($qq) use ($s) {
                $qq->where('name', 'like', "%{$s}%")
                   ->orWhere('npm', 'like', "%{$s}%");

                if (ctype_digit($s)) {
                    $qq->orWhere('npm', $s); // optional exact match
                }
            });
        })
        ->orderBy('id')
        ->paginate(50)
        ->appends(['search' => $search]); // agar nilai search ikut di pagination links

    $ujian = Oujian::findOrFail($uid);

    return view('admin.onilai.listu', compact('peserta', 'ujian', 'search'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peserta = Opeserta::find($id);
        $ujian = $peserta->oujian;
        $nilai = $peserta->nilai;
        return view('admin.onilai.edit', compact('peserta', 'ujian', 'nilai'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peserta = Opeserta::find($id);
        $peserta->nilai->delete();
        return redirect(route('admin.nilai.show', $peserta->oujian_id))->with('msg', 'success-Data Nilai berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'skor' => 'required|array',
            ]);

            $peserta = Opeserta::with(['oujian', 'oujian.stations', 'oujian.sesis.otemplate.rubrix'])
                ->findOrFail($id);

            $ujian   = $peserta->oujian;
            $jumlah  = array_sum($validated['skor']);

            // Cari sesi + rubrik
            $sesi    = $ujian->sesis()->where('urutan', $peserta->sesi)->first();
            $jmlRubrik = $sesi?->otemplate?->rubrix()->count() ?? 0;

            // Cari station
            $station = $ujian->stations()->where('urutan', $peserta->station)->first();

            // Hitung nilai
            $rubrikMax = max($jmlRubrik * 3, 1);
            $mark      = round(($jumlah / $rubrikMax) * 100, 2);

            if ($ujian->remedial) {
                $mark = min($mark, 67);
            }

            // Simpan atau update nilai
            $nilai = Onilai::updateOrCreate(
                ['id' => $request->nilai_id],
                [
                    'oujian_id'  => $ujian->id,
                    'sesi_id'    => $peserta->sesi,
                    'station_id' => $station?->id,
                    'qrpeserta'  => $peserta->qrpeserta,
                    'peserta_id' => $peserta->id,
                    'nama'       => $peserta->name,
                    'npm'        => $peserta->npm,
                    'skor'       => json_encode($validated['skor']),
                    'jumlah'     => $jumlah,
                    'nilai'      => $mark,
                ]
            );

            if ($nilai->wasRecentlyCreated) {
                $peserta->update(['status' => true]);
            }

            $msg = $request->filled('nilai_id')
                ? 'success-Data Nilai berhasil diupdate'
                : 'success-Data Nilai berhasil disimpan';

            return redirect()
                ->route('admin.nilai.show', $ujian->id)
                ->with('msg', $msg);
        }

    public function export($uid)
    {
        $ujian = Oujian::findOrFail($uid);

        // eager load relasi nilai
        $peserta = $ujian->peserta()
            ->with('nilai')
            ->get();

        // kirim data ke export
        return Excel::download(new NilaiExport($ujian, $peserta), 'nilai-'.$ujian->name.'.xlsx');
    }

}
