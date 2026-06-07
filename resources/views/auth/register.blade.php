@extends('layouts.auth')

@section('content')
<div class="font-inter flex items-center justify-center min-h-[80vh] p-15">
    <div class="w-[450px] max-w-lg bg-white rounded-md p-8 border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <div class="text-left pb-7">
            <h1 class="text-3xl font-bold text-black">Create New Account</h1>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-md px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Full Name"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email Andress"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- No. Handphone -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Phone Number</label>
                <input
                    type="text"
                    name="telepon"
                    value="{{ old('telepon') }}"
                    placeholder="08xxxxxxxxxx"
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
                    placeholder="Min. 8 Characters"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Re-enter Password"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Checkbox Syarat & Ketentuan -->
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="agree" id="agree" required>
                <label for="agree">
                    I have read and agree to the
                    <button type="button" onclick="document.getElementById('modalSyarat').classList.remove('hidden')"
                        class="text-yellow-500 hover:underline">
                        Terms and Conditions
                    </button>
                </label>
            </div>

            <!-- Modal Syarat & Ketentuan -->
            <div id="modalSyarat" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div class="bg-white rounded-md p-6 w-[90%] max-w-md border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-lg font-bold mb-4">Terms and Conditions</h2>
                    <div class="text-sm text-gray-600 space-y-2 max-h-64 overflow-y-auto">
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Each member is required to check the taskboard regularly.</li>
                            <li>Assigned tasks are considered accepted once they are listed on the taskboard.</li>
                            <li>Each task has a deadline that must be followed.</li>
                            <li>Task status updates must reflect the actual progress of the work.</li>
                            <li>Completed tasks must include proof or work results.</li>
                            <li>Any issues encountered during the task must be reported before the deadline.</li>
                            <li>Members are not allowed to delete or modify tasks assigned to other members without permission.</li>
                            <li>The coordinator has the right to adjust tasks according to the team’s needs.</li>
                            <li>Each member is responsible for the tasks assigned to them.</li>
                            <li>If a task cannot be completed on time, members must request an extension before the deadline.</li>
                            <li>Task-related communication should be conducted through the agreed official communication channels.</li>
                            <li>Violations of these terms may be used as part of the member’s performance evaluation.</li>
                        </ol>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="document.getElementById('modalSyarat').classList.add('hidden')"
                            class="px-4 py-2 border border-black rounded-md text-sm hover:bg-gray-100">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-amber-300 hover:bg-yellow-400 text-black py-3 rounded-md transition border border-black shadow-[5px_5px_0px_0px_rgba(0,0,0,1)]"
            >
                Create Account
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account?
            <a href="{{ route('login.form') }}" class="text-yellow-500 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
