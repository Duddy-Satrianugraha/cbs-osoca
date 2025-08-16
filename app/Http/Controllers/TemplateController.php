<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Option;
use App\Models\Rubrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\DB;
use Exception;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $templates = Template::when($search, function ($query, $search) {
            return $query->where('nama_template', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.template.list', compact('templates', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kst = Option::where('type', 'kst')->get();
        $kyd = Option::where('type', 'kyd')->get();
        $skdi = Option::where('type', 'skdi')->get();
        return view('admin.template.new', compact('kst', 'kyd','skdi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd(implode(',',$request->komptensi_yang_diujikan));
       $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',
            'nomor_station' => 'required|string|max:255',
            'judul_station' => 'required|string|max:255',
            'tingkat_kemampuan_kasus' => 'required|string',
            'komptensi_yang_diujikan' => 'required|array',
            'kategori_sistem_tubuh' => 'required',
        ]);

        try {
            DB::beginTransaction();
            if($request->use_rmd == null){ $use = 0;} else {$use = $request->use_rmd;}
        $template = Template::create([
            'user_id' => Auth::user()->id,
            'nama_template' => $validated['nama_template'],
            'nomor_station' => $validated['nomor_station'],
            'tingkat_kemampuan_kasus' => $validated['tingkat_kemampuan_kasus'],
            'judul_station' => $validated['judul_station'],
            'komptensi_yang_diujikan' => implode(',', $validated['komptensi_yang_diujikan']),
            'kategori_sistem_tubuh' => $validated['kategori_sistem_tubuh'],
            'use_rmd' => $use,
            'j_pasien' => $request->j_pasien,
        ]);

        foreach($validated['komptensi_yang_diujikan'] as $key => $value){
            Rubrik::create([
                'template_id' => $template->id,
                'urutan' => $value,
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
    public function show(Template $template)
    {
        $temp = $template->rubriks()->get();
        $rubrik = [];

        foreach ($temp as $data) {

            $komp = Option::where('type', 'kyd')->where('name', $data->urutan)->first()->value;
            $rubrik[] = [
                'id' => $data->id,
                'komp' => $komp,
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

        $kyds = explode(',', $template->komptensi_yang_diujikan);
        $nama_kyds = [];

        foreach ($kyds as $data) {
            $option = Option::where('type', 'kyd')->where('name', $data)->first();
            $nama_kyds[] = $option ? $option->value : 'Tidak ditemukan';
        }
        $template->nama_kyds = $nama_kyds;

        // Proses kategori sistem tubuh
        $kategori = Option::where('type', 'kst')
            ->where('name', $template->kategori_sistem_tubuh)
            ->first();

        $template->nama_kategori_sistem_tubuh = $kategori ? $kategori->value : 'Tidak ditemukan';

        $kemampuan = Option::where('type', 'skdi')
            ->where('name', $template->tingkat_kemampuan_kasus)
            ->first();

        $template->nama_tkk = $kemampuan ? $kemampuan->value : 'Tidak ditemukan';

        return view('admin.template.show', compact('template', 'rubrik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $kst = Option::where('type', 'kst')->get();
        $kyd = Option::where('type', 'kyd')->get();
        $skdi = Option::where('type', 'skdi')->get();
        return view('admin.template.edit', compact('template', 'kst', 'kyd', 'skdi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        //dd($request->all());
        $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',
            'tingkat_kemampuan_kasus' => 'required|string',
            'nomor_station' => 'required|string|max:255',
            'judul_station' => 'required|string|max:255',
            'komptensi_yang_diujikan' => 'required|array',
            'kategori_sistem_tubuh' => 'required',
        ]);
        try {
            DB::beginTransaction();
            if($request->use_rmd == null){ $use = 0;} else {$use = $request->use_rmd;}
        $template->update([
            'nama_template' => $validated['nama_template'],
            'tingkat_kemampuan_kasus' => $validated['tingkat_kemampuan_kasus'],
            'nomor_station' => $validated['nomor_station'],
            'judul_station' => $validated['judul_station'],
            'komptensi_yang_diujikan' => implode(',', $validated['komptensi_yang_diujikan']),
            'kategori_sistem_tubuh' => $validated['kategori_sistem_tubuh'],
            'use_rmd' => $use,
            'j_pasien' => $request->j_pasien,
        ]);

        $inputUrutan = $validated['komptensi_yang_diujikan']; // array dari request
            $existingUrutan = Rubrik::where('template_id', $template->id)->pluck('urutan')->toArray(); // array dari DB

            // 1. Hapus yang tidak ada di input
            Rubrik::where('template_id', $template->id)
                ->whereNotIn('urutan', $inputUrutan)
                ->delete();

            // 2. Tambah yang belum ada
            foreach ($inputUrutan as $urutan) {
                if (!in_array($urutan, $existingUrutan)) {
                    Rubrik::create([
                        'template_id' => $template->id,
                        'urutan' => $urutan,
                    ]);
                }
            }
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
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->back()->with('msg', 'success-Data berhasil dihapus');
    }

    public function peserta(Template $template)
    {

        return view('admin.template.peserta', compact('template'));
    }

    public function peserta_update(Request $request, Template $template){
        //dd($template);
        $validated =  $request->validate([
            'ipu_skenario_klinik' => 'required|string',
            'ipu_peserta_tugas' => 'required|string',
        ]);

        $template->update([
            'ipu_skenario_klinik' => $validated['ipu_skenario_klinik'],
            'ipu_peserta_tugas' => $validated['ipu_peserta_tugas'],
        ]);

        return redirect(route('admin.templates.index'))->with('msg', 'success-Data berhasil disimpan');
    }

    public function penguji(Template $template)
    {
        return view('admin.template.penguji', compact('template'));
    }
    public function penguji_update(Request $request, Template $template){

       // dd($request->all());
        $validated =  $request->validate([
            "ip_instruksi_umum" => "required|string",
            "ip_ik_anamnesis" => "string",
            "ip_ik_p_fisik" => "string",
            "ip_ik_ttv" => 'string',
            "ip_ik_p_penunjang" => "string",
            "ip_ik_diagnosis" => "string",
            "ip_ik_non_farmakoterapi" => "string",
            "ip_ik_farmakoterapi" => "string",
            "ip_ik_kom_edu" => "string",
            "ip_ik_perilaku" => "string",
            "file_pp" => [File::image()->max(2048)],
        ]);
        try{
            DB::beginTransaction();
        if ($request->hasFile('file_pp')) {
            $file = $request->file('file_pp');
            $filename = $file->hashName();
            $path = $file->storeAs('penunjang', $filename, "public");
            $template->update(['file_pp' => $path]);
        }

        $template->update([
            'ip_instruksi_umum' => $validated['ip_instruksi_umum'] ? $validated['ip_instruksi_umum']:null,
            'ip_ik_anamnesis' => $validated['ip_ik_anamnesis'] ?? null,
            'ip_ik_p_fisik' => $validated['ip_ik_p_fisik'] ?? null,
            'ip_ik_ttv' => $validated['ip_ik_ttv'] ?? null,
            'ip_ik_p_penunjang' => $validated['ip_ik_p_penunjang'] ?? null,
            'ip_ik_diagnosis' => $validated['ip_ik_diagnosis'] ?? null,
            'ip_ik_non_farmakoterapi' => $validated['ip_ik_non_farmakoterapi'] ?? null,
            'ip_ik_farmakoterapi' => $validated['ip_ik_farmakoterapi'] ?? null,
            'ip_ik_kom_edu' => $validated['ip_ik_kom_edu'] ?? null,
            'ip_ik_perilaku' => $validated['ip_ik_perilaku'] ?? null,
        ]);
        DB::commit();
        return redirect(route('admin.templates.index'))->with('msg', 'success-Instruksi Penguji berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.templates.index'))->with('msg', 'danger-Instruksi Penguji gagal disimpan '.$e->getMessage());
        }

    }

    public function del_pp(Template $template){
        Storage::delete('public/' . $template->file_pp);
        $template->update(['file_pp' => null]);
        return redirect(route('admin.templates.penguji', $template))->with('msg', "success-Foto pemeriksaan penunjang berhasil dihapus");
    }


    public function pasien(Template $template)
    {
        return view('admin.template.pasien', compact('template'));
    }

    public function pasien_update(Request $request, Template $template){
        //dd($request->all());
        $validated =  $request->validate([
             "ips_identitas" => "string",
            "ips_rp_sekarang" => "string",
            "ips_rp_dahulu" => "string",
            "ips_rp_keluarga" => "string",
            "ips_r_pribadi" => "string",
            "ips_pertanyaan_wajib" => "string",
            "ips_peran_wajib" => "string",
            "ips_molase" => "string",
        ]);
        $template->update($validated);
        return redirect()->route('admin.templates.index');

    }

    public function rubrik(Template $template)
    {
        //dd($template->rubriks()->get());
        $temp = $template->rubriks()->get();
        $rubrik = [];

        foreach ($temp as $data) {

            $komp = Option::where('type', 'kyd')->where('name', $data->urutan)->first()->value;
            $rubrik[] = [
                'id' => $data->id,
                'komp' => $komp,
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
        return view('admin.template.rubrik', compact( 'rubrik', 'template'));

    }

    public function rubrik_update(Request $request, Template $template){
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
            Rubrik::where('id', $id)->update([
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
        $templates = Template::all();
        return view('admin.template.copy', compact('templates'));
    }
    public function copy(Request $request){
        //dd($request->all());
        $validated =  $request->validate([
            'nama_template' => 'required|string|max:255',
        ]);
        try{
            DB::beginTransaction();
        $template = Template::find($request->old_id_template);
        $new_template = Template::create([
            'user_id' => Auth::user()->id,
            'nama_template' => $validated['nama_template'],
            'nomor_station' => $template->nomor_station,
            'tingkat_kemampuan_kasus' => $template->tingkat_kemampuan_kasus,
            'judul_station' => $template->judul_station,
            'komptensi_yang_diujikan' => $template->komptensi_yang_diujikan,
            'kategori_sistem_tubuh' => $template->kategori_sistem_tubuh,
            'ipu_skenario_klinik' => $template->ipu_skenario_klinik,
            'ipu_peserta_tugas' => $template->ipu_peserta_tugas,
            'ip_instruksi_umum' => $template->ip_instruksi_umum,
            'ip_ik_anamnesis' => $template->ip_ik_anamnesis,
            'ip_ik_p_fisik' =>  $template->ip_ik_p_fisik,
            'ip_ik_ttv' => $template->ip_ik_ttv,
            'ip_ik_p_penunjang' => $template->ip_ik_p_penunjang,
            'ip_ik_diagnosis' => $template->ip_ik_diagnosis,
            'ip_ik_non_farmakoterapi' => $template->ip_ik_non_farmakoterapi,
            'ip_ik_farmakoterapi' => $template->ip_ik_farmakoterapi,
            'ip_ik_kom_edu' => $template->ip_ik_kom_edu,
            'ip_ik_perilaku' => $template->ip_ik_perilaku,
            "ips_identitas" => $template->ips_identitas,
            "ips_rp_sekarang" => $template->ips_rp_sekarang,
            "ips_rp_dahulu" => $template->ips_rp_dahulu,
            "ips_rp_keluarga" =>$template->ips_rp_keluarga,
            "ips_r_pribadi" => $template->ips_r_pribadi,
            "ips_pertanyaan_wajib" => $template->ips_pertanyaan_wajib,
            "ips_peran_wajib" => $template->ips_peran_wajib,
            "ips_molase" => $template->ips_molase,
            'use_rmd' => $template->use_rmd,
            'j_pasien' => $template->j_pasien,
        ]);


        foreach($template->rubriks()->get() as $data){
            $new_template->rubriks()->create([
                'urutan' => $data->urutan,
                'Nilai_0' => $data->Nilai_0,
                'Nilai_1' => $data->Nilai_1,
                'Nilai_2' => $data->Nilai_2,
                'Nilai_3' => $data->Nilai_3,
                'aktif0' => $data->aktif0,
                'aktif1' => $data->aktif1,
                'aktif2' => $data->aktif2,
                'aktif3' => $data->aktif3,
                'bobot' => $data->bobot,
            ]);
        }
        DB::commit();
        return redirect(route('admin.templates.index'))->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.templates.index'))->with('msg', 'danger-Data gagal disimpan '.$e->getMessage());
        }


    }

    public function rekamedik(Template $template){
       // dd($template);
        return view('admin.template.rmd', compact('template'));
    }

}
