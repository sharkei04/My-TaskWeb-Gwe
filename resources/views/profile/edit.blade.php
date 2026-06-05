@extends('layouts.app')

@section('content')
<div class="font-inter flex min-h-[100vh] items-center justify-center bg-white px-[4vw] py-[6vh]">
    <div class="w-[45vw] rounded-2xl border border-black bg-indigo-50 p-[3vw] shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <div class="mb-[4vh]">
            <h1 class="text-[2.6vw] font-bold leading-tight text-black">
                Edit Profile
            </h1>
            <p class="mt-[1vh] text-[1vw] text-gray-500">
                Ubah username, nickname, bio, dan foto profil kamu.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-[3vh] rounded-xl border border-green-300 bg-green-50 px-[1.2vw] py-[1.5vh] text-[0.95vw] text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-[3vh] rounded-xl border border-red-300 bg-red-50 px-[1.2vw] py-[1.5vh] text-[0.95vw] text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-[2.5vh]">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-[1.5vw]">
                <div class="flex h-[10vh] w-[10vh] items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                    @if ($user?->photo)
                        <img
                            src="{{ asset('storage/' . $user?->photo) }}"
                            alt="Profile Photo"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <span class="text-[2vw] font-bold text-black">
                            {{ strtoupper(substr($user?->nickname ?? $user?->name ?? 'U', 0, 1)) }}
                        </span>
                    @endif
                </div>

                <div class="flex-1">
                    <label class="mb-[1vh] block text-[0.95vw] font-semibold text-gray-700">
                        Foto Profil
                    </label>
                    <input
                        type="file"
                        name="photo"
                        accept="image/*"
                        class="w-full rounded-xl border border-black bg-white px-[1vw] py-[1.5vh] text-[0.95vw] outline-none"
                    >
                </div>
            </div>

            <div>
                <label class="mb-[1vh] block text-[0.95vw] font-semibold text-gray-700">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username', $user?->username) }}"
                    placeholder="Masukkan username"
                    class="w-full rounded-xl border border-black bg-white px-[1vw] py-[1.7vh] text-[1vw] outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="mb-[1vh] block text-[0.95vw] font-semibold text-gray-700">
                    Nickname
                </label>
                <input
                    type="text"
                    name="nickname"
                    value="{{ old('nickname', $user?->nickname) }}"
                    placeholder="Masukkan nickname"
                    class="w-full rounded-xl border border-black bg-white px-[1vw] py-[1.7vh] text-[1vw] outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="mb-[1vh] block text-[0.95vw] font-semibold text-gray-700">
                    Bio
                </label>
                <textarea
                    name="bio"
                    rows="4"
                    placeholder="Tulis bio singkat kamu"
                    class="w-full resize-none rounded-xl border border-black bg-white px-[1vw] py-[1.7vh] text-[1vw] outline-none focus:ring-2 focus:ring-blue-500"
                >{{ old('bio', $user?->bio) }}</textarea>
            </div>

            <div class="flex items-center gap-[1vw] pt-[2vh]">
                <button
                    type="submit"
                    class="rounded-xl border border-black bg-yellow-300 px-[2vw] py-[1.7vh] text-[1vw] font-semibold text-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition hover:bg-yellow-400"
                >
                    Save Profile
                </button>

                <a
                    href="{{ route('dashboard') }}"
                    class="rounded-xl border border-black bg-white px-[2vw] py-[1.7vh] text-[1vw] font-semibold text-black"
                >
                    Back
                </a>
            </div>
        </form>
    </div>

    <footer class="mt-auto flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>
    
</div>
@endsection