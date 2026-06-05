@extends('layouts.auth')

@section('content')
<div class="font-inter flex items-center justify-center min-h-[80vh] p-15">
    <div class="w-[450px] max-w-lg bg-white rounded-md p-8 border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">

        <div class="text-left pb-7">
            <h1 class="text-3xl font-bold text-black">Buat Akun Baru</h1>
            <p class="text-gray-500 mt-2">Buat akun untuk melanjutkan ke TaskBoard</p>
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
                    placeholder="Nama Lengkap Anda"
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
                    placeholder="Email Anda"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- No. Handphone -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">No. Handphone</label>
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
                    placeholder="Min. 8 Karakter"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block text-sm font-medium text-black mb-2">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi Password"
                    class="w-full px-4 py-3 border rounded-md focus:ring-2 focus:ring-amber-300 focus:outline-none"
                    required
                >
            </div>

            <!-- Checkbox Syarat & Ketentuan -->
            <div class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="agree" id="agree" required>
                <label for="agree">
                    Saya telah membaca dan menyetujui
                    <button type="button" onclick="document.getElementById('modalSyarat').classList.remove('hidden')"
                        class="text-yellow-500 hover:underline">
                        Syarat dan Ketentuan
                    </button>
                </label>
            </div>

            <!-- Modal Syarat & Ketentuan -->
            <div id="modalSyarat" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div class="bg-white rounded-md p-6 w-[90%] max-w-md border border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-lg font-bold mb-4">Syarat dan Ketentuan</h2>
                    <div class="text-sm text-gray-600 space-y-2 max-h-64 overflow-y-auto">
                        <ol class="list-decimal list-inside space-y-2">
                            <li>Setiap anggota wajib memeriksa taskboard secara berkala.</li>
                            <li>Tugas yang diberikan dianggap diterima setelah dicantumkan pada taskboard.</li>
                            <li>Setiap tugas memiliki tenggat waktu yang wajib dipatuhi.</li>
                            <li>Perubahan status tugas harus dilakukan sesuai perkembangan pekerjaan.</li>
                            <li>Tugas selesai wajib disertai bukti atau hasil pekerjaan.</li>
                            <li>Kendala dalam pengerjaan wajib dilaporkan sebelum deadline.</li>
                            <li>Dilarang menghapus atau mengubah tugas milik anggota lain tanpa izin.</li>
                            <li>Koordinator berhak melakukan penyesuaian tugas sesuai kebutuhan tim.</li>
                            <li>Setiap anggota bertanggung jawab atas tugas yang diberikan.</li>
                            <li>Jika tugas tidak selesai tepat waktu, ajukan perpanjangan sebelum deadline.</li>
                            <li>Komunikasi terkait tugas diutamakan melalui media resmi yang disepakati.</li>
                            <li>Pelanggaran ketentuan dapat menjadi bahan evaluasi kinerja anggota.</li>
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
                Buat Akun
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login.form') }}" class="text-yellow-500 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
