@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-white">
    <section class="flex-1 px-6 py-10">
        <div class="mx-auto max-w-7xl">

            <h1 class="mb-8 text-4xl font-bold text-black">Collaborators ({{ $totalMembers ?? 1 }})</h1>

            {{-- Invite Form --}}
            <form action="{{ route('members.invite') }}" method="POST" class="mb-8 flex flex-col gap-4 md:flex-row">
                @csrf
                <input type="email" name="email" placeholder="Email address"
                    class="flex-1 rounded-xl border border-black px-4 py-3 text-base outline-none focus:ring-2 focus:ring-amber-300" required>
                <button type="submit"
                    class="rounded-xl border border-black bg-yellow-300 px-8 py-3 text-base font-bold text-black shadow-md transition hover:translate-x-1 hover:translate-y-1 hover:bg-white hover:shadow-none">
                    Invite
                </button>
            </form>

            {{-- Messages --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $btnClass = 'rounded-lg border border-black bg-yellow-300 px-5 py-2 text-sm font-bold text-black shadow-md transition hover:translate-x-1 hover:translate-y-1 hover:bg-white hover:shadow-none';
            @endphp

            {{-- Cards --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                {{-- Admin Card --}}
                <div class="relative rounded-2xl border border-black bg-white p-6 shadow-md">
                    <div class="flex items-center gap-5 mb-5">
                        <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                            @if($admin?->photo)
                                <img src="{{ asset('storage/' . $admin->photo) }}" alt="{{ $admin->nickname ?? $admin->name }}" class="h-full w-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-black">{{ strtoupper(substr($admin?->nickname ?? $admin?->name ?? 'U', 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <h2 class="truncate text-2xl font-bold text-black">{{ $admin?->nickname ?? $admin?->name }}</h2>
                            <p class="mt-1 text-base text-gray-600">{{ $admin?->bio ?? 'No bio yet.' }}</p>
                        </div>
                    </div>
                    <p class="text-base font-semibold text-gray-500">Role: Admin</p>
                    <span class="absolute bottom-6 right-6 rounded-lg border border-black bg-yellow-300 px-5 py-2 text-sm font-bold text-black shadow-md cursor-default">
                        Admin
                    </span>
                </div>

                {{-- Member Cards --}}
                @forelse ($members as $member)
                    @php $user = $member->member; @endphp
                    <div class="relative rounded-2xl border border-black bg-white p-6 shadow-md">
                        <div class="flex items-center gap-5 mb-5">
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-full border border-black bg-white">
                                @if($user?->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->nickname ?? $user->name }}" class="h-full w-full object-cover">
                                @else
                                    <span class="text-2xl font-bold text-black">{{ strtoupper(substr($user?->nickname ?? $user?->name ?? 'U', 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h2 class="truncate text-2xl font-bold text-black">{{ $user?->nickname ?? $user?->name }}</h2>
                                <p class="mt-1 text-base text-gray-600">{{ $user?->bio ?? 'No bio yet.' }}</p>
                            </div>
                        </div>

                        <p class="text-base font-semibold text-gray-500">Role: Member</p>

                        @if ($member->member_id === auth()->id())
                            <form action="{{ route('members.leave', $member) }}" method="POST" class="absolute bottom-6 right-6">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="{{ $btnClass }}" onclick="return confirm('Are you sure you want to leave this workspace?')">Leave</button>
                            </form>
                        @else
                            <form action="{{ route('members.destroy', $member) }}" method="POST" class="absolute bottom-6 right-6">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="{{ $btnClass }}" onclick="return confirm('Are you sure you want to kick this member?')">Kick</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-black bg-white p-10 text-center">
                        <p class="text-base font-semibold text-gray-500">No members have been invited yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection