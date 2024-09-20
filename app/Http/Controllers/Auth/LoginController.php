<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }

    public function attempt(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('swal.error', 'Email atau password salah')->onlyInput('email');
        }

        if (!$user->isActive()) {
            return back()->with('swal.error', 'Akun anda belum diverifikasi oleh administrator')->onlyInput('email');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->with('swal.error', 'Email atau password salah')->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended(route('home.index'))->with('swal.success', 'Anda berhasil login');
    }
}
