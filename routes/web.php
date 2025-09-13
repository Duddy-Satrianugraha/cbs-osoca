<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\OsocaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileContoller;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OpesertaController;
use App\Http\Controllers\OpengujiController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PesertaController;

use App\Http\Controllers\OtemplateController;
use App\Http\Controllers\OujianController;
use App\Http\Middleware\Peserta;
use App\Http\Middleware\Panitia;

use App\Http\Controllers\OfeedbackController;

use App\Http\Middleware\Osoca;



Route::get('/feedback', function () {
    return view('oumpan.login');
});
Route::get('/', function () {
    return view('auth.login');
});

Route::post('/feedback', [OfeedbackController::class, 'chek_feed'])->name('feedback.chek');


Route::get('/login/penguji', [DashbordController::class, 'login'])->name('penguji.login');
Route::get('/register/penguji', [DashbordController::class, 'register'])->name('penguji.register');

Route::get('/login/osoca', [DashbordController::class, 'osoca'])->name('osoca.login');
Route::post('/scan/osoca', [DashbordController::class, 'oscan'])->name('osoca.scan');
Route::get('/login/peserta', [DashbordController::class, 'peserta'])->name('peserta.login');
Route::post('/scan/peserta', [DashbordController::class, 'pscan'])->name('peserta.scan');

Route::get('/dashbord', [DashbordController::class, 'index'])->middleware(['auth', ])->name('dashbord');
Route::get('/admin/power/destroy',[PowerController::class, 'destroy'])->name('admin.powerdown');
Route::post('/profile/photo', [ProfileContoller::class, "updatePhoto"])->middleware('auth')->name('profile.photo.update');
Route::resource('/profile', ProfileContoller::class)->middleware(['auth', ]);

Route::prefix('admin')->middleware(['auth', Panitia::class ])->name('admin.')->group( function (){
    Route::resource('/users', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::get('/power/{id}', [PowerController::class, 'index'])->name('powerup');
    Route::resource('/options', OptionController::class);

    Route::resource('/templates', OtemplateController::class);
    Route::get('/templates/soal/{id}', [OtemplateController::class, 'soal'])->name('templates.soal');
    Route::put('/templates/soal/{id}', [OtemplateController::class, 'soal_update'])->name('templates.soal.update');
    Route::get('/templates/mininote/{id}', [OtemplateController::class, 'mininote'])->name('templates.mininotes');
    Route::put('/templates/mininote/{id}', [OtemplateController::class, 'mininote_update'])->name('templates.mininotes.update');
    Route::get('/templates/rubrik/{id}', [OtemplateController::class, 'rubrik'])->name('templates.rubrik');
    Route::put('/templates/rubrik/{id}', [OtemplateController::class, 'rubrik_update'])->name('templates.rubrik.update');
    Route::get('/copy/templates', [OtemplateController::class, 'copy_template'])->name('templates.copy');
    Route::post('/copy/templates', [OtemplateController::class, 'copy'])->name('templates.copy.store');
    Route::resource('/ujian', OujianController::class);
    Route::post('/sesi/store', [OujianController::class, 'sesi_store'])->name('sesi.store');
    Route::resource('/peserta', OpesertaController::class)->except(['create']);
    Route::get('/peserta/{uid}/avatar',[OpesertaController::class, 'avatar_update'])->name('peserta.avatar.update');
    Route::get('/peserta/{uid}/baru',[OpesertaController::class, 'create'])->name('peserta.create');
    Route::get('/peserta/{uid}/upload',[OpesertaController::class, 'upload'])->name('peserta.upload');
    Route::post('/peserta/upload',[OpesertaController::class, 'store_upload'])->name('peserta.store_upload');
    Route::get('/kartu/peserta/{uid}', [PdfController::class, 'listpeserta'])->name('pdf.peserta');
    Route::get('/kartu/station/{uid}', [PdfController::class, 'station'])->name('pdf.station');
    Route::resource('/nilai', NilaiController::class);
    Route::get('/export/nilai/{uid}', [NilaiController::class, 'export'])->name('export.nilai');
    Route::get('/export/feedback/{uid}', [OfeedbackController::class, 'kirim_feedback'])->name('kirim.feedback');
    Route::resource('/penguji', OpengujiController::class);
    Route::post('/print/penguji', [OpengujiController::class, 'print'])->name('penguji.print');
    Route::post('/massdelete/penguji', [OpengujiController::class, 'massDelete'])->name('penguji.massdelete');
});

Route::prefix('peserta')->middleware(Peserta::class)->name('peserta.')->group( function (){
    Route::get('/', [PesertaController::class, 'check'])->name('index');
    Route::get('/soal', [PesertaController::class, 'soal'])->name('soal');
    Route::get('/tolist', [PesertaController::class, 'tolist'])->name('tolist');
    Route::get('/logout', [PesertaController::class, 'logout'])->name('logout');
    Route::post('/scan_soal', [PesertaController::class, 'scan'])->name('sscan');
});

Route::prefix('osoca')->middleware([Osoca::class])->name('osoca.')->group( function (){
    Route::get('/logout', [OsocaController::class, 'logout'])->name('logout');
    Route::get('/tolist', [OsocaController::class, 'tolist'])->name('tolist');
    Route::get('/penguji', [OsocaController::class, 'penguji'])->name('penguji.login');
    Route::post('/penguji', [OsocaController::class, 'penguji_check'])->name('penguji.chek');
    Route::get('/mhs', [OsocaController::class, 'mhs'])->name('mhs.login');
    Route::post('/mhs', [OsocaController::class, 'mhs_check'])->name('mhs.chek');
    Route::get('/ujian', [OsocaController::class, 'ujian'])->name('ujian');
    Route::get('/template', [OsocaController::class, 'template'])->name('template');
    Route::post('/penilaian', [OsocaController::class, 'penilaian'])->name('penilaian.store');
});

