<?php

namespace App\Http\Controllers;

use App\Models\Openguji;
use Illuminate\Http\Request;

class OpengujiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

            $penguji = Openguji::query()
        ->when($search, function ($q) use ($search) {
            $s = trim($search);

            // Contoh: jika input numerik, ikutkan opsi exact match ke NPM
            $q->where(function ($qq) use ($s) {
                $qq->where('nama', 'like', "%{$s}%")
                   ->orWhere('nik', 'like', "%{$s}%");

                if (ctype_digit($s)) {
                    $qq->orWhere('nik', $s); // optional exact match
                }
            });
        })
        ->orderBy('id')
        ->paginate(40)
        ->appends(['search' => $search]);

        return view('admin.openguji.list', compact('penguji'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.openguji.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
        ]);
        $qr = numran(15);
        $penguji = Openguji::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'qr_penguji' => $qr,
        ]);
        return redirect(route('admin.penguji.index'))->with('msg', 'success-Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Openguji $openguji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penguji = Openguji::findOrFail($id);
        return view('admin.openguji.edit', compact('penguji'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
        ]);
        $penguji = Openguji::findOrFail($id);
        $penguji->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    public function print(Request $request)
        {
            //dd($request);
            $ids = $request->penguji_id; // array id penguji terpilih
            if (!$ids) {
                return back()->with('error', 'Silakan pilih minimal satu penguji.');
            }

            $pengujis = Openguji::whereIn('id', $ids)->get();
           // dd($pengujis);
           $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdf.penguji', compact('pengujis'))
            ->setPaper('A4', 'portrait');
            return $pdf->stream('kartu_penguji.pdf');
        }

    public function massDelete(Request $request)
        {
            $ids = $request->penguji_id;
            if (!$ids) {
                return back()->with('error', 'Silakan pilih minimal satu penguji.');
            }

            Openguji::whereIn('id', $ids)->delete();

            return back()->with('success', 'Penguji terpilih berhasil dihapus.');
        }
}
