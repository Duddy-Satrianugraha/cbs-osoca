<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Rotation;
use App\Models\Ujian;
use App\Models\Peserta;
use Illuminate\Http\Request;

class RotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $ujian = Ujian::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('admin.peserta.list', compact('ujian', 'search'));

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

    public function show(Request $request,Ujian $ujian)
    {
        $search = $request->query('search');

        $list = $ujian->rotations()
        ->withCount(['pesertas as peserta_null_count' => function ($query) {
            $query->whereNull('user_id');
        }])
        ->when($search, function ($query, $search) {
            return $query->where('full_name', 'like', '%' . $search . '%');
        })
        ->paginate(10);

        return view('admin.peserta.list_rotasi', compact('list','ujian' ,'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rotation $rotation)
    {
        $ujian = $rotation->sesi()->first()->ujian()->first();
        $peserta = Peserta::where('rotation_id', $rotation->id)->get();
        $pendaftar = Pendaftaran::where('ujian_id', $ujian->id)->get();
        //dd($rotation->sesi()->first()->ujian()->first());
        return view('admin.peserta.list_peserta', compact('peserta','ujian', 'rotation', 'pendaftar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rotation $rotation)
    {
        //dd($request->all());
        $request->validate([
            'pendaftar_id' => 'array',
        ]);
        foreach ($request->pendaftar_id as $key => $value) {
            if($value == "null"){
                $user = null;
                $idp = null;
            } else {
                $da = Pendaftaran::find($value)->user_id;
                //dd($da);
                $user = $da;
                $idp = $value;
            }

            $pendaftar = Peserta::where('id', $key)->first()->update([
                'pendaftaran_id' => $idp,
                'user_id' => $user,
            ]);
        }
        return redirect()->back()->with('msg', 'success-Data peserta berhasil disimpan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rotation $rotation)
    {
        //
    }

    public function list(Rotation $rotation){
        $list = $rotation->pesertas()->get();
        return view('admin.peserta.list_peserta', compact('list','rotation'));
    }

    public function open(Ujian $ujian)
    {
        $ujian->daftar_peserta = true;
        $ujian->save();
        return redirect()->back()->with('msg', 'success-Pendaftaran telah di buka');
    }
    public function close(Ujian $ujian)
    {
        $ujian->daftar_peserta = null;
        $ujian->save();
        return redirect()->back()->with('msg', 'success-Pendaftaran telah di tutup');
    }
}

