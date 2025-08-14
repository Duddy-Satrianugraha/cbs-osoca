<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujian =  Ujian::where('daftar_peserta', true)->get();
        $pendaftaran = Pendaftaran::Where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('mhs.pendaftaran.list', compact('pendaftaran', 'ujian'));
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
        //dd($request);
        $validated =  $request->validate([
            'ujian' => 'required|integer',
        ]);
        $ujian = Ujian::find($validated['ujian']);
        $nama_osce = $ujian->name . ' (' . $ujian->ta . ')';
        $pendaftaran = Pendaftaran::create([
            'ujian_id' => $validated['ujian'],
            'nama_osce' => $nama_osce,
            'user_id' => Auth::user()->id,
        ]);
        return redirect(route('mahasiswa.pendaftaran.index'))->with('msg', 'success-Anda berhasil berhasil mendaftar pada OSCE '.$nama_osce);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
