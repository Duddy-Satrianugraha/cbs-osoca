<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;


class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           // dd(session()->get('power'));
        return view('start');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }Public function pslogin(){
        return view('ps.auth.login');
    }

    Public function psregister(){
        return view('ps.auth.register');
    }

    Public function login(){
        return view('penguji.auth.login');
    }

    Public function register(){
        return view('penguji.auth.register');
    }

    public function osce(){
        return view('osce.auth.login');
    }
    public function scan(Request $request){
        //dd($request);
        $request->validate([
            'soal_slug' => 'required',
            'captcha' => [
            'required','numeric',
            function ($attribute, $value, $fail) {
                if (!verify_captcha($value)) {
                    $fail('Jawaban CAPTCHA salah Boss');
                }
            },
        ],
        ]);
        $soal_slug = $request->soal_slug;
        $soal = Soal::where('slug', $soal_slug)->first();
        if($soal){
            session([
                'Osce' => $soal->id,
                'ujian_id' => $soal->ujian_id ?? null,
                'sesi_id' => $soal->sesi_id ?? null,
                'lokasi_id' => $soal->location_id ?? null,
                'station_id' => $soal->station_id ?? null,
            ]);
            return redirect(route('osce.penguji.login'))->with('success', 'Station ditemukan silahkan scan kartu Penguji');
        } else {
            return redirect(route('osce.login'))->with('msg', 'danger-Unable to find code');
        }
    }
}
