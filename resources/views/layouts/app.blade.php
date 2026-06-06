<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-gray-100">
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

    <header class="sticky top-0 z-40 flex min-h-16 items-center gap-3 border-b border-black bg-white px-4 py-2">
        <button
            id="openSidebar"
            type="button"
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-black bg-yellow-300 text-2xl font-black text-black shadow-[4px_4px_0_#000] transition hover:bg-yellow-400"
            aria-label="Open sidebar"
        >
            ☰
        </button>

        <a href="{{ route('dashboard') }}" class="flex shrink-0 items-center">
            <img
                src="{{ asset('images/taskora_logo.png') }}"
                alt="Taskora Logo"
                class="h-12 w-auto object-contain md:h-14"
            >
        </a>

        <form action="{{ route('dashboard') }}" method="GET" class="min-w-0 flex-1">
            <label for="search" class="sr-only">Search tasks</label>

            <div class="mx-auto flex h-11 w-full max-w-2xl items-center gap-2 rounded-lg border border-black bg-white px-3 shadow-[4px_4px_0_#000]">
                <span class="text-lg font-bold text-gray-500">
                    ⌕
                </span>

                <input
                    id="search"
                    name="q"
                    type="text"
                    value="{{ request('q') }}"
                    placeholder="Search tasks..."
                    class="w-full bg-transparent text-sm font-medium text-gray-700 outline-none placeholder:text-gray-400 md:text-base"
                >
            </div>
        </form>

        <div class="ml-auto flex shrink-0 items-center gap-3">
            <div class="relative">
                <button
                    id="notificationButton"
                    type="button"
                    class="flex h-11 w-11 items-center justify-center rounded-lg border border-black bg-white text-lg shadow-[4px_4px_0_#000] transition hover:bg-yellow-100"
                    aria-label="Notifications"
                >
                    🔔
                </button>

                <div
                    id="notificationPanel"
                    class="absolute right-0 top-14 z-50 hidden w-80 rounded-xl border border-black bg-white shadow-[8px_8px_0_#000]"
                >
                    <div class="flex items-center justify-between border-b border-black px-4 py-3">
                        <h2 class="text-lg font-black text-black">
                            Notifications
                        </h2>

                        <button
                            id="closeNotification"
                            type="button"
                            class="flex h-8 w-8 items-center justify-center rounded-lg border border-black bg-red-400 text-lg font-black text-black transition hover:bg-red-500"
                        >
                            ×
                        </button>
                    </div>

                    <div class="flex min-h-56 flex-col items-center justify-center px-6 py-8 text-center">
                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full border border-black bg-yellow-100 text-3xl">
                            🔔
                        </div>

                        <p class="text-base font-bold text-black">
                            No unread notifications
                        </p>

                        <p class="mt-2 text-sm font-medium text-gray-500">
                            Belum ada notifikasi baru untuk saat ini.
                        </p>
                    </div>
                </div>
            </div>

            <a
                href="{{ route('profile.edit') }}"
                class="flex h-11 items-center gap-2 rounded-lg border border-black bg-white px-2 shadow-[4px_4px_0_#000] transition hover:bg-yellow-100"
            >
                <div class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-black text-sm font-bold text-white">
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

                <div class="hidden min-w-0 md:block">
                    <p class="max-w-32 truncate text-sm font-bold leading-tight text-black">
                        {{ $nickname }}
                    </p>

                    <p class="max-w-32 truncate text-xs font-medium leading-tight text-gray-500">
                        {{ $user?->username ? '@' . $user->username : 'Edit Profile' }}
                    </p>
                </div>
            </a>
        </div>
    </header>

    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/50 opacity-0 transition-opacity duration-300 ease-in-out"
    ></div>

    <aside
        id="sidebar"
        class="fixed left-0 top-0 z-50 flex h-screen w-72 -translate-x-full flex-col justify-between border-r border-black bg-white shadow-[8px_0_0_#000] transition-transform duration-300 ease-in-out"
    >
        <div>
            <div class="flex items-start justify-between border-b border-black px-4 py-4">
                <div>
                    <img
                        src="{{ asset('images/taskora_logo.png') }}"
                        alt="Taskora Logo"
                        class="h-16 w-auto object-contain"
                    >

                    <p class="mt-1 text-sm font-semibold tracking-wide text-gray-500">
                        Team Workspace
                    </p>
                </div>

                <button
                    id="closeSidebar"
                    type="button"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-black bg-red-400 text-2xl font-black text-black transition hover:bg-red-500"
                    aria-label="Close sidebar"
                >
                    ×
                </button>
            </div>

            <nav class="mt-4 flex flex-col gap-3 px-4">
                @foreach ($menus as $menu)
                    <a
                        href="{{ route($menu['route']) }}"
                        class="flex items-center gap-3 rounded-lg border px-3 py-3 text-base font-bold transition duration-300 ease-in-out
                            {{ $menu['active']
                                ? 'border-black bg-yellow-300 text-black shadow-[4px_4px_0_#000]'
                                : 'border-transparent text-gray-700 hover:border-black hover:bg-yellow-100 hover:text-black'
                            }}"
                    >
                        <img
                            src="{{ asset('images/' . $menu['icon']) }}"
                            alt="{{ $menu['label'] }} Icon"
                            class="h-7 w-7 object-contain"
                        >

                        <span>{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="p-4">
            @csrf

            <button
                type="submit"
                class="w-full rounded-lg border border-black bg-red-400 px-4 py-3 text-base font-bold text-black shadow-[4px_4px_0_#000] transition hover:bg-red-500"
            >
                Logout
            </button>
        </form>
    </aside>

    <main class="min-h-[calc(100vh-4rem)] bg-white">
        @yield('content')
    </main>

    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
</body>
</html>