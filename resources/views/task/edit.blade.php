@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('task.index') }}"
                class="flex items-center gap-2 px-4 py-2 border-2 border-black bg-white font-bold text-sm hover:bg-black hover:text-white transition-colors">
                ← Kembali ke Board
            </a>
            <h1 class="text-3xl font-black" style="font-family: 'Syne', sans-serif;">Edit Tugas</h1>
            <span class="text-xs font-black border-2 border-black px-3 py-1 bg-yellow-100">✏️ Mode Edit</span>
        </div>
        <span class="text-xs text-gray-500 font-semibold">
            ID #{{ $task->id }} · Dibuat {{ $task->created_at->format('d M Y') }}
        </span>
    </div>

    <form action="{{ route('task.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-5 items-start">

            {{-- LEFT: MAIN FORM --}}
            <div class="flex flex-col gap-5">

                {{-- Informasi Tugas --}}
                <div class="bg-white border-[2.5px] border-black p-6">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-5 pb-2 border-b-2 border-black">
                        Informasi Tugas
                    </h2>

                    {{-- Judul --}}
                    <div class="mb-5">
                        <label class="block text-xs font-black tracking-wide uppercase mb-2">
                            Judul Tugas <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                                placeholder="Contoh: Implementasi autentikasi login..."
                                class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-600 text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <label class="block text-xs font-black tracking-wide uppercase mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                                    placeholder="Jelaskan detail tugas..."
                                    class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none resize-y">{{ old('description', $task->description) }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-black tracking-wide uppercase mb-2">Status</label>
                        <div class="grid grid-cols-3 gap-2" x-data="{ status: '{{ old('status', $task->status) }}' }">
                            <label :class="status === 'todo' ? 'bg-violet-100 border-violet-600' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="status" value="todo" x-model="status" class="hidden">
                                📋 Todo
                            </label>
                            <label :class="status === 'in_progress' ? 'bg-amber-100 border-amber-500' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="status" value="in_progress" x-model="status" class="hidden">
                                ⚡ In Progress
                            </label>
                            <label :class="status === 'done' ? 'bg-emerald-100 border-emerald-500' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="status" value="done" x-model="status" class="hidden">
                                ✅ Done
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Prioritas & Deadline --}}
                <div class="bg-white border-[2.5px] border-black p-6">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-5 pb-2 border-b-2 border-black">
                        Prioritas & Deadline
                    </h2>

                    {{-- Prioritas --}}
                    <div class="mb-5">
                        <label class="block text-xs font-black tracking-wide uppercase mb-2">
                            Prioritas <span class="text-red-600">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2" x-data="{ priority: '{{ old('priority', $task->priority) }}' }">
                            <label :class="priority === 'low' ? 'bg-emerald-100' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="priority" value="low" x-model="priority" class="hidden">
                                🟢 Low
                            </label>
                            <label :class="priority === 'medium' ? 'bg-amber-100' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="priority" value="medium" x-model="priority" class="hidden">
                                🟡 Medium
                            </label>
                            <label :class="priority === 'high' ? 'bg-red-100' : 'bg-white'"
                                    class="border-2 border-black p-2.5 text-center text-xs font-black cursor-pointer transition-colors">
                                <input type="radio" name="priority" value="high" x-model="priority" class="hidden">
                                🔴 High
                            </label>
                        </div>
                    </div>

                    {{-- Deadline --}}
                    <div>
                        <label class="block text-xs font-black tracking-wide uppercase mb-2">Deadline</label>
                        <input type="date" name="deadline"
                                value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}"
                                class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none cursor-pointer">
                        <p class="text-xs text-gray-500 font-semibold mt-1">Kosongkan untuk menghapus deadline</p>
                    </div>
                </div>

                {{-- Labels --}}
                <div class="bg-white border-[2.5px] border-black p-6">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-5 pb-2 border-b-2 border-black">Label</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($labels as $label)
                        <label class="flex items-center gap-2 border-2 border-black px-3 py-2 text-xs font-bold cursor-pointer has-[:checked]:bg-violet-100 transition-colors">
                            <input type="checkbox" name="labels[]" value="{{ $label->id }}"
                                    {{ in_array($label->id, old('labels', $task->labels->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="w-3.5 h-3.5 border-2 border-black accent-violet-600">
                            {{ $label->name }}
                        </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 font-semibold mt-3">Pilih satu atau lebih label</p>
                </div>

                {{-- DANGER ZONE --}}
                <div class="border-[2.5px] border-red-500 p-6 bg-white">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-2 text-red-600">⚠️ Danger Zone</h2>
                    <p class="text-xs text-gray-500 font-semibold mb-4">Hapus tugas ini secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                    <form action="{{ route('task.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus tugas ini? Tindakan tidak bisa dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 bg-white text-red-600 font-black border-[2.5px] border-red-500 shadow-[4px_4px_0_#dc2626] hover:shadow-[2px_2px_0_#dc2626] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm"
                                style="font-family: 'Syne', sans-serif;">
                            🗑️ Hapus Tugas Ini
                        </button>
                    </form>
                </div>

            </div>

            {{-- RIGHT: SIDEBAR --}}
            <div class="flex flex-col gap-5">

                {{-- Assign --}}
                <div class="bg-white border-[2.5px] border-black p-6">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-5 pb-2 border-b-2 border-black">Assign ke</h2>
                    <div class="relative">
                        <select name="assigned_to"
                                class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium bg-white outline-none appearance-none cursor-pointer focus:bg-yellow-50">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 font-black pointer-events-none">▾</span>
                    </div>
                </div>

                {{-- Info Tugas --}}
                <div class="bg-yellow-50 border-[2.5px] border-black p-6">
                    <h2 class="text-xs font-black tracking-widest uppercase mb-4 pb-2 border-b-2 border-black">Info Tugas</h2>
                    <div class="flex flex-col gap-3 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-semibold">Dibuat oleh</span>
                            <span class="font-black">{{ $task->creator->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-semibold">Dibuat pada</span>
                            <span class="font-black">{{ $task->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-300 pt-3">
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-semibold">Terakhir diubah</span>
                            <span class="font-black">{{ $task->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <button type="submit"
                        class="w-full py-4 bg-black text-yellow-300 font-black border-[2.5px] border-black shadow-[4px_4px_0_#7c3aed] hover:shadow-[2px_2px_0_#7c3aed] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm"
                        style="font-family: 'Syne', sans-serif;">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('task.index') }}"
                    class="block w-full py-3.5 bg-white text-black font-black border-[2.5px] border-black shadow-[4px_4px_0_#000] hover:shadow-[2px_2px_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm text-center mt-3"
                    style="font-family: 'Syne', sans-serif;">
                    Batal
                </a>

            </div>
        </div>
    </form>
</div>

@endsection
