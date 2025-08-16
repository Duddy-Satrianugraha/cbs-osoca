<?php

namespace App\Http\Controllers;

use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Osesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OujianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $search = $request->query('search');

        $ujian = Oujian::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('admin.oujian.list', compact('ujian', 'search'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.oujian.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'tgl_ujian' => 'required|date',
            'jml_station' => 'required|integer',
            'jml_sesi' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
        $oujian = Oujian:: create([
            'name' => $validated['name'],
            'ta' => $validated['tahun_akademik'],
            'tgl_ujian' => $validated['tgl_ujian'],
            'jml_station' => $validated['jml_station'],
            'jml_sesi' => $validated['jml_sesi'],
        ]);
         for ($x = 1; $x <= $validated['jml_station']; $x++) {
                $oustation = Ostation::create([
                    'oujian_id' => $oujian->id,
                    'urutan' => $x,
                    'name' => 'station '.$x,
                    'qrstation' => numran(10).$oujian->id.$x,
                    'penguji_id' => null,
                ]);
                }
        for ($x = 1; $x <= $validated['jml_sesi']; $x++) {
            $osesi = Osesi::create([
                'oujian_id' => $oujian->id,
                'urutan' => $x,
                'otemplate_id' => null,
            ]);
        }
        DB::commit();   
        return redirect(route('admin.ujian.index'))->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.ujian.index'))->with('msg', 'danger-Data gagal disimpan'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $ujian = Oujian::find($id);
        return view('admin.oujian.edit', compact('ujian'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'tgl_ujian' => 'required|date',
            'jml_station' => 'required|integer',
            'jml_sesi' => 'required|integer',
        ]);
        $oujian = Oujian::find($id);
        $oujian->update([
            'name' => $validated['name'],
            'ta' => $validated['tahun_akademik'],
            'tgl_ujian' => $validated['tgl_ujian'],
            'jml_station' => $validated['jml_station'],
            'jml_sesi' => $validated['jml_sesi'],
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oujian $oujian)
    {
        
    }
}
