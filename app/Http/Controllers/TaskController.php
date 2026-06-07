<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('assignedTo', 'labels')->latest()->get()->groupBy('status');
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        $labels = \App\Models\Label::all();
        return view('task.create', compact('users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,done',
            'priority'    => 'required|in:low,medium,high',
            'deadline'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['user_id'] = auth()->id();
        $task = Task::create($validated);

        if ($request->labels) {
            $task->labels()->sync($request->labels);
        }

        return redirect()->route('dashboard')
                        ->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return redirect()->route('dashboard');
    }

    public function edit(Task $task)
    {
        $users = \App\Models\User::all();
        $labels = \App\Models\Label::all();
        return view('task.edit', compact('task', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,done',
            'priority'    => 'required|in:low,medium,high',
            'deadline'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);
        $task->labels()->sync($request->labels ?? []);

        return redirect()->route('dashboard') ->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}