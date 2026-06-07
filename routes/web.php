<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController; 
use App\Models\User;
use App\Models\Member;

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
        $tasks = \App\Models\Task::with(['labels', 'assignedTo'])
                    ->where('user_id', auth()->id())
                    ->get()
                    ->groupBy('status');
        return view('dashboard.dashboard', compact('tasks'));
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('tasks', TaskController::class);

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');

    Route::post('/members/invite', [MemberController::class, 'invite'])->name('members.invite');

    Route::get('/admin', function () {
        return 'Halaman Admin nanti diisi pengaturan admin.';
    })->name('admin.index');

    Route::get('/boards/create', function () {
        return 'Halaman tambah board.';
    })->name('boards.create');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');