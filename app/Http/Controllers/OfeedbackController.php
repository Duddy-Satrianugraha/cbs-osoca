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

        $mhs = Opeserta::where('qrpeserta', $request->soal_slug)->first();
        if(!$mhs || $mhs->status == 0){
            return redirect(url('/feedback'))->with('msg', 'danger-Feedback peserta tidak di temukan');
        }
        $ujian = Oujian::find($mhs->oujian_id);
        $ofe = Ofeedback::where('qrpeserta', $request->soal_slug)->first();
        $feed = feedparser($ofe->feedback);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('oumpan.station', compact('ujian', 'ofe', 'feed'))
        ->setPaper('A4', 'portrait');
        return $pdf->stream('Feedback_'.$ofe->npm.'.pdf');
        //balikin pdf feedback peserta dengankop


    }
}
