<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $option = Option::paginate(10);
        return view('admin.opt.list', compact('option'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $option = Option::Where('type', '=', 'ahli')->paginate(10);
        return view('admin.opt.list_abil', compact('option'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);

        Option::create($request->except('_token'));
        return redirect()->back()->with('status', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //dd($option);
        $option->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
