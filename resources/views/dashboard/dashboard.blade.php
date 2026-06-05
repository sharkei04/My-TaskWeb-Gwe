@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $nickname = $user?->nickname ?? $user?->name ?? 'User';

    $columns = [
        [
            'title' => 'To do',
            'status' => 'to do',
            'count' => 0,
            'headerClass' => 'bg-gray-100',
        ],
        [
            'title' => 'In Progress',
            'status' => 'in_progress',
            'count' => 0,
            'headerClass' => 'bg-yellow-300',
        ],
        [
            'title' => 'Done',
            'status' => 'done',
            'count' => 0,
            'headerClass' => 'bg-green-400',
        ],
    ];
@endphp

<div class="flex min-h-[92vh] flex-col bg-white text-gray-900">
    <section class="px-[4vw] py-[5vh]">
        <div class="mb-[4vh] flex flex-col gap-[3vh] xl:flex-row xl:items-end xl:justify-between">
            <div>
                <h2 class="text-[5vh] font-black leading-tight tracking-tight text-black sm:text-[6vh]">
                    My Taskora Board
                </h2>

                <p class="mt-[1vh] text-[2vh] font-semibold leading-normal tracking-wide text-gray-500">
                    Hallo, {{ $nickname }}! What you gonna do today? ^^
                </p>
            </div>

            <div class="flex flex-col gap-[2vh] sm:flex-row sm:items-center">
                <form action="{{ route('dashboard') }}" method="GET" class="w-full sm:w-auto">
                    <select
                        name="status"
                        onchange="this.form.submit()"
                        class="h-[5.8vh] w-full rounded-[0.8vw] border border-black bg-white px-[4vw] text-[1.8vh] font-bold text-gray-700 shadow-[0.3vw_0.3vw_0_#000] outline-none sm:w-auto lg:px-[1.2vw]"
                    >
                        <option value="">All Status</option>
                        <option value="todo" @selected(request('status') === 'todo')>Todo</option>
                        <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress</option>
                        <option value="done" @selected(request('status') === 'done')>Done</option>
                    </select>
                </form>

                <a
                    href="{{ route('boards.create') }}"
                    class="flex h-[5.8vh] w-full items-center justify-center rounded-[0.8vw] border border-black bg-blue-600 px-[4vw] text-[1.8vh] font-bold text-white shadow-[0.3vw_0.3vw_0_#000] transition hover:translate-x-[0.15vw] hover:translate-y-[0.15vh] hover:shadow-none sm:w-auto lg:px-[1.5vw]"
                >
                    + New Board
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-[3vh] md:grid-cols-2 xl:grid-cols-3 xl:gap-[1.5vw]">
            @foreach ($columns as $column)
                <x-kanban-column
                    :title="$column['title']"
                    :status="$column['status']"
                    :count="$column['count']"
                    :header-class="$column['headerClass']"
                />
            @endforeach
        </div>
    </section>

    <footer class="mt-auto flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>
    
</div>
@endsection