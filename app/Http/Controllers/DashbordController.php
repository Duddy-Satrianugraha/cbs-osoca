<?php

namespace App\Http\Controllers;

use App\Models\Opeserta;
use App\Models\Osesi;
use Illuminate\Http\Request;
use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Openguji;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;


class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $ujian = Oujian::all();
           $sesi = Osesi::all();
           $station = Ostation::all();
           $peserta = Opeserta::all();
           $penguji = Openguji::all();
           //$penguji = Ostation::whereNotNull('nama_penguji')->get();
        return view('start', compact('ujian', 'sesi', 'station', 'peserta','penguji'));
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
    }

    public function login_peserta(Request $request){

    }

    public function peserta(){
        return view('peserta.login');
    }

    public function pscan(Request $request){

       $request->validate([
            'soal_slug' => ['required','numeric'],
            'captcha' => [
            'required','numeric',
            function ($attribute, $value, $fail) {
                if (!verify_captcha($value)) {
                    $fail('Jawaban CAPTCHA salah dok');
                }
            },
        ],
        ]);
        $soal_slug = $request->soal_slug;
        $soal = Ostation::where('qrstation', $soal_slug)->first();
        if($soal){
            session([
                'oujian' => $soal->oujian_id,
                'Station' => $soal->id ?? null,
                'current' => $soal->current ?? null,
            ]);
            return redirect(route('peserta.index'))->with('success', 'Station ditemukan silahkan scan kartu Peserta');
        } else {
            return redirect(route('peserta.login'))->with('msg', 'danger-Unable to find code');
        }

    }

    Public function login(){
        return view('penguji.auth.login');
    }

    Public function register(){
        return view('penguji.auth.register');
    }


    public function osoca(){
        if(session()->has('Osoca')){
            return redirect(route('osoca.penguji.login'))->with('msg', 'success-Selamat datang kembali dok,Silahkan scan kartu penguji');
        }
        if (session()->has('Penguji')) {
            return redirect(route('osoca.mhs.login'))->with('msg', 'success-Selamat datang kembali dok, Selamat menguji peserta');
        }
         if (session()->has('Peserta')) {
                return redirect(route('osoca.ujian'))->with('msg', 'success-Selamat datang kembali dok, Selamat menguji peserta');
            }

        return view('osoca.login');
    }

    public function oscan(Request $request){
        //dd($request);
        $request->validate([
            'soal_slug' => ['required','numeric'],
            'captcha' => [
            'required','numeric',
            function ($attribute, $value, $fail) {
                if (!verify_captcha($value)) {
                    $fail('Jawaban CAPTCHA salah dok');
                }
            },
        ],
        ]);
        $soal_slug = $request->soal_slug;
        $soal = Ostation::where('qrstation', $soal_slug)->first();
        if($soal){
            session([
                'Osoca' => $soal->oujian_id,
                'Station' => $soal->urutan ?? null,
                'current' => $soal->current ?? null,
                'next' => $soal->next ?? null,
            ]);
            return redirect(route('osoca.penguji.login'))->with('msg', 'success-Selamat datang dok,Silahkan scan kartu penguji');
        } else {
            return redirect(route('osoca.login'))->with('msg', 'danger-Unable to find code');
        }
    }
}
