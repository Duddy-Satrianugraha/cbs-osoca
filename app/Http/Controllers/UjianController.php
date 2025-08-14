<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;


class UjianController extends Controller
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
        return view('admin.ujian.list', compact('ujian', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ujian.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'quesioner' => 'boolean',
            'tahun_akademik' => 'required|string|max:255',
        ]);
           $ujian = Ujian:: create([
               'name' => $validated['name'],
               'ta' => $validated['tahun_akademik'],
               'quesioner' => $validated['quesioner'] ?? null,
           ]);
           return redirect(route('admin.ujian.index'))->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ujian $ujian)
    {

        $search = $request->query('search');

        $list = $ujian->sesi()
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', '%' . $search . '%');
                })
                ->with('stations') // bukan withCount
                ->paginate(10);

        // Hitung rotasi & peserta
        foreach ($list as $data) {
            $data->template_count = $data->jml_station - $data->stations
                ->whereNull('istirahat')
                ->whereNull('template_id')
                ->count();

            $data->rotasi = $data->jml_lokasi * $data->jml_rotasi;
            $data->peserta = $data->rotasi * $data->jml_station;
        }
        //dd($list);

        return view('admin.sesi.list', compact('list', 'ujian', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ujian $ujian)
    {
        return view('admin.ujian.edit', compact('ujian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ujian $ujian)
    {
        //dd($request->all());
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'quesioner' => 'boolean',
            'tahun_akademik' => 'required|string|max:255',

        ]);
        $ujian->update([
            'name' => $validated['name'],
            'ta' => $validated['tahun_akademik'],
            'quesioner' => $validated['quesioner'] ?? null,
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->back()->with('msg', 'success-Data berhasil dihapus');
    }
}

