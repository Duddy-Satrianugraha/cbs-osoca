<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
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
        ->paginate(40)
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
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
}
