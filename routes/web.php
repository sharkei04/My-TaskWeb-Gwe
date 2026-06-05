<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Models\User;

    Route::get('/', function () {
        return redirect()->route('login.form');
    });

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login.form');

    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/lupapassword', function () {
        return view('auth.lupapassword');
    })->name('lupapassword');

    Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])->name('password.send');

    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/tasks', function () {
        return 'Halaman My Tasks nanti diisi daftar task.';
    })->name('tasks.index');

    Route::get('/tasks/create', function () {
        return 'Halaman tambah task. Status: ' . request('status');
    })->name('tasks.create');

    Route::get('/members', function () {
        $members = User::latest()->get();

        return view('members.member', compact('members'));
    })->name('members.index');

    Route::get('/admin', function () {
        return 'Halaman Admin nanti diisi pengaturan admin.';
    })->name('admin.index');

    Route::get('/boards/create', function () {
        return 'Halaman tambah board.';
    })->name('boards.create');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');