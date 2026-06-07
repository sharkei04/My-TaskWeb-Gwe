<div class="bg-gray-50 border-[1.5px] border-black p-3">

    {{-- Labels --}}
    @if($task->labels->count())
    <div class="flex flex-wrap gap-1 mb-2">
        @foreach($task->labels as $label)
        <span class="text-[10px] font-bold border-[1.5px] border-black px-2 py-0.5"
                style="background: {{ $label->color }}">
            {{ $label->name }}
        </span>
        @endforeach
    </div>
    @endif

    {{-- Title --}}
    <p class="mb-2 text-sm font-bold">{{ $task->title }}</p>

    {{-- Priority Badge --}}
    <div class="mb-2">
        @if($task->priority === 'high')
            <span class="text-[10px] font-black bg-red-100 border-[1.5px] border-black px-2 py-0.5">🔴 High</span>
        @elseif($task->priority === 'medium')
            <span class="text-[10px] font-black bg-amber-100 border-[1.5px] border-black px-2 py-0.5">🟡 Medium</span>
        @else
            <span class="text-[10px] font-black bg-emerald-100 border-[1.5px] border-black px-2 py-0.5">🟢 Low</span>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-between mt-2">
        <span class="text-[10px] text-gray-500 font-semibold">
            @if($task->deadline)
                📅 {{ $task->deadline->format('d M') }}
            @else
                Tanpa deadline
            @endif
        </span>
        <a href="{{ route('tasks.edit', $task) }}"
            class="text-[10px] font-black border-[1.5px] border-black px-2 py-0.5 bg-white hover:bg-black hover:text-white transition-colors">
            Edit
        </a>
    </div>

</div>
