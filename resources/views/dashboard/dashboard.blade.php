@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $nickname = $user?->nickname ?? $user?->name ?? 'User';

    $columns = [
        [
            'title' => 'To do',
            'status' => 'todo',
            'count' => isset($tasks['todo']) ? $tasks['todo']->count() : 0,
            'headerClass' => 'bg-gray-100',
        ],
        [
            'title' => 'In Progress',
            'status' => 'in_progress',
            'count' => isset($tasks['in_progress']) ? $tasks['in_progress']->count() : 0,
            'headerClass' => 'bg-yellow-300',
        ],
        [
            'title' => 'Done',
            'status' => 'done',
            'count' => isset($tasks['done']) ? $tasks['done']->count() : 0,
            'headerClass' => 'bg-green-400',
        ],
    ];
@endphp

<div class="flex min-h-[calc(100vh-4rem)] flex-col bg-white text-gray-900">
    <section class="flex-1 px-6 py-8 lg:px-10">
        <div class="w-full">

            <div class="mb-8 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-4xl font-black leading-tight tracking-tight text-black lg:text-5xl">
                        My Taskora Board
                    </h2>

                    <p class="mt-2 text-base font-semibold leading-normal tracking-wide text-gray-500">
                        Hallo, {{ $nickname }}! What you gonna do? ^^
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                    <form action="{{ route('dashboard') }}" method="GET" class="w-full sm:w-auto">
                        <select
                            name="status"
                            onchange="this.form.submit()"
                            class="h-11 w-full rounded-lg border border-black bg-white px-4 text-sm font-bold text-gray-700 shadow-[4px_4px_0_#000] outline-none sm:w-auto"
                        >
                            <option value="">All Status</option>
                            <option value="to do" @selected(request('status') === 'to do')>
                                To do
                            </option>
                            <option value="in_progress" @selected(request('status') === 'in_progress')>
                                In Progress
                            </option>
                            <option value="done" @selected(request('status') === 'done')>
                                Done
                            </option>
                        </select>
                    </form>

                    <a
                        href="{{ route('boards.create') }}"
                        class="flex h-11 w-full items-center justify-center rounded-lg border border-black bg-blue-600 px-4 text-sm font-bold text-white shadow-[4px_4px_0_#000] transition hover:translate-x-1 hover:translate-y-1 hover:shadow-none sm:w-auto"
                    >
                        + New Board
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3" id="board-columns">
                @foreach ($columns as $column)
                    <x-kanban-column
                        :title="$column['title']"
                        :status="$column['status']"
                        :count="$column['count']"
                        :header-class="$column['headerClass']"
                    >
                        <div class="space-y-3 kanban-dropzone" data-status="{{ $column['status'] }}">
                            @foreach($tasks[$column['status']] ?? [] as $task)
                                <div
                                    class="task-card p-3 bg-white border border-black rounded cursor-grab"
                                    draggable="true"
                                    data-task-id="{{ $task->id }}"
                                    data-status="{{ $column['status'] }}"
                                >
                                    <p class="text-sm font-bold">{{ $task->title }}</p>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach($task->labels as $label)
                                            <span class="text-xs border border-black px-2 py-0.5 font-bold">{{ $label->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500">
                                            @if($task->priority === 'high') 🔴
                                            @elseif($task->priority === 'medium') 🟡
                                            @else 🟢 @endif
                                            {{ $task->deadline ? $task->deadline->format('d M') : 'No deadline' }}
                                        </span>
                                        <a href="{{ route('tasks.edit', $task) }}"
                                        class="text-xs font-black border border-black px-2 py-0.5 hover:bg-black hover:text-white">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-kanban-column>
    @endforeach
            </div>
        </section>

</div>
@endsection