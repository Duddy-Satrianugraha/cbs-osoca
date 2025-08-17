<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use Illuminate\Http\Request;

class OpesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $ujian = Oujian::query()
            ->when($search, function ($q, $s) {
                return $q->where('name', 'like', "%{$s}%");
            })
            ->paginate(10);

        return view('admin.opeserta.listadm', compact('ujian', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($uid)
    {
        $ujian = Oujian::find($uid);
        return view('admin.opeserta.new', compact('ujian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelompok' => 'required|integer',
            'urutan' => 'required|integer',
        ]);
        $oujian = Oujian::find($request->uid);
        $oujian->peserta()->create([
            'name' => $request->name,
            'npm' => $request->npm,
            'station' => $request->kelompok,
            'sesi' => $request->urutan,
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($uid)
    {
        $peserta = Opeserta::where('oujian_id', $uid)->paginate(100);
        $ujian = Oujian::find($uid);
        //dd($peserta);
        return view('admin.opeserta.listu', compact('peserta', 'ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opeserta $opeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opeserta $opeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opeserta $opeserta)
    {
        //
    }

    public function upload($uid)
    {
        $ujian = Oujian::find($uid);
        return view('admin.opeserta.import', compact('ujian'));
    }
}
