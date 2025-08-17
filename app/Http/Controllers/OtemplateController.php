<?php

namespace App\Http\Controllers;

use App\Models\Otemplate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Orubrik;
use App\Models\Team;
use Exception;

class OtemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
            $search = $request->query('search');

        // Ambil 1 team pertama milik user (atau null)
        $team = Auth::user()?->teams()->first();

        // Ambil daftar user id dalam team tsb (Collection kosong jika null)
        $userIds = $team?->users()->pluck('users.id') ?? collect();

        $templates = Otemplate::query()
            ->when($search, function ($q, $s) {
                return $q->where('nama_template', 'like', "%{$s}%");
            })
            // jika user punya team → filter berdasarkan user_id anggota team
            ->when($userIds->isNotEmpty(), function ($q) use ($userIds) {
                return $q->whereIn('user_id', $userIds);
            })
            ->paginate(10);
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
    public function show($id)
    { 
        $otemplate = Otemplate::find($id);
        $temp = $otemplate->rubrix()->get();
      // dd($temp);
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
        $template = $otemplate;
        //dd($template);
        return view('admin.otemplate.show', compact('template', 'rubrik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $otemplate = Otemplate::find($id);
        Return view('admin.otemplate.edit',['template'=>$otemplate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',
            'nomor_soal' => 'required|string|max:255',
            'judul_soal' => 'required|string|max:255',

        ]);
       // dd($validated);
        try {
            DB::beginTransaction();
            $otemplate = Otemplate::find($id);
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
    public function destroy($id)
    {   $otemplate= Otemplate::find($id);
        $otemplate->rubriks()->delete();
        $otemplate->delete();
        return redirect()->back()->with('msg', 'success-Data berhasil dihapus');
    }

    public function soal($id)
    {
        $otemplate = Otemplate::find($id);
        return view('admin.otemplate.soal', compact('otemplate'));
    }

    public function soal_update(Request $request, $id){
        //dd($template);
        $validated =  $request->validate([
            'soal' => 'required|string',
            'tugas_mhs' => 'required|string',
        ]);
         $otemplate = Otemplate::find($id);
        $otemplate->update([
            'soal' => $validated['soal'],
            'tugas_mhs' => $validated['tugas_mhs'],
        ]);

        return back()->with('msg', 'success-Soal berhasil disimpan');
    }

    public function mininote($id)
    {
         $otemplate = Otemplate::find($id);
        return view('admin.otemplate.mininotes', compact('otemplate'));
    }

    public function mininote_update(Request $request, $id){
        //dd($request->all());
        $validated =  $request->validate([
            "mininotes" => "required|string",
        ]);
        $otemplate = Otemplate::find($id);
        $otemplate->update($validated);
        return back()->with('msg', 'success-Mininotes berhasil disimpan');

    }

    public function rubrik($id)
    {
        //dd($template->rubriks()->get());
        $otemplate = Otemplate::find($id);
        $temp = $otemplate->rubrix()->get();
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

    public function rubrik_update(Request $request,$id){
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
         // Ambil 1 team pertama milik user (atau null)
        $team = Auth::user()?->teams()->first();

        // Ambil daftar user id dalam team tsb (Collection kosong jika null)
        $userIds = $team?->users()->pluck('users.id') ?? collect();

        $templates = Otemplate::query()->when($userIds->isNotEmpty(), function ($q) use ($userIds) {
                return $q->whereIn('user_id', $userIds);
            })
            ->get();
        
        return view('admin.otemplate.copy', compact('templates'));
    }
    public function copy(Request $request){
            $request->validate([                
                'old_id_template' => 'required|integer',
                'nama_template' => 'required|string',
            ]);
            try{
                DB::beginTransaction();
                $old_template = Otemplate::find($request->old_id_template);
                $new_template = Otemplate::create([
                    'nama_template' => $request->nama_template,
                    'user_id' => Auth::user()->id,
                    'nomor_station' => $old_template->nomor_station,
                    'judul_station' => $old_template->judul_station,
                    'soal' => $old_template->soal,
                    'tugas_mhs' => $old_template->tugas_mhs,
                    'mininotes' => $old_template->mininotes,
                ]);
                $old_template->rubrix()->each(function($rubrik) use ($new_template){
                    Orubrik::create([
                        'otemplate_id' => $new_template->id,
                        'urutan' => $rubrik->urutan,
                        'name' => $rubrik->name,
                        'Nilai_0' => $rubrik->Nilai_0,
                        'Nilai_1' => $rubrik->Nilai_1,
                        'Nilai_2' => $rubrik->Nilai_2,
                        'Nilai_3' => $rubrik->Nilai_3,
                        'aktif0' => $rubrik->aktif0,
                        'aktif1' => $rubrik->aktif1,
                        'aktif2' => $rubrik->aktif2,
                        'aktif3' => $rubrik->aktif3,
                        'bobot' => $rubrik->bobot,
                    ]);
                });
                DB::commit();
                return redirect()->back()->with('msg', 'success-Template  berhasil dicopy');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('msg', 'danger-Template  gagal dicopy '.$e->getMessage());
            }
    }
}
