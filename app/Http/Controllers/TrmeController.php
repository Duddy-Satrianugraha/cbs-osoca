<?php

namespace App\Http\Controllers;

use App\Models\Trme;
use App\Models\Option;
use Illuminate\Http\Request;

class TrmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $rme = trme::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('admin.rmd.list', compact('rme', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = Option::where('type', '=', 'jpp')->get();
        return view('admin.rmd.new', compact('jenis'));
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
    public function show(Trme $trme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trme $trme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trme $trme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trme $trme)
    {
        //
    }
}
