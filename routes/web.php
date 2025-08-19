<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Osce\OsceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileContoller;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\OpesertaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RotationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\TrmeController;
use App\Http\Controllers\OtemplateController;
use App\Http\Controllers\OujianController;
use App\Http\Middleware\Mahasiswa;
use App\Http\Middleware\Panitia;
use App\Http\Middleware\Penguji;
use App\Http\Middleware\Osce;
use App\Http\Middleware\Ps;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/html', function () {
    return view('osce.dashbord');
});

Route::get('/login/ps', [DashbordController::class, 'pslogin'])->name('ps.login');
Route::get('/register/ps', [DashbordController::class, 'psregister'])->name('ps.register');
Route::get('/login/penguji', [DashbordController::class, 'login'])->name('penguji.login');
Route::get('/register/penguji', [DashbordController::class, 'register'])->name('penguji.register');
Route::get('/login/osce', [DashbordController::class, 'osce'])->name('osce.login');
Route::post('/scan/osce', [DashbordController::class, 'scan'])->name('osce.scan');

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

    // Route::get('/templates/peserta/{template}', [TemplateController::class, 'peserta'])->name('templates.peserta');
    // Route::put('/templates/peserta/{template}', [TemplateController::class, 'peserta_update'])->name('templates.peserta.update');
    // Route::get('/templates/penguji/{template}', [TemplateController::class, 'penguji'])->name('templates.penguji');
    // Route::put('/templates/penguji/{template}', [TemplateController::class, 'penguji_update'])->name('templates.penguji.update');
    // Route::get('/templates/del_pp/{template}', [TemplateController::class, 'del_pp'])->name('templates.del_pp');
    // Route::get('/templates/pasien/{template}', [TemplateController::class, 'pasien'])->name('templates.pasien');
    // Route::put('/templates/pasien/{template}', [TemplateController::class, 'pasien_update'])->name('templates.pasien.update');


    Route::resource('/ujian', OujianController::class);
    Route::post('/sesi/store', [OujianController::class, 'sesi_store'])->name('sesi.store');
    Route::resource('/peserta', OpesertaController::class)->except(['create']);
    Route::get('/peserta/{uid}/baru',[OpesertaController::class, 'create'])->name('peserta.create');
    Route::get('/peserta/{uid}/upload',[OpesertaController::class, 'upload'])->name('peserta.upload');
    Route::post('/peserta/upload',[OpesertaController::class, 'store_upload'])->name('peserta.store_upload');
    Route::get('/kartu/peserta/{uid}', [PdfController::class, 'listpeserta'])->name('pdf.peserta');
    Route::get('/kartu/station/{uid}', [PdfController::class, 'station'])->name('pdf.station');
    //Route::get('/peserta',[OujianController::class, 'listujian'])->name('daftar.peserta');

    //Route::resource('/station', StationController::class);
    //Route::resource('/sesi', SesiController::class)->except(['index']);
    //Route::get('/sesi/index/{id}', [SesiController::class, 'index'])->name('sesi.index');
    Route::get('copy/sesi/{uid}',[SesiController::class, 'copy_sesi'])->name('sesi.copy');
    Route::post('copy/sesi/{uid}',[SesiController::class, 'copy'])->name('sesi.copy.store');
    //Route::resource('/peserta', PesertaController::class);
    Route::get('/rotasi', [RotationController::class, 'index'])->name('rotasi.index');
    Route::get('/act/ujian/{ujian}', [RotationController::class, 'open'])->name('act.ujian.open');
    Route::get('/deact/ujian/{ujian}', [RotationController::class, 'close'])->name('act.ujian.close');
    //Route::get('/peserta/{ujian}', [RotationController::class, 'show'])->name('peserta.rotasi')->middleware(['auth']);
    Route::get('/rotasi/{ujian}', [RotationController::class, 'show'])->name('rotasi.show');
    Route::get('/rotasi/{rotation}/edit', [RotationController::class, 'edit'])->name('rotasi.edit');
    Route::put('/rotasi/{rotation}', [RotationController::class, 'update'])->name('rotasi.update');
    Route::resource('lokasi', LocationController::class);
    Route::get('/kartu/station/{sesi}', [PdfController::class, 'station'])->name('pdf.station');
    //Route::get('/kartu/peserta/{rotasi}', [PdfController::class, 'peserta'])->name('pdf.peserta');
    Route::resource('pasien', PasienController::class);
    Route::get('/kartu/ps/{id}', [PdfController::class, 'one_ps'])->name('kartu.ps');
    Route::resource('rmd', TrmeController::class);

});

Route::prefix('mahasiswa')->middleware(['auth', Mahasiswa::class ])->name('mahasiswa.')->group( function (){
    Route::resource('/pendaftaran', PendaftaranController::class);
    Route::get('/nametag', [PdfController::class, 'mhs'])->name('nametag.cetak');
});


Route::prefix('penguji')->middleware(['auth', Penguji::class ])->name('penguji.')->group( function (){
    Route::get('/nametag', [PdfController::class, 'penguji'])->name('kartu.cetak');
});
Route::prefix('ps')->middleware(['auth', Ps::class ])->name('ps.')->group( function (){
    Route::get('/nametag', [PdfController::class, 'ps'])->name('kartu.cetak');
});

Route::prefix('osce')->middleware([Osce::class])->name('osce.')->group( function (){
    Route::get('/penguji', [OsceController::class, 'penguji'])->name('penguji.login');
    Route::post('/penguji', [OsceController::class, 'chek_penguji'])->name('penguji');
    Route::get('/penunjang', [OsceController::class, 'penunjang'])->name('penunjang');
    Route::get('/penunjang/status', [OsceController::class, 'penunjangStatus'])->name('show.penunjang');
    Route::get('/logout', [OsceController::class, 'logout'])->name('logout');
    Route::get('/ujian', [OsceController::class, 'ujian'])->name('ujian');
    Route::get('/ujian/rotasi/{id}', [OsceController::class, 'ujian_rotasi'])->name('ujian.rotasi');
    Route::get('/rotasi', [OsceController::class, 'rotasi'])->name('rotasi');
    Route::get('/template', [OsceController::class, 'template'])->name('template');
    Route::get('/',[OsceController::class, 'ujian'])->name('index');
    Route::post('/show/penunjang', [OsceController::class, 'showPenunjang'])->name('showing.penunjang');
    Route::post('/mhs', [OsceController::class, 'mhs'])->name('mhs');
    Route::post('/penilaian', [OsceController::class, 'penilaian'])->name('penilaian.store');
    Route::post('/pasien', [OsceController::class, 'pasien'])->name('pasien');
    Route::post('/tidak_hadir', [OsceController::class, 'tidak_hadir'])->name('tidak.hadir');
});

