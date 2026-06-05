@extends('layouts.auth')

@section('content')
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="w-[450px] max-w-lg bg-white rounded-md p-8 border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <!-- Header -->
        <div class="text-left pb-7">
            <h1 class="text-3xl font-bold text-black">Lupa Password?</h1>
            <p class="text-gray-500 mt-2">Masukkan email Anda dan kami akan mengirimkan link reset password.</p>
        </div>

        {{-- Status success --}}
        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-md px-4 py-3 mb-5">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('password.send') }}" method="POST" class="space-y-5">
            @csrf

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
                    placeholder="Masukkan Email Anda"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-amber-300 hover:bg-yellow-400 text-black py-3 rounded-md transition border border-black shadow-[5px_5px_0px_0px_rgba(0,0,0,1)]"
            >
                Kirim Link Reset Password
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Ingat password Anda?
            <a href="{{ route('login.form') }}" class="text-yellow-500 hover:underline">Kembali ke Login</a>
        </p>
    </div>
</div>
@endsection
