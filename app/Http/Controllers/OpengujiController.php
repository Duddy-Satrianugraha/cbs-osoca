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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Openguji $openguji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Openguji $openguji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Openguji $openguji)
    {
        //
    }
}
