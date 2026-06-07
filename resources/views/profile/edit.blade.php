<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Taskora</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-gray-100 font-[Inter]">
    <div class="flex min-h-screen flex-col">

        <!-- Navbar -->
        <header class="sticky top-0 z-50 flex min-h-16 items-center justify-between border-b border-black bg-white px-6 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img
                    src="{{ asset('images/taskora_logo.png') }}"
                    alt="Taskora Logo"
                    class="h-12 w-auto object-contain"
                >
            </a>
        </header>

        <!-- Main Content -->
        <main class="flex flex-1 items-center justify-center px-4 py-10">
            <div class="w-full max-w-lg rounded-2xl border border-black bg-white p-6 shadow-[8px_8px_0_#000]">

                <!-- Header Card -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold leading-tight text-black">
                        Edit Profile
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Ubah username, nickname, bio, dan foto profil kamu.
                    </p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Foto Profil -->
                    <div class="flex items-center gap-4">
                        <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                            @if ($user?->photo)
                                <img
                                    src="{{ asset('storage/' . $user?->photo) }}"
                                    alt="Profile Photo"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <span class="text-xl font-bold text-black">
                                    {{ strtoupper(substr($user?->nickname ?? $user?->name ?? 'U', 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <div class="flex-1">
                            <label class="mb-1 block text-sm font-semibold text-gray-700">
                                Foto Profil
                            </label>

                            <input
                                type="file"
                                name="photo"
                                accept="image/*"
                                class="w-full rounded-xl border border-black bg-white px-3 py-2 text-sm outline-none"
                            >
                        </div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ old('username', $user?->username) }}"
                            placeholder="Masukkan username"
                            class="w-full rounded-xl border border-black bg-white px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-amber-300"
                        >
                    </div>

                    <!-- Nickname -->
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">
                            Nickname
                        </label>

                        <input
                            type="text"
                            name="nickname"
                            value="{{ old('nickname', $user?->nickname) }}"
                            placeholder="Masukkan nickname"
                            class="w-full rounded-xl border border-black bg-white px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-amber-300"
                        >
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">
                            Bio
                        </label>

                        <textarea
                            name="bio"
                            rows="4"
                            placeholder="Tulis bio singkat"
                            class="w-full resize-none rounded-xl border border-black bg-white px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-amber-300"
                        >{{ old('bio', $user?->bio) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-2">
                        <button
                            type="submit"
                            class="flex-1 cursor-pointer rounded-xl border border-black bg-yellow-300 px-4 py-3 text-sm font-semibold text-black shadow-[5px_5px_0_#000] transition duration-200 hover:translate-x-1 hover:translate-y-1 hover:bg-white hover:shadow-none"
                        >
                            Save Profile
                        </button>

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex-1 cursor-pointer rounded-xl border border-black bg-white px-4 py-3 text-center text-sm font-semibold text-black shadow-[5px_5px_0_#000] transition duration-200 hover:translate-x-1 hover:translate-y-1 hover:bg-yellow-300 hover:shadow-none"
                        >
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-auto flex h-14 items-center justify-center border-t border-black bg-white text-sm font-semibold tracking-wide text-gray-500">
            © 2026 Taskora. All rights reserved.
        </footer>
    </div>
</body>
</html>