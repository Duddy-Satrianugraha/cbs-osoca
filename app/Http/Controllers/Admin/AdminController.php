<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereHas('roles', function ($query) {
            $query->whereNot('u_id', 99);
        })->paginate(5);
        return  view('admin.user.list', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $team = Team::all();
        $roles = Role::whereNot( 'u_id', 99 )->get();
        return view('admin.user.new', compact('roles', 'team'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'teams' => ['required', 'string'],

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
        $user->teams()->attach($validated['teams']);
        return redirect()->back()->with('msg', 'success-User created');
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
    public function edit(User  $user)
    {
         $team = Team::all();
        $roles = Role::whereNot( 'u_id', 99 )->get();
        return view('admin.user.edit', compact('user', 'roles', 'team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            'roles' => ['required', 'array'],
            'teams' => ['required', 'string'],
        ]);
    try{
            DB::beginTransaction();
        $user->roles()->sync($validated['roles']);
        $user->teams()->sync($validated['teams']);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }
        $user->delete();
        return redirect()->back()->with('msg', 'success-User deleted');
    }
}
