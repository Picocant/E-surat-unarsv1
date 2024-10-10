<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index');
    }

    public function attempt(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => false,
            'role' => User::ROLE_BIRO2,
            'name' => $validated['name'],
        ]);

        UserRegistered::dispatch($user);

        return to_route('login.index')->with('swal.success', 'Registrasi berhasil, silahkan tunggu admin memverifikasi akun anda.');
    }
}
