@extends('layouts.app')

@section('content')
<div class="font-inter flex items-center justify-center min-h-[80vh]">
    <!-- Header -->
    <div class="">
    <div class="w-[450px] max-w-lg bg-indigo-50 rounded-2xl p-8 border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <!-- Header Box -->
        <div class="text-left pb-7">
            <h1 class="text-3xl font-bold text-black">Login To TaskBoard</h1>
            <p class="text-gray-500 mt-2">Login untuk melanjutkan ke TaskBoard</p>
        </div>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Tampilkan error --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter Your Email"
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                >
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition"
            >
                Login
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="#" class="text-blue-500 hover:underline">Register</a>
        </p>

    </div>
</div>
@endsection