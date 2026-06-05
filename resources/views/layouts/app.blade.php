<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskora</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-gray-100 font-[Inter]">
    @php
        $user = auth()->user();
        $nickname = $user?->nickname ?? $user?->name ?? 'User';

        $menus = [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'dashboard_icon.png',
                'active' => request()->routeIs('dashboard'),
            ],
            [
                'label' => 'My Tasks',
                'route' => 'tasks.index',
                'icon' => 'mytasks_icon.png',
                'active' => request()->routeIs('tasks.*'),
            ],
            [
                'label' => 'Members',
                'route' => 'members.index',
                'icon' => 'members_icon.png',
                'active' => request()->routeIs('members.*'),
            ],
            [
                'label' => 'Admin',
                'route' => 'admin.index',
                'icon' => 'admin_icon.png',
                'active' => request()->routeIs('admin.*'),
            ],
        ];
    @endphp

    <header class="sticky top-0 z-40 flex h-[8vh] items-center gap-[1.5vw] border-b border-black bg-white px-[2vw]">
        <button
            id="openSidebar"
            type="button"
            class="flex h-[5vh] w-[5vh] items-center justify-center rounded-[0.7vw] border border-black bg-yellow-300 text-[2.5vh] font-black text-black shadow-[0.25vw_0.25vw_0_#000] transition hover:bg-yellow-400"
        >
            ☰
        </button>

        <h1 class="shrink-0 text-[2.4vh] font-black text-black">
            Taskora
        </h1>

        <form action="{{ route('dashboard') }}" method="GET" class="flex-1">
            <label for="search" class="sr-only">Search tasks</label>

            <div class="mx-auto flex h-[5.3vh] w-[55vw] items-center gap-[0.8vw] rounded-[0.7vw] border border-black bg-white px-[1.2vw] shadow-[0.25vw_0.25vw_0_#000]">
                <span class="text-[2vh] font-bold text-gray-500">
                    ⌕
                </span>

                <input
                    id="search"
                    name="q"
                    type="text"
                    value="{{ request('q') }}"
                    placeholder="Search tasks..."
                    class="w-full bg-transparent text-[1.9vh] font-medium text-gray-700 outline-none placeholder:text-gray-400"
                >
            </div>
        </form>

        <div class="ml-auto flex items-center gap-[1vw]">
            <button
                type="button"
                class="flex h-[5.3vh] w-[5.3vh] items-center justify-center rounded-[0.7vw] border border-black bg-white text-[2vh] shadow-[0.25vw_0.25vw_0_#000]"
                aria-label="Notifications"
            >
                🔔
            </button>

            <a
                href="{{ route('profile.edit') }}"
                class="flex h-[5.3vh] items-center gap-[0.7vw] rounded-[0.7vw] border border-black bg-white px-[0.8vw] shadow-[0.25vw_0.25vw_0_#000] transition hover:bg-yellow-100"
            >
                <div class="flex h-[3.8vh] w-[3.8vh] items-center justify-center overflow-hidden rounded-full bg-black text-[1.5vh] font-bold text-white">
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
                    <p class="max-w-[9vw] truncate text-[1.5vh] font-bold leading-tight text-black">
                        {{ $nickname }}
                    </p>

                    <p class="max-w-[9vw] truncate text-[1.2vh] font-medium leading-tight text-gray-500">
                        {{ $user?->username ? '@' . $user->username : 'Edit Profile' }}
                    </p>
                </div>
            </a>
        </div>
    </header>

    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/40"
    ></div>

    <aside
        id="sidebar"
        class="fixed left-0 top-0 z-50 flex h-[100vh] w-[24vw] min-w-[20vw] -translate-x-full flex-col justify-between border-r border-black bg-white shadow-[0.4vw_0_0_#000] transition-transform duration-300"
    >
        <div>
            <div class="flex items-start justify-between border-b border-black px-[1.5vw] py-[2.5vh]">
                <div>
                    <img
                        src="{{ asset('images/taskora_logo.png') }}"
                        alt="Taskora Logo"
                        class="h-[5.8vh] w-auto object-contain"
                    >

                    <p class="mt-[1vh] text-[1.7vh] font-semibold text-gray-500">
                        Team Workspace
                    </p>
                </div>

                <button
                    id="closeSidebar"
                    type="button"
                    class="flex h-[4.5vh] w-[4.5vh] items-center justify-center rounded-[0.7vw] border border-black bg-red-400 text-[2.4vh] font-black text-black transition hover:bg-red-500"
                >
                    ×
                </button>
            </div>

            <nav class="mt-[2vh] flex flex-col gap-[1.4vh] px-[1.2vw]">
                @foreach ($menus as $menu)
                    <a
                        href="{{ route($menu['route']) }}"
                        class="flex items-center gap-[1vw] rounded-[0.8vw] border px-[1vw] py-[1.6vh] text-[2vh] font-bold transition
                            {{ $menu['active']
                                ? 'border-black bg-yellow-300 text-black shadow-[0.3vw_0.3vw_0_#000]'
                                : 'border-transparent text-gray-700 hover:border-black hover:bg-yellow-100 hover:text-black'
                            }}"
                    >
                        <img
                            src="{{ asset('images/' . $menu['icon']) }}"
                            alt="{{ $menu['label'] }} Icon"
                            class="h-[4vh] w-[4vh] object-contain"
                        >

                        <span>{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="p-[1.2vw]">
            @csrf

            <button
                type="submit"
                class="w-full rounded-[0.8vw] border border-black bg-red-400 px-[1vw] py-[1.6vh] text-[2vh] font-bold text-black shadow-[0.3vw_0.3vw_0_#000] transition hover:bg-red-500"
            >
                Logout
            </button>
        </form>
    </aside>

    <main class="min-h-[92vh] bg-white">
        @yield('content')
    </main>

    <script>
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        openSidebar.addEventListener('click', function () {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', function () {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    </script>
</body>
</html>