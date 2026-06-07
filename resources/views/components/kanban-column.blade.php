@props([
    'title' => 'Column',
    'count' => 0,
    'status' => 'to do',
    'headerClass' => 'bg-gray-100',
])

<section
    data-column-status="{{ $status }}"
    class="group flex min-h-80 flex-col rounded-xl border border-black bg-white shadow-[6px_6px_0_#000] transition duration-300 hover:-translate-y-1 hover:shadow-[10px_10px_0_#000]"
>
    <header class="{{ $headerClass }} flex items-center justify-between rounded-t-xl border-b border-black px-4 py-3">
        <div class="flex items-center gap-3">
            <h3 class="text-lg font-black leading-tight tracking-tight text-black">
                {{ $title }}
            </h3>

            <span class="count-badge flex h-8 min-w-10 items-center justify-center rounded-md border border-black bg-white px-3 text-sm font-bold leading-none text-black">
                {{ $count }}
            </span>
        </div>

        <button
            type="button"
            class="rounded-md px-2 py-1 text-lg font-black leading-none text-gray-700 transition hover:bg-white/70 hover:text-black"
            aria-label="Column menu"
        >
            ...
        </button>
    </header>

    <div class="flex flex-1 flex-col gap-3 p-4">
        <a
            href="{{ route('tasks.create', ['status' => $status]) }}"
            class="flex h-12 items-center justify-center rounded-lg border border-dashed border-black bg-white text-base font-semibold tracking-wide text-gray-600 transition hover:-translate-y-0.5 hover:bg-yellow-100 hover:text-black hover:shadow-[4px_4px_0_#000]"
        >
            + Add Task
        </a>

        {{ $slot }}
    </div>
</section>