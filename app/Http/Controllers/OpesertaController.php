<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Oujian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function destroy(Opeserta $opeserta)
    {
        //
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
        'uid' => ['required','integer','exists:oujians,id'],
         ]);

         $dataPeserta = Excel::toCollection(new ImportPeserta, $validated['file']);

          $npms = collect($dataPeserta[0])
        ->skip(1)   // lewati header
        ->pluck(2)  // kolom ke-3 = npm (0=kolom1, 1=kolom2, dst)
        ->filter()  // hapus null/kosong
        ->all();

    // 3. Ambil npm yang sudah ada di DB untuk oujian ini
        $existing = \App\Models\Opeserta::where('oujian_id', $validated['uid'])
        ->whereIn('npm', $npms)
        ->pluck('npm')
        ->all();

         $pesertaarray = [];
         foreach ($dataPeserta[0] as $key=>$row) {
            if($key >= 1){
                 $npm     = trim((string)($row[2] ?? ''));
                 $station = $row[3] ?? null;
                $sesi    = $row[4] ?? null;

                if (count(array_filter($row, fn($val) => !is_null($val) && $val !== '')) === 0) {
                        continue;
                    }

                if (!ctype_digit((string)$station) || !ctype_digit((string)$sesi)) {
                    return back()->withErrors([
                        'file' => "Baris ke-".($key+1)." kolom station/Urutan harus angka dan bilangan bulat."
                    ]);
                }

                 if (in_array($npm, $existing)) {
                        continue;
                    }

                $pesertaarray[] = [
                    'oujian_id' => $validated['uid'],
                    'name' => $row['1'],
                    'npm' => $row['2'],
                    'station' => $row['3'],
                    'sesi' => $row['4'],
                    'qrpeserta' => numran(12),
                ];
            }   
         }
         Opeserta::insert($pesertaarray);

         if (count($pesertaarray)) {
        Opeserta::insert($pesertaarray);
        }
         return redirect()->back()->with('msg', 'success-Import selesai. '
        .count($pesertaarray).' baris baru dimasukkan, '
        .count($existing).' baris dilewati (duplikat/kosong).');
    }
}
