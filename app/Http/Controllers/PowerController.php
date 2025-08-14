<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PowerController extends Controller
{
    public function index($id)
    {
        if (Auth::check()) {
            // Simpan ID admin sebelum impersonate
            if (!session()->has('original_user')) {
                session(['original_user' => Auth::id()]);
            }

            // Simpan ID user yang akan di-impersonate
            session(['power' => $id]);
            if (!Auth::check() || Auth::id() !== $id) {
                Auth::loginUsingId($id);
            }

        return redirect('/dashbord');
            }
            return redirect('/login')->with('error', 'Unauthorized');
    }

    public function destroy()
    {
        if (session()->has('original_user')) {
            $originalUserId = session('original_user');
            session()->forget(['power', 'original_user']); // Hapus sesi impersonasi

            // Autentikasi kembali ke user asli
            Auth::loginUsingId($originalUserId);

            return redirect(route('admin.users.index'));
        }

        return redirect('/dashboard')->with('error', 'No impersonation session found.');
   }
}
