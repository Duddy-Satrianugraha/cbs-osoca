<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class PasienController extends Controller
{
    public function index()
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('u_id', 6);
        })->paginate(5);
        
        return view('admin.pasien.list', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where( 'u_id', 6 )->get();
        return view('admin.pasien.new', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class),
            ],
            'roles' => ['required', 'array'],

            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        $slug = md5($validated['username']);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'slug' => $slug,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        $user->roles()->attach($validated['roles']);
        return redirect()->back()->with('msg', 'success-User created');
    }

    public function edit($id)
    {
        $pasien = User::find($id);
        $roles = Role::where( 'u_id', 6 )->get();
        return view('admin.pasien.edit', compact('pasien', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($id),
            ],

            'roles' => ['required', 'array'],
        ]);
    try{
            DB::beginTransaction();
            $user = User::find($id);
        $user->roles()->sync($validated['roles']);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        DB::commit();
        return redirect()->back()->with('msg', 'success-User updated');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('msg', 'danger-User gagal diupdate '.$e->getMessage());
        }
    }
    public function destroy($id)
    {   $user = User::find($id);
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }
        $user->delete();
        return redirect()->back()->with('msg', 'success-User deleted');
    }
}
