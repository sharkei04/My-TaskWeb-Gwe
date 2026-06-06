@extends('layouts.app')

@section('content')
<div class="flex min-h-[92vh] flex-col bg-white">
    <section class="flex-1 px-[4vw] py-[5vh]">
        <div class="mb-[4vh]">
            <h1 class="text-[3vw] font-bold leading-tight text-black">
                Members
            </h1>

            <p class="mt-[1vh] text-[1vw] text-gray-500">
                Daftar member yang ada di Taskora.
            </p>
        </div>

        <div class="grid grid-cols-3 gap-[2vw]">
            @foreach ($members as $member)
                <div class="rounded-2xl border border-black bg-indigo-50 p-[2vw] shadow-[0.6vw_0.6vw_0_#000]">
                    <div class="mb-[2vh] flex items-center gap-[1vw]">
                        <div class="flex h-[8vh] w-[8vh] items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                            @if ($member->photo)
                                <img
                                    src="{{ asset('storage/' . $member->photo) }}"
                                    alt="{{ $member->nickname ?? $member->name }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <span class="text-[1.6vw] font-bold text-black">
                                    {{ strtoupper(substr($member->nickname ?? $member->name ?? 'U', 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <div>
                            <h2 class="text-[1.2vw] font-bold text-black">
                                {{ $member->nickname ?? $member->name }}
                            </h2>

                            <p class="text-[0.85vw] text-gray-500">
                                {{ $member->username ? '@' . $member->username : $member->email }}
                            </p>
                        </div>
                    </div>

                    <p class="text-[0.95vw] leading-relaxed text-gray-600">
                        {{ $member->bio ?? 'Belum ada bio.' }}
                    </p>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="mt-auto flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>
</div>
@endsection