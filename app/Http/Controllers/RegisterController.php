<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'telepon'               => 'required|string|max:20',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'agree'                 => 'accepted',
        ], [
            'nama.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'telepon.required'   => 'No. handphone wajib diisi.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'agree.accepted'     => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'telepon'  => $request->telepon,
            'password' => Hash::make($request->password),
        ]);

        //redirect ke halaman login
        return redirect()->route('login.form')->with('success', 'Akun berhasil dibuat. Silakan login.');

    }
}
