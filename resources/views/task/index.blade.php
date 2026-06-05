@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-black" style="font-family: 'Syne', sans-serif;">
            📋 Kanban Board
        </h1>
        <a href="{{ route('task.create') }}"
            class="px-6 py-3 bg-violet-600 text-white font-black border-[2.5px] border-black shadow-[4px_4px_0_#000] hover:shadow-[2px_2px_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 transition-all text-sm"
            style="font-family: 'Syne', sans-serif;">
            + Tambah Tugas
        </a>
    </div>

    {{-- KANBAN COLUMNS --}}
    <div class="grid grid-cols-3 gap-5">

        {{-- TODO --}}
        <div class="border-[2.5px] border-black border-t-4 border-t-violet-600 bg-white">
            <div class="flex items-center justify-between px-4 py-3 border-b-2 border-black">
                <span class="text-xs font-black tracking-widest text-violet-600">📋 TODO</span>
                <span class="bg-black text-white text-xs w-6 h-6 flex items-center justify-center font-bold">
                    {{ isset($tasks['todo']) ? $tasks['todo']->count() : 0 }}
                </span>
            </div>
            <div class="p-3 flex flex-col gap-3 min-h-40">
                @foreach($tasks['todo'] ?? [] as $task)
                    @include('task.partials.card', ['task' => $task])
                @endforeach
            </div>
        </div>

        {{-- IN PROGRESS --}}
        <div class="border-[2.5px] border-black border-t-4 border-t-amber-400 bg-white">
            <div class="flex items-center justify-between px-4 py-3 border-b-2 border-black">
                <span class="text-xs font-black tracking-widest text-amber-600">⚡ IN PROGRESS</span>
                <span class="bg-black text-white text-xs w-6 h-6 flex items-center justify-center font-bold">
                    {{ isset($tasks['in_progress']) ? $tasks['in_progress']->count() : 0 }}
                </span>
            </div>
            <div class="p-3 flex flex-col gap-3 min-h-40">
                @foreach($tasks['in_progress'] ?? [] as $task)
                    @include('task.partials.card', ['task' => $task])
                @endforeach
            </div>
        </div>

        {{-- DONE --}}
        <div class="border-[2.5px] border-black border-t-4 border-t-emerald-500 bg-white">
            <div class="flex items-center justify-between px-4 py-3 border-b-2 border-black">
                <span class="text-xs font-black tracking-widest text-emerald-600">✅ DONE</span>
                <span class="bg-black text-white text-xs w-6 h-6 flex items-center justify-center font-bold">
                    {{ isset($tasks['done']) ? $tasks['done']->count() : 0 }}
                </span>
            </div>
            <div class="p-3 flex flex-col gap-3 min-h-40">
                @foreach($tasks['done'] ?? [] as $task)
                    @include('task.partials.card', ['task' => $task])
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
