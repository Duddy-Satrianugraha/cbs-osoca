<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //dd($request->all());
        $validatedData = $request->validate([
            'ujian_id' => 'required|numeric',
            'sesi_id' => 'required|numeric',
            'station' => 'required|array',

        ]);
        try{
            DB::beginTransaction();
       foreach($validatedData['station'] as $key => $value){
        if($value != 0){
           Station::find($key)->update(['template_id' => $value, 'istirahat' => null]);
        } else {
            Station::find($key)->update([ 'template_id' => null, 'istirahat' => true]);
        }
       }
       DB::commit();
       return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'success-tamplate berhasil  berhasil diinput');
       } catch (Exception $e) {
           DB::rollBack();
           return redirect()->route('admin.ujian.show', $validatedData['ujian_id'])->with('msg', 'danger-Data gagal disimpan '.$e->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        //
    }
}
