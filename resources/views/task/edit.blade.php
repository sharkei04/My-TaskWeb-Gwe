@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 px-4 py-2 text-sm font-bold transition-colors bg-white border-2 border-black hover:bg-black hover:text-white">
                ← Back To Board
            </a>
            <h1 class="text-3xl font-black" style="font-family: 'Syne', sans-serif;">Edit Task</h1>
            <span class="px-3 py-1 text-xs font-black bg-yellow-100 border-2 border-black">Edit Mode</span>
        </div>
        <span class="text-xs font-semibold text-gray-500">
            ID #{{ $task->id }} · Created {{ $task->created_at->format('d M Y') }}
        </span>
    </div>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-5 items-start justify-center">

        {{-- LEFT: MAIN FORM --}}
        <div class="flex flex-col gap-5">

            {{-- Task Information --}}
            <div class="bg-white border-[2.5px] border-black p-6">
                <h2 class="pb-2 mb-5 text-xs font-black tracking-widest uppercase border-b-2 border-black">
                    Task Information
                </h2>

                {{-- Title --}}
                <div class="mb-5">
                    <label class="block mb-2 text-xs font-black tracking-wide uppercase">
                        Task Title <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            placeholder="Example: Implement login authentication..."
                            class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    <label class="block mb-2 text-xs font-black tracking-wide uppercase">Description</label>
                    <textarea name="description" rows="4"
                                placeholder="Explain task details..."
                                class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none resize-y">{{ old('description', $task->description) }}</textarea>
                </div>

                {{-- STATUS BUTTON --}}
                <div>
                    <label class="block mb-2 text-xs font-black tracking-wide uppercase">Status <span class="text-red-600">*</span></label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-violet-100 has-[:checked]:border-violet-600">
                            <input type="radio" name="status" value="to_do" class="hidden"
                                {{ old('status', $task->status) === 'to_do' ? 'checked' : '' }}>
                            To Do
                        </label>
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500">
                            <input type="radio" name="status" value="in_progress" class="hidden"
                                {{ old('status', $task->status) === 'in_progress' ? 'checked' : '' }}>
                            In Progress
                        </label>
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-emerald-100 has-[:checked]:border-emerald-500">
                            <input type="radio" name="status" value="done" class="hidden"
                                {{ old('status', $task->status) === 'done' ? 'checked' : '' }}>
                            Done
                        </label>
                    </div>
                </div>
            </div>

            {{-- Priority & Deadline --}}
            <div class="bg-white border-[2.5px] border-black p-6">
                <h2 class="pb-2 mb-5 text-xs font-black tracking-widest uppercase border-b-2 border-black">
                    Priority & Deadline
                </h2>

                {{-- PRIORITY BUTTON --}}
                <div class="mb-5">
                    <label class="block mb-2 text-xs font-black tracking-wide uppercase">
                        Priority <span class="text-red-600">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-emerald-100 has-[:checked]:border-emerald-500">
                            <input type="radio" name="priority" value="low" class="hidden"
                                {{ old('priority', $task->priority) === 'low' ? 'checked' : '' }}>
                            Low
                        </label>
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500">
                            <input type="radio" name="priority" value="medium" class="hidden"
                                {{ old('priority', $task->priority) === 'medium' ? 'checked' : '' }}>
                            Medium
                        </label>
                        <label class="cursor-pointer border-2 border-black p-2.5 text-center text-xs font-black transition-colors has-[:checked]:bg-red-100 has-[:checked]:border-red-500">
                            <input type="radio" name="priority" value="high" class="hidden"
                                {{ old('priority', $task->priority) === 'high' ? 'checked' : '' }}>
                            High
                        </label>
                    </div>
                </div>

                {{-- Deadline --}}
                <div>
                    <label class="block mb-2 text-xs font-black tracking-wide uppercase">Deadline</label>
                    <input type="date" name="deadline"
                            value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}"
                            class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium focus:bg-yellow-50 outline-none cursor-pointer">
                    <p class="mt-1 text-xs font-semibold text-gray-500">Leave empty to remove deadline</p>
                </div>
            </div>

            {{-- DANGER ZONE --}}
            <div class="border-[2.5px] border-red-500 p-6 bg-white">
                <h2 class="mb-2 text-xs font-black tracking-widest text-red-600 uppercase">Danger Zone</h2>
                <p class="mb-4 text-xs font-semibold text-gray-500">Delete this task permanently. This action cannot be undone.</p>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-6 py-3 bg-white text-red-600 font-black border-[2.5px] border-red-500 shadow-[4px_4px_0_#dc2626] hover:shadow-[2px_2px_0_#dc2626] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm"
                            style="font-family: 'Syne', sans-serif;">
                        Delete This Task
                    </button>
                </form>
            </div>

        </div>

        {{-- RIGHT: SIDEBAR --}}
        <div class="flex flex-col gap-5">

            {{-- Assign --}}
            <div class="bg-white border-[2.5px] border-black p-6">
                <h2 class="pb-2 mb-5 text-xs font-black tracking-widest uppercase border-b-2 border-black">Assign To</h2>
                <div class="relative">
                    <select name="assigned_to"
                            class="w-full border-2 border-black px-3 py-2.5 text-sm font-medium bg-white outline-none appearance-none cursor-pointer focus:bg-yellow-50">
                        <option value="">-- Select Member --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="absolute font-black -translate-y-1/2 pointer-events-none right-3 top-1/2">▾</span>
                </div>
            </div>

            {{-- Task Info --}}
            <div class="bg-yellow-50 border-[2.5px] border-black p-6">
                <h2 class="pb-2 mb-4 text-xs font-black tracking-widest uppercase border-b-2 border-black">Task Info</h2>
                <div class="flex flex-col gap-3 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-gray-500">Created by</span>
                        <span class="font-black">{{ $task->creator->name ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-gray-500">Created on</span>
                        <span class="font-black">{{ $task->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="pt-3 border-t border-gray-300 border-dashed"></div>
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-gray-500">Last Updated</span>
                        <span class="font-black">{{ $task->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <button type="submit"
                    class="w-full py-4 bg-black text-yellow-300 font-black border-[2.5px] border-black shadow-[4px_4px_0_#7c3aed] hover:shadow-[2px_2px_0_#7c3aed] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm"
                    style="font-family: 'Syne', sans-serif;">
                Save Changes
            </button>
            <a href="{{ route('dashboard') }}"
                class="block w-full py-3.5 mt-3 bg-white text-black font-black border-[2.5px] border-black shadow-[4px_4px_0_#000] hover:shadow-[2px_2px_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm text-center"
                style="font-family: 'Syne', sans-serif;">
                Cancel
            </a>

        </div>
    </div>
</form>

</div>
@endsection