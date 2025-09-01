<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ofeedback;

class OfeedbackController extends Controller
{
    public function chek_feed(Request $request){
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
        dd($request->all());

        $mhs = Opeserta::where('soal_slug', $request->soal_slug)->first();
        if(!$mhs->status){
            return redirect(route('oumpan.login'))->with('msg', 'danger-Feedback peserta tidak di temukan');
        }
        $ujian = Oujian::find($mhs->oujian_id);
        $ofeefback = Ofeedback::where('qrpeserta', $request->soal_slug)->first();

        //balikin pdf feedback peserta dengankop
        

    }
}
