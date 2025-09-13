<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

use App\Imports\ImportPeserta;



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

    return view('admin.opeserta.listu', compact('peserta', 'ujian', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peserta = Opeserta::findOrFail($id);
        $ujian = Oujian::find($peserta->oujian_id);
        return view('admin.opeserta.edit', compact('peserta', 'ujian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opeserta $opeserta)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'station' => 'required|integer',
            'sesi' => 'required|integer',
        ]);
        $peserta = Opeserta::findOrFail($opeserta->id);
        $peserta->update([
            'name' => $request->name,
            'npm' => $request->npm,
            'station' => $request->station,
            'sesi' => $request->sesi,
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Opeserta::find($id)->delete();
        return redirect()->back()->with('msg', 'success-Data berhasil dihapus');
    }

    public function upload($uid)
    {
        $ujian = Oujian::find($uid);
        return view('admin.opeserta.import', compact('ujian'));
    }

    public function store_upload(Request $request)
        {
            $validated = $request->validate([
                'file' => ['required','file','mimes:xlsx,xls,csv','max:51200'],
                'uid'  => ['required','integer','exists:oujians,id'],
            ]);

            $dataPeserta = Excel::toCollection(new ImportPeserta, $validated['file']);
            $sheet = $dataPeserta[0] ?? collect();

            $npms = collect($sheet)
                ->skip(1)
                ->pluck(2)
                ->filter()
                ->all();

            $existing = \App\Models\Opeserta::where('oujian_id', $validated['uid'])
                ->whereIn('npm', $npms)
                ->pluck('npm')
                ->all();

            $running = [];
            $pesertaarray = [];
            $seenInThisImport = [];
            $skippedDuplicateInFile = 0;

            foreach ($sheet as $key => $row) {
                if ($key < 1) continue;

                if ($row->filter(fn($val) => !is_null($val) && $val !== '')->isEmpty()) {
                    continue;
                }

                $nama    = trim((string)($row[1] ?? ''));
                $npm     = trim((string)($row[2] ?? ''));
                $station = $row[3] ?? null;

                if ($npm === '') {
                    return back()->withErrors([
                        'file' => "Baris ke-".($key+1).": NPM wajib diisi."
                    ]);
                }
                if (!ctype_digit((string)$station)) {
                    return back()->withErrors([
                        'file' => "Baris ke-".($key+1).": kolom Station harus angka bilangan bulat."
                    ]);
                }
                $station = (int)$station;

                if (in_array($npm, $existing, true)) {
                    continue;
                }

                if (isset($seenInThisImport[$npm])) {
                    $skippedDuplicateInFile++;
                    continue;
                }
                $seenInThisImport[$npm] = true;

                $running[$station] = ($running[$station] ?? 0) + 1;
                $sesi = $running[$station];

                $pesertaarray[] = [
                    'oujian_id'  => $validated['uid'],
                    'name'       => $nama,
                    'npm'        => $npm,
                    'station'    => $station,
                    'sesi'       => $sesi,
                    'qrpeserta'  => md5($npm),
                ];
            }

            if (count($pesertaarray)) {
                \App\Models\Opeserta::insert($pesertaarray);
            }



            $inserted = count($pesertaarray);
            $skippedExisting = count($existing);

            return redirect(route('admin.peserta.show', $validated['uid']))->with(
                'msg',
                'success-Import selesai. '
                .$inserted.' baris baru dimasukkan, '
                .$skippedExisting.' baris dilewati (duplikat di DB), '
                .$skippedDuplicateInFile.' baris dilewati (duplikat di file).'
            );
        }

public function avatar_update($uid){

    $apiUrl = config('services.feedback_api.url').'avatars';
    $npms = Opeserta::where('oujian_id', $uid)->pluck('npm')->toArray();
        $response = Http::withToken(config('services.feedback_api.token'))
            ->post($apiUrl, [
                'npms' => $npms,
            ]);

        if ($response->successful()) {
                $avatars = $response->json();

                // Hitung berapa avatar yang masih null
                $nullCount = collect($avatars)->filter(fn($v) => is_null($v))->count();

                foreach ($avatars as $npm => $url) {
                    if ($url) {
                        Opeserta::where('oujian_id', $uid)
                            ->where('npm', $npm)
                            ->update(['avatar' => $url]);
                    }
                }

                return back()->with([
                    'msg' => "success-Avatar berhasil diperbaharui. Masih ada {$nullCount} avatar kosong."
                ]);
            } else {
            return back()->with([
                'msg' => "danger-Gagal mengambil avatar".$response->body()
            ]);
        }
}


}
