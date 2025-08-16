<?php

namespace App\Http\Controllers;

use App\Models\Otemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Orubrik;
use Exception;

class OtemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $templates = Otemplate::when($search, function ($query, $search) {
            return $query->where('nama_template', 'like', '%' . $search . '%');
        })->paginate(10);
          return view('admin.otemplate.list', compact('templates', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.otemplate.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',
            'nomor_soal' => 'required|string|max:255',
            'judul_soal' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();
        $template = Otemplate::create([
            'user_id' => Auth::user()->id,
            'nama_template' => $validated['nama_template'],
            'nomor_station' => $validated['nomor_soal'],
            'judul_station' => $validated['judul_soal'],
        ]);
        $rub =[
            "1" => "Penjelasan pathogenesis dan manifestasi klinis yang muncul",
            "2" => "Penjelasan hubungan trias epidemiologi yang sesuai",
        ];

        foreach($rub as $key => $value){
            Orubrik::create([
                'otemplate_id' => $template->id,
                'urutan' => $key,
                'name' => $value,
            ]);
        }
        DB::commit();
            return redirect(route('admin.templates.index'))->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('admin.templates.index'))->with('msg', 'danger-Data gagal disimpan'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Otemplate $otemplate)
    {
        $temp = $otemplate->first()->rubriks()->get();
        //dd($temp);
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
        $template = $otemplate->first();
        //dd($template);
        return view('admin.otemplate.show', compact('template', 'rubrik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Otemplate $otemplate)
    {
        $template = $otemplate->first();
        Return view('admin.otemplate.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Otemplate $otemplate)
    {
         $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',

            'nomor_soal' => 'required|string|max:255',
            'judul_soal' => 'required|string|max:255',

        ]);
        try {
            DB::beginTransaction();

        $otemplate->update([
            'nama_template' => $validated['nama_template'],
            'nomor_station' => $validated['nomor_soal'],
            'judul_station' => $validated['judul_soal'],
        ]);




            DB::commit();
            return redirect(route('admin.templates.index'))->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('admin.templates.index'))->with('msg', 'danger-Data gagal disimpan'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Otemplate $otemplate)
    {
        $otemplate->first()->rubriks()->delete();
        $otemplate->first()->delete();
        return redirect()->back()->with('msg', 'success-Data berhasil dihapus');
    }

    public function soal(Otemplate $otemplate)
    {

        return view('admin.otemplate.soal', compact('otemplate'));
    }

    public function soal_update(Request $request, Otemplate $otemplate){
        //dd($template);
        $validated =  $request->validate([
            'soal' => 'required|string',
            'tugas_mhs' => 'required|string',
        ]);

        $otemplate->update([
            'soal' => $validated['soal'],
            'tugas_mhs' => $validated['tugas_mhs'],
        ]);

        return back()->with('msg', 'success-Soal berhasil disimpan');
    }

    public function mininote(Otemplate $otemplate)
    {

        return view('admin.otemplate.mininotes', compact('otemplate'));
    }

    public function mininote_update(Request $request, Otemplate $otemplate){
        //dd($request->all());
        $validated =  $request->validate([
            "mininotes" => "required|string",
        ]);
        $otemplate->update($validated);
        return back()->with('msg', 'success-Mininotes berhasil disimpan');

    }

    public function rubrik(Otemplate $otemplate)
    {
        //dd($template->rubriks()->get());
        $temp = $otemplate->rubriks()->get();
        $rubrik = [];

        foreach ($temp as $data) {
            $rubrik[] = [
                'id' => $data->id,
                'komp' => $data->name,
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
        //dd($rubrik);
        return view('admin.otemplate.rubrik', compact( 'rubrik', 'otemplate'));

    }

    public function rubrik_update(Request $request, Otemplate $otemplate){
        //dd($request->all());
        $request->validate([
            'id' => 'required|array',
            'Nilai_0' => 'nullable|array',
            'Nilai_1' => 'nullable|array',
            'Nilai_2' => 'nullable|array',
            'Nilai_3' => 'nullable|array',
            'aktif0' => 'array',
            'aktif1' => 'array',
            'aktif2' => 'array',
            'aktif3' => 'array',
            'bobot' => 'array',
        ]);
        try{
            DB::beginTransaction();

        foreach ($request->id as $index => $id) {
            Orubrik::where('id', $id)->update([
                'Nilai_0' => $request->aktif0[$index] == 1 ? $request->Nilai_0[$index] : null,
                'Nilai_1' => $request->aktif1[$index] == 1 ? $request->Nilai_1[$index] : null,
                'Nilai_2' => $request->aktif2[$index] == 1 ? $request->Nilai_2[$index] : null,
                'Nilai_3' => $request->aktif3[$index] == 1 ? $request->Nilai_3[$index] : null,
                'aktif0' => $request->aktif0[$index] ?? 0, // Jika tidak dicentang, default ke 0
                'aktif1' => $request->aktif1[$index] ?? 0,
                'aktif2' => $request->aktif2[$index] ?? 0,
                'aktif3' => $request->aktif3[$index] ?? 0,
                'bobot' => $request->bobot[$index] ?? 1,
            ]);
        }
        db::commit();
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'danger-Data gagal disimpan '.$e->getMessage());
        }
    }

     public function copy_template(){
        $templates = Otemplate::all();
        return view('admin.otemplate.copy', compact('templates'));
    }
    public function copy(Request $request){
    }
}
