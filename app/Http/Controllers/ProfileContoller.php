<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\DataDiri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ProfileContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sex = Option::where('type', 'sex')->get();
       return view('profil.main', compact('sex'));

    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'avatar' => ['required', File::image()->max(2048)], // Maksimum 2MB
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        // Ambil file yang diupload
        $file = $request->file('avatar');

        // Resize gambar dengan lebar 150px, rasio tetap
        $manager = new ImageManager(new GdDriver());
        $image = $manager->read($file);
        $image->scaleDown(width: 200);

        $filename = uniqid('avatar_') . '.' . $file->getClientOriginalExtension();
        $path = 'avatar/' . $filename;

        // Simpan gambar hasil resize ke storage/public/avatar
        Storage::disk('public')->put( $path, (string) $image->toJpeg());

        $user->update(['avatar' => $path]);
 

        return back()->with('msg', 'success-Foto updated');
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
        $request->validate([
            'sex' => 'string',
            'phone' => 'string|max:20',
        ]);

        $user = Auth::user();

        // create or update dengan 1 baris
        DataDiri::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'sex' => $request->sex_id,
            ]
        );

        return redirect()->back()->with('success', 'Data diri berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
