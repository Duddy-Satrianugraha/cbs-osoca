<?php

namespace App\Http\Controllers;

use App\Models\Oujian;
use App\Models\Ostation;
use App\Models\Otemplate;
use App\Models\Osesi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OujianController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
     public function index(Request $request)
    {
        $search = $request->query('search');

        // Ambil 1 team pertama milik user (atau null)
        $team = Auth::user()?->teams()->first();

        // Ambil daftar user id dalam team tsb (Collection kosong jika null)
        $userIds = $team?->users()->pluck('users.id') ?? collect();

        $ujian = Oujian::query()
            ->when($search, function ($q, $s) {
                return $q->where('name', 'like', "%{$s}%");
            })
            ->when($userIds->isNotEmpty(), function ($q) use ($userIds) {
                return $q->whereIn('user_id', $userIds);
            })
            ->paginate(10);

        return view('admin.oujian.list', compact('ujian', 'search'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.oujian.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'tgl_ujian' => 'required|date',
            'jml_station' => 'required|integer',
            'jml_sesi' => 'required|integer',
        ]);
        try{
            DB::beginTransaction();
        $oujian = Oujian:: create([
            'name' => $validated['name'],
            'ta' => $validated['tahun_akademik'],
            'tgl_ujian' => $validated['tgl_ujian'],
            'jml_station' => $validated['jml_station'],
            'jml_sesi' => $validated['jml_sesi'],
            'user_id' => Auth::user()->id,
        ]);
         for ($x = 1; $x <= $validated['jml_station']; $x++) {
                $oustation = Ostation::create([
                    'oujian_id' => $oujian->id,
                    'urutan' => $x,
                    'name' => 'station '.$x,
                    'qrstation' => numran(10).$oujian->id.$x,
                    'penguji_id' => null,
                ]);
                }
        for ($x = 1; $x <= $validated['jml_sesi']; $x++) {
            $osesi = Osesi::create([
                'oujian_id' => $oujian->id,
                'urutan' => $x,
                'otemplate_id' => null,
            ]);
        }
        DB::commit();   
        return redirect(route('admin.ujian.index'))->with('msg', 'success-Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect(route('admin.ujian.index'))->with('msg', 'danger-Data gagal disimpan'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil 1 team pertama milik user (atau null)
        $team = Auth::user()?->teams()->first();

        // Ambil daftar user id dalam team tsb (Collection kosong jika null)
        $userIds = $team?->users()->pluck('users.id') ?? collect();

        $otemplate = Otemplate::query()
        ->when($userIds->isNotEmpty(), function ($q) use ($userIds) {
                return $q->whereIn('user_id', $userIds);
            })->get();
        
        $osesi = Osesi::where('oujian_id', $id)->get();
        $oujian = Oujian::find($id);
        return view('admin.oujian.slist', compact('osesi', 'otemplate', 'oujian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $ujian = Oujian::find($id);
        return view('admin.oujian.edit', compact('ujian'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updatex(Request $request, $id)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'tgl_ujian' => 'required|date',
            'jml_station' => 'required|integer',
            'jml_sesi' => 'required|integer',
        ]);
        $oujian = Oujian::find($id);
        $oujian->update([
            'name' => $validated['name'],
            'ta' => $validated['tahun_akademik'],
            'tgl_ujian' => $validated['tgl_ujian'],
            'jml_station' => $validated['jml_station'],
            'jml_sesi' => $validated['jml_sesi'],
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()->with('msg', 'success-Data berhasil disimpan');
    }

    public function update(Request $request, $id) // pakai route model binding
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'tgl_ujian'      => 'required|date',
            'jml_station'    => 'required|integer',
            'jml_sesi'       => 'required|integer',
        ]);
        $oujian = Oujian::find($id);
        try {
            DB::beginTransaction();

            // 1) Update field utama Oujian
            $oujian->update([
                'name'        => $validated['name'],
                'ta'          => $validated['tahun_akademik'],
                'tgl_ujian'   => $validated['tgl_ujian'],
                'jml_station' => $validated['jml_station'],
                'jml_sesi'    => $validated['jml_sesi'],
                'user_id'     => Auth::user()->id,
            ]);

            /**
             * 2) Sinkron jumlah Ostation (station)
             *    - Kurangi: hapus urutan paling akhir (urutan > target)
             *    - Tambah : buat baru mulai dari urutan paling akhir
             */
            $targetStations = (int) $validated['jml_station'];

            // hitung kondisi sekarang
            $currentStationCount = Ostation::where('oujian_id', $oujian->id)->count();
            $currentStationMax   = (int) (Ostation::where('oujian_id', $oujian->id)->max('urutan') ?? 0);

            if ($currentStationCount > $targetStations) {
                // hapus ekor: semua dengan urutan > target
                Ostation::where('oujian_id', $oujian->id)
                    ->where('urutan', '>', $targetStations)
                    ->delete();
            } elseif ($currentStationCount < $targetStations) {
                // tambah dari urutan paling akhir
                $toAdd = $targetStations - $currentStationCount;
                for ($i = 1; $i <= $toAdd; $i++) {
                    $urutanBaru = $currentStationMax + $i;
                    Ostation::create([
                        'oujian_id'  => $oujian->id,
                        'urutan'     => $urutanBaru,
                        'name'       => 'station ' . $urutanBaru,
                        'qrstation'  => numran(10) . $oujian->id . $urutanBaru,
                        'penguji_id' => null,
                    ]);
                }
            }

            /**
             * 3) Sinkron jumlah Osesi (sesi)
             *    - Kurangi: hapus urutan paling akhir (urutan > target)
             *    - Tambah : buat baru mulai dari urutan paling akhir
             */
            $targetSesi = (int) $validated['jml_sesi'];

            $currentSesiCount = Osesi::where('oujian_id', $oujian->id)->count();
            $currentSesiMax   = (int) (Osesi::where('oujian_id', $oujian->id)->max('urutan') ?? 0);

            if ($currentSesiCount > $targetSesi) {
                Osesi::where('oujian_id', $oujian->id)
                    ->where('urutan', '>', $targetSesi)
                    ->delete();
            } elseif ($currentSesiCount < $targetSesi) {
                $toAdd = $targetSesi - $currentSesiCount;
                for ($i = 1; $i <= $toAdd; $i++) {
                    $urutanBaru = $currentSesiMax + $i;
                    Osesi::create([
                        'oujian_id'     => $oujian->id,
                        'urutan'        => $urutanBaru,
                        'otemplate_id'  => null,
                    ]);
                }
            }

            DB::commit();
            return redirect(route('admin.ujian.index'))
                ->with('msg', 'success-Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('admin.ujian.index'))
                ->with('msg', 'danger-Data gagal diperbarui: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oujian $oujian)
    {
        
    }

    public function sesi_store(Request $request){
        $request->validate([
            'ujian_id' => 'required|integer',
            'sesi' => 'required|array',
        ]); 
        try{
            DB::beginTransaction();
        
        $oujian = Oujian::find($request->ujian_id);
        foreach($request->sesi as $key => $value){
            $osesi = Osesi::find($key)->update([
                'otemplate_id' => $value,
            ]);
        }
        DB::commit();
        return redirect()->back()->with('msg', 'success-Sesi berhasil disimpan');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'danger-Sesi gagal disimpan '.$e->getMessage());
        }
    }

    
}
