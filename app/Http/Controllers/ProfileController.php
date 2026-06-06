<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        if (! Auth::check()) {
            return redirect()
                ->route('login.form')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        if (! Auth::check()) {
            return redirect()
                ->route('login.form')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        $user = Auth::user();

        $validated = $request->validate([
            'username' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'nickname' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $validated['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}