<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Ostation;
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
    }

    Public function login(){
        return view('penguji.auth.login');
    }

    Public function register(){
        return view('penguji.auth.register');
    }

    
    public function osoca(){
        if(session()->has('Osoca')){
            return redirect(route('osoca.mhs.login'))->with('msg', 'danger-Selamat datang kembali dok,Silahkan scan kartu peserta');
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
            'name' => 'required',
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
            if(is_null($soal->nama_penguji)) {
            $soal->nama_penguji = $request->name;
            $soal->save();
            }
            session([
                'Osoca' => $soal->oujian_id,
                'Station' => $soal->urutan ?? null,
                'current' => $soal->current ?? null,
                'next' => $soal->next ?? null,
            ]);
            return redirect(route('osoca.mhs.login'))->with('success', 'Station ditemukan silahkan scan kartu Penguji');
        } else {
            return redirect(route('osoca.login'))->with('msg', 'danger-Unable to find code');
        }
    }
}
