@extends('layouts.app')

@section('content')
<div class="flex min-h-[92vh] flex-col bg-white">
    <section class="flex-1 px-[4vw] py-[5vh]">
        <div class="mb-[4vh]">
            <h1 class="text-[3vw] font-bold leading-tight text-black">
                Members
            </h1>

            <p class="mt-[1vh] text-[1vw] text-gray-500">
                Invite dan kelola member yang ada di Taskora.
            </p>
        </div>

        <form action="{{ route('members.invite') }}" method="POST" class="mb-[4vh] flex gap-[1vw]">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Masukkan email user yang mau diinvite"
                class="flex-1 rounded-xl border border-black bg-white px-[1vw] py-[1.5vh] text-[1vw] outline-none focus:ring-2 focus:ring-amber-300"
                required
            >

            <button
                type="submit"
                class="cursor-pointer rounded-xl border border-black bg-yellow-300 px-[2vw] py-[1.5vh] text-[1vw] font-bold text-black shadow-[0.4vw_0.4vw_0_#000] transition hover:translate-x-1 hover:translate-y-1 hover:bg-white hover:shadow-none"
            >
                Invite
            </button>
        </form>

        @if ($errors->any())
            <div class="mb-[3vh] rounded-xl border border-red-300 bg-red-50 px-[1vw] py-[1.5vh] text-[0.95vw] text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-[2vw]">
            @forelse ($members as $member)
                @php
                    $memberUser = $member->user;
                @endphp

                <div class="rounded-2xl border border-black bg-white p-[2vw] shadow-[0.6vw_0.6vw_0_#000]">
                    <div class="mb-[2vh] flex items-center gap-[1vw]">
                        <div class="flex h-[8vh] w-[8vh] items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                            @if ($memberUser?->photo)
                                <img
                                    src="{{ asset('storage/' . $memberUser->photo) }}"
                                    alt="{{ $memberUser->nickname ?? $memberUser->name }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <span class="text-[1.6vw] font-bold text-black">
                                    {{ strtoupper(substr($memberUser?->nickname ?? $memberUser?->name ?? 'U', 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <h2 class="text-[1.2vw] font-bold text-black">
                                {{ $memberUser?->nickname ?? $memberUser?->name }}
                            </h2>

                            <p class="text-[0.85vw] text-gray-500">
                                {{ $memberUser?->username ? '@' . $memberUser->username : $memberUser?->email }}
                            </p>
                        </div>
                    </div>

                    <p class="text-[0.95vw] leading-relaxed text-gray-600">
                        {{ $memberUser?->bio ?? 'Belum ada bio.' }}
                    </p>

                    <p class="mt-[2vh] text-[0.85vw] font-semibold text-gray-500">
                        Role: {{ $member->role }}
                    </p>
                </div>
            @empty
                <div class="col-span-3 rounded-2xl border border-dashed border-black bg-white p-[3vw] text-center">
                    <p class="text-[1vw] font-semibold text-gray-500">
                        Belum ada member.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

    <footer class="mt-auto flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>
</div>
@endsection