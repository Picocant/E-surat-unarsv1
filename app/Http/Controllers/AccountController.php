<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    protected $roles = User::ROLES;

    public function index()
    {
        $user = User::find(auth()->id());

        return view('account.index', [
            'user' => $user,
            'roles' => $this->roles,
            'positions' => Position::all(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:40'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'nip' => ['nullable', 'max:50', 'regex:/[0-9]{8} [0-9]{6} [0-9]{1} [0-9]{3}/'],
            'date_of_bird' => ['required', 'date'],
            'address' => ['required', 'max:200'],
        ]);

        $user = User::find(auth()->id());
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->nip = $data['nip'];
        $user->date_of_bird = $data['date_of_bird'];
        $user->address = $data['address'];

        if (can('change-account-position')) {
            $request->validate(['position_id' => 'required', 'uuid']);
            $user->position_id = $request->input('position_id');
        }

        $user->save();
        Activity::dispatch('memperbarui profil akun');
        return back()->with('swal.success', 'Akun berhasil diperbarui');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:5'],
        ]);

        $user = User::find(auth()->id());

        if (!Hash::check($data['old_password'], $user->password)) {
            return back()->with('swal.error', 'Kata sandi salah');
        }

        $user->password = Hash::make($data['password']);
        $user->save();
        Event::dispatch(new PasswordReset($user));
        Activity::dispatch('memperbarui kata sandi akun');
        return back()->with('swal.success', 'Kata sandi berhasil diperbarui');
    }

    public function changeRole(Request $request)
    {
        gate('change-account-role');

        $data = $request->validate([
            'role' => ['required', Rule::in($this->roles)]
        ]);

        $user = User::find(auth()->id());
        $user->role = $data['role'];
        $user->save();
        Activity::dispatch('memperbarui hak akses akun');
        return back()->with('swal.success', 'Role berhasil diperbarui');
    }

    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1024']
        ]);

        $avatar = $request->file('avatar')->storePublicly('avatars');

        $user = User::find(auth()->id());
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->avatar = $avatar;
        $user->save();
        Activity::dispatch('memperbarui foto profil');
        return back()->with('swal.success', 'Gambar berhasil diperbarui');
    }

    public function deleteAvatar()
    {
        $user = User::find(auth()->id());
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->avatar = null;
        $user->save();
        Activity::dispatch('menghapus foto profil');
        return back()->with('swal.success', 'Gambar berhasil dihapus');
    }
}
