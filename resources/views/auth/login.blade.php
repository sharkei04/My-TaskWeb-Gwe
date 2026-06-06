@extends('layouts.auth')

@section('content')
<div class="flex items-center justify-center min-h-[80vh]">
    <!-- Header -->
    <div class="w-[450px] max-w-lg bg-white rounded-md p-8 border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <!-- Header Box -->
        <div class="text-left pb-7">
            <h1 class="text-3xl font-bold text-black">Login To Taskora</h1>
            <p class="text-gray-500 mt-2">Login untuk melanjutkan ke Taskora</p>
        </div>

            <!-- Status success -->
            @if(session('success'))
                <div class="mb-4 rounded-md border border-green-400 bg-green-100 px-4 py-3 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Tampilkan error --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-md px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter Your Email"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-black">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <a href="{{ route('lupapassword') }}" class="text-yellow-500 hover:underline">Forgot password?</a>
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-amber-300 hover:bg-yellow-400 text-black py-3 rounded-md transition border border-black shadow-[5px_5px_0px_0px_rgba(0,0,0,1)]"
            >
                Login
            </button>
        </form>

        <div class="pt-5 flex items-center gap-3 my-4">
            <div class="flex-1 h-px bg-gray-300"></div>
            <span class="text-sm text-gray-400">OR</span>
            <div class="flex-1 h-px bg-gray-300"></div>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-yellow-500 hover:underline">Register</a>
        </p>

    </div>
</div>
@endsection 