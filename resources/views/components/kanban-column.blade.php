@props([
    'title' => 'Column',
    'count' => 0,
    'status' => 'todo',
    'headerClass' => 'bg-gray-100',
])

<section class="flex min-h-[62vh] flex-col rounded-[0.8vw] border border-black bg-white shadow-[0.35vw_0.35vw_0_#000]">
    <header class="flex items-center justify-between rounded-t-[0.8vw] border-b border-black px-[1.2vw] py-[1vh] {{ $headerClass }}">
        <div class="flex items-center gap-[0.7vw]">
            <h3 class="text-[1.25vw] font-bold leading-tight tracking-tight text-gray-900">
                {{ $title }}
            </h3>

            <span class="flex h-[4vh] min-w-[2.4vw] items-center justify-center rounded-[0.4vw] border border-black bg-white px-[0.5vw] text-[0.95vw] font-semibold leading-none">
                {{ $count }}
            </span>
        </div>

        <button
            type="button"
            class="rounded-[0.4vw] px-[0.5vw] py-[0.5vh] text-[1.2vw] font-semibold leading-none text-gray-700 hover:bg-white/60 hover:text-black"
            aria-label="Column menu"
        >
            ...
        </button>
    </header>

    <div class="flex flex-1 flex-col gap-[1vh] p-[1.2vw]">
        <a
            href="{{ route('tasks.create', ['status' => $status]) }}"
            class="flex h-[7vh] items-center justify-center rounded-[0.6vw] border border-dashed border-black text-[1vw] font-medium tracking-wide text-gray-600 transition hover:bg-gray-50 hover:text-black"
        >
            + Add Task
        </a>

        {{ $slot }}
    </div>
</section>