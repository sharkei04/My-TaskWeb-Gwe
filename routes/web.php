<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
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
        $status = request('status');
        $search = request('q');
        $validStatuses = ['todo', 'in_progress', 'done'];

        $tasksQuery = \App\Models\Task::with(['labels', 'assignedTo'])
            ->where('user_id', auth()->id())
            ->when(in_array($status, $validStatuses), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                $query->where(fn ($query) =>
                    $query->where('title', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%")
                );
            });

        $tasks = $tasksQuery->get()->groupBy('status');

        $deadlineNotifications = \App\Models\Task::where('user_id', auth()->id())
            ->whereIn('status', ['todo', 'in_progress'])
            ->whereNotNull('deadline')
            ->whereDate('deadline', '<=', Carbon::today()->addDays(2))
            ->orderBy('deadline')
            ->get()
            ->map(function ($task) {
                $days = Carbon::today()->diffInDays($task->deadline, false);

                return [
                    'task' => $task,
                    'label' => $days < 0
                        ? 'Overdue'
                        : ($days === 0 ? 'Due today' : "Due in {$days} day" . ($days > 1 ? 's' : '')),
                    'is_overdue' => $days < 0,
                ];
            });

        return view('dashboard.dashboard', compact('tasks', 'deadlineNotifications'));
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status.update');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');

    Route::post('/members/invite', [MemberController::class, 'invite'])->name('members.invite');

    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::delete('/members/{member}/leave', [MemberController::class, 'leave'])->name('members.leave');

    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/exportdata', function () {
        return view('admin.exportdata');
    })->name('exportdata');

    Route::get('/boards/create', function () {
        return 'Halaman tambah board.';
    })->name('boards.create');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');