<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opeserta;
use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Ofeedback;
use Illuminate\Support\Facades\Http;

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

    public function kirim_feedbackx ($uid){
        $ofe = Ofeedback::where('oujian_id', $uid)->get();

        $ujian = Oujian::find($uid);
        $paket =[];
        //dd($ofe);
        foreach ($ofe as $data){
            $station = Ostation::find($data->station_id);
            $paket[] = [
                'ujian_name' => $ujian->name.' - '.$ujian->ta,
                'jenis' => "osoca",
                'tanggal' => $ujian->tgl_ujian,
                'nama' => $data->nama,
                'npm' => $data->npm,
                'station' => $station->name,
                'feedback' => $data->feedback,
            ];
        }
        //dd($paket);
        if ($paket === []) {
                return back()->with([
                    'msg' => "warning-Tidak ada feedback untuk dikirim."
                ]);
            }

         $apiUrl = config('services.feedback_api.url').'feedbacks';
         $response = Http::withToken(config('services.feedback_api.token'))
            ->post($apiUrl, [
                'feedbacks' => $paket,
            ]);

        if ($response->successful()) {
            return back()->with([
                    'msg' => "success-feedback berhasil dikirim Total: ".count($paket)." item"
                ]);
            } else {
            return back()->with([
                'msg' => "danger-Gagal mengirim feedback".$response->body()
            ]);
        }
    }

    public function kirim_feedback($uid)
    {
        // Ambil ujian + semua feedback beserta relasi station
        $ujian = Oujian::findOrFail($uid);

        $ofe = Ofeedback::with('station')
                ->where('oujian_id', $uid)
                ->where('is_sent', false)
                ->get();

        if ($ofe->isEmpty()) {
            return back()->with([
                'msg' => "warning-Tidak ada feedback untuk dikirim."
            ]);
        }

        $paket = $ofe->map(function ($data) use ($ujian) {
            return [
                'ujian_name' => $ujian->name.' - '.$ujian->ta,
                'jenis'      => "OSOCA",
                'tanggal'    => $ujian->tgl_ujian,
                'nama'       => $data->nama,
                'npm'        => $data->npm,
                'station'    => optional($data->station)->name, // aman walau null
                'feedback'   => $data->feedback,
            ];
        })->toArray();

        // Kirim ke API eksternal
        $apiUrl = config('services.feedback_api.url').'feedbacks';
        $response = Http::withToken(config('services.feedback_api.token'))
            ->post($apiUrl, [
                'feedbacks' => $paket,
            ]);

        if ($response->successful()) {
            Ofeedback::where('oujian_id', $uid)
            ->where('is_sent', false)
            ->update(['is_sent' => true]);
            return back()->with([
                'msg' => "success-feedback berhasil dikirim. Total: ".count($paket)." item."
            ]);
        } else {
            return back()->with([
                'msg' => "danger-Gagal mengirim feedback: ".$response->body()
            ]);
        }
    }

}
