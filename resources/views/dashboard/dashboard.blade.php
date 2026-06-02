@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
    $nickname = $user?->nickname ?? $user?->name ?? 'User';

    $menus = [
        [
            'label' => 'Dashboard',
            'icon' => '▦',
            'route' => 'dashboard',
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'label' => 'My Tasks',
            'icon' => '☑',
            'route' => 'tasks.index',
            'active' => request()->routeIs('tasks.*'),
        ],
        [
            'label' => 'Members',
            'icon' => '👥',
            'route' => 'members.index',
            'active' => request()->routeIs('members.*'),
        ],
        [
            'label' => 'Admin',
            'icon' => '⚙',
            'route' => 'admin.index',
            'active' => request()->routeIs('admin.*'),
        ],
    ];

    $columns = [
        [
            'title' => 'Todo',
            'status' => 'todo',
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

<div class="min-h-[100vh] bg-white text-gray-900">
    <div class="flex min-h-[100vh]">

        {{-- Sidebar --}}
        <aside class="flex w-[18vw] flex-col justify-between border-r border-black bg-white">
            <div>
                <div class="border-b border-black px-[1.5vw] py-[2vh]">
                    <h1 class="text-[2vw] font-bold leading-tight tracking-tight text-black">
                        Taskora
                    </h1>

                    <p class="mt-[0.4vh] text-[0.85vw] font-medium leading-normal tracking-wide text-gray-500">
                        Team Workspace
                    </p>
                </div>

                <nav class="flex flex-col gap-[1vh] p-[1.2vw]">
                    @foreach ($menus as $menu)
                        <a
                            href="{{ route($menu['route']) }}"
                            class="flex items-center gap-[0.8vw] rounded-[0.6vw] border px-[1vw] py-[1.2vh] text-[1vw] font-medium leading-none tracking-tight transition
                                {{ $menu['active']
                                    ? 'border-black bg-yellow-300 text-black shadow-[0.3vw_0.3vw_0_#000]'
                                    : 'border-transparent text-gray-700 hover:border-black hover:bg-gray-50 hover:text-black'
                                }}"
                        >
                            <span>{{ $menu['icon'] }}</span>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- User Profile --}}
            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-[0.8vw] border-t border-black p-[1.2vw] transition hover:bg-gray-50"
            >
                <div class="flex h-[5vh] w-[5vh] items-center justify-center overflow-hidden rounded-full bg-black text-[1vw] font-semibold leading-none text-white">
                    @if ($user?->photo)
                        <img
                            src="{{ asset('storage/' . $user->photo) }}"
                            alt="Profile Photo"
                            class="h-full w-full object-cover"
                        >
                    @else
                        {{ strtoupper(substr($nickname, 0, 1)) }}
                    @endif
                </div>

                <div class="min-w-0">
                    <p class="truncate text-[0.95vw] font-semibold leading-tight text-black">
                        {{ $nickname }}
                    </p>

                    <p class="truncate text-[0.8vw] font-medium leading-normal tracking-wide text-gray-500">
                        {{ $user?->username ? '@' . $user->username : 'Edit Profile' }}
                    </p>
                </div>
            </a>
        </aside>

        {{-- Main --}}
        <main class="flex min-w-0 flex-1 flex-col bg-white">

            {{-- Topbar --}}
            <header class="flex h-[9vh] items-center justify-between border-b border-black bg-white px-[2vw]">
                <form
                    action="{{ route('dashboard') }}"
                    method="GET"
                    class="w-[35vw]"
                >
                    <label for="search" class="sr-only">
                        Search tasks
                    </label>

                    <div class="flex h-[5.5vh] items-center gap-[0.7vw] rounded-[0.6vw] border border-black bg-white px-[1vw] shadow-[0.3vw_0.3vw_0_#000]">
                        <span class="text-[1vw] font-medium leading-none text-gray-500">
                            ⌕
                        </span>

                        <input
                            id="search"
                            name="q"
                            type="text"
                            value="{{ request('q') }}"
                            placeholder="Search tasks..."
                            class="w-full bg-transparent text-[0.95vw] font-medium leading-none text-gray-700 outline-none placeholder:font-normal placeholder:text-gray-400"
                        >
                    </div>
                </form>

                <button
                    type="button"
                    class="flex h-[5.5vh] w-[5.5vh] items-center justify-center rounded-[0.6vw] border border-black bg-white text-[1.1vw] font-medium leading-none shadow-[0.3vw_0.3vw_0_#000]"
                    aria-label="Notifications"
                >
                    🔔
                </button>
            </header>

            {{-- Content --}}
            <section class="flex-1 p-[2vw]">
                <div class="mb-[2vh] flex items-end justify-between gap-[2vw]">
                    <div>
                        <h2 class="text-[3.2vw] font-bold leading-tight tracking-tight text-black">
                            My Taskora Board
                        </h2>

                        <p class="mt-[0.8vh] text-[1vw] font-medium leading-normal tracking-wide text-gray-500">
                            Hallo, {{ $nickname }}! What you gonna do today? ^^
                        </p>
                    </div>

                    <div class="flex items-center gap-[1vw]">
                        <form action="{{ route('dashboard') }}" method="GET">
                            <select
                                name="status"
                                onchange="this.form.submit()"
                                class="h-[5.5vh] rounded-[0.6vw] border border-black bg-white px-[1vw] text-[0.95vw] font-medium leading-none text-gray-700 shadow-[0.3vw_0.3vw_0_#000] outline-none"
                            >
                                <option value="">All Status</option>
                                <option value="todo" @selected(request('status') === 'todo')>
                                    Todo
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
                            class="flex h-[5.5vh] items-center rounded-[0.6vw] border border-black bg-blue-600 px-[1.2vw] text-[0.95vw] font-semibold leading-none tracking-tight text-white shadow-[0.3vw_0.3vw_0_#000] transition hover:translate-x-[0.15vw] hover:translate-y-[0.15vh] hover:shadow-none"
                        >
                            + New Board
                        </a>
                    </div>
                </div>

                {{-- Kanban Board --}}
                <div class="grid grid-cols-[repeat(3,1fr)] gap-[1.5vw]">
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

            {{-- Footer --}}
            <footer class="flex h-[6vh] items-center justify-center border-t border-black bg-white text-[0.9vw] font-medium leading-none tracking-wide text-gray-500">
                © 2026 Taskora. All rights reserved.
            </footer>

        </main>
    </div>
</div>
@endsection