<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\UserDeleted;
use App\Events\UserManuallyCreated;
use App\Models\Position;
use App\Models\User;
use App\Notifications\PasswordResetedNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        gate('read-user');

        $users = User::with(['position'])->orderBy('created_at', 'DESC')->get();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function show(User $user)
    {
        gate('read-user');
        if ($user->id == auth()->id()) {
            return to_route('account.index');
        }

        return view('user.show', [
            'user' => $user,
            'positions' => Position::all(),
        ]);
    }

    public function create()
    {
        gate('create-user');

        return view('user.create', [
            'positions' => Position::all(),
            'roles' => User::ROLES,
            'genders' => User::GENDERS,
        ]);
    }

    public function store(Request $request)
    {
        gate('create-user');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
            'nip' => ['nullable', 'max:50', 'regex:/[0-9]{8} [0-9]{6} [0-9]{1} [0-9]{3}/'],
            'date_of_bird' => ['required', 'date'],
            'address' => ['required', 'max:200'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', Rule::in(User::ROLES)],
            'gender' => ['required', Rule::in(User::GENDERS)],
            'position_id' => ['required', 'uuid'],
        ]);

        $randomPassword = Str::random();

        $user = User::create([
            'name' => $data['name'],
            'nip' => $data['nip'],
            'date_of_bird' => $data['date_of_bird'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'email' => $data['email'],
            'role' => $data['role'],
            'position_id' => $data['position_id'],
            'is_active' => true,
            'password' => Hash::make($randomPassword),
        ]);

        UserManuallyCreated::dispatch($user, $randomPassword);

        Activity::dispatch('membuat data pengguna');

        return to_route('user.index')->with('swal.success', 'Data pengguna berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        gate('update-user');

        if ($user->id == auth()->id()) {
            return to_route('account.index');
        }

        return view('user.edit', [
            'user' => $user,
            'positions' => Position::all(),
            'roles' => User::ROLES,
            'genders' => User::GENDERS,
        ]);
    }

    public function update(Request $request, User $user)
    {
        gate('update-user');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
            'nip' => ['nullable', 'max:50', 'regex:/[0-9]{8} [0-9]{6} [0-9]{1} [0-9]{3}/'],
            'date_of_bird' => ['required', 'date'],
            'address' => ['required', 'max:200'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(User::ROLES)],
            'gender' => ['required', Rule::in(User::GENDERS)],
            'position_id' => ['required', 'uuid'],
            'is_active' => ['required'],
        ]);

        $isActive = false;
        if ($data['is_active'] == 1) {
            $isActive = true;
        }

        $user->name = $data['name'];
        $user->nip = $data['nip'];
        $user->date_of_bird = $data['date_of_bird'];
        $user->gender = $data['gender'];
        $user->address = $data['address'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->position_id = $data['position_id'];
        $user->is_active = $isActive;
        $user->save();

        Activity::dispatch('memperbarui data pengguna');

        return to_route('user.show', ['user' => $user])->with('swal.success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        gate('delete-user');

        if ($user->id == auth()->id()) {
            return back()->with('swal.warning', 'Tidak dapat menghapus, akun ini sedang anda gunakan untuk login');
        }

        // Delete unwanted files and data
        $user->delete();
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->leave_permit_letters()->delete();
        $user->given_sppd_letters()->delete();
        $user->received_sppd_letters()->delete();
        foreach ($user->school_documents as $document) {
            $document->user_id = null;
            $document->save();
        }

        // trigger event
        UserDeleted::dispatch($user);

        Activity::dispatch('menghapus data pengguna');

        return to_route('user.index')->with('swal.success', 'Akun ' . $user->name . ' telah dihapus dari sistem');
    }

    public function changeAvatar(Request $request, User $user)
    {
        gate('update-user');

        $request->validate([
            'avatar' => ['required', 'image', 'max:1024']
        ]);

        $avatar = $request->file('avatar')->storePublicly('avatars');

        if ($user->avatar != null) {
            Storage::delete($user->avatar);
        }
        $user->avatar = $avatar;
        $user->save();

        Activity::dispatch('memperbarui foto profil pengguna');

        return back()->with('swal.success', 'Gambar berhasil diperbarui');
    }

    public function resetPassword(User $user)
    {
        gate('update-user');

        $randomPassword = Str::random();
        $user->password = Hash::make($randomPassword);
        $user->save();

        $user->notify(new PasswordResetedNotice($randomPassword));

        Activity::dispatch('mengatur ulang kata sandi pengguna');

        return back()->with('swal.success', 'Kata sandi baru telah dikirmkan ke email pengguna');
    }
}
