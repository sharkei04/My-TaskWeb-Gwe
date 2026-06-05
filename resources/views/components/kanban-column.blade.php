@props([
    'title' => 'Column',
    'count' => 0,
    'status' => 'to do',
    'headerClass' => 'bg-gray-100',
])

<section
    class="group flex min-h-[32vh] flex-col rounded-[1vw] border border-black bg-white shadow-[0.35vw_0.35vw_0_#000] transition duration-200 hover:-translate-x-[0.2vw] hover:-translate-y-[0.2vh] hover:shadow-[0.6vw_0.6vw_0_#000]"
>
    <header class="{{ $headerClass }} flex items-center justify-between rounded-t-[1vw] border-b border-black px-[1.3vw] py-[1.2vh]">
        <div class="flex items-center gap-[0.8vw]">
            <h3 class="text-[2.2vh] font-black leading-tight tracking-tight text-black">
                {{ $title }}
            </h3>

            <span class="flex h-[3.6vh] min-w-[2.4vw] items-center justify-center rounded-[0.4vw] border border-black bg-white px-[0.8vw] text-[1.7vh] font-bold leading-none text-black">
                {{ $count }}
            </span>
        </div>

        <button
            type="button"
            class="rounded-[0.4vw] px-[0.6vw] py-[0.5vh] text-[2vh] font-black leading-none text-gray-700 transition hover:bg-white/70 hover:text-black"
            aria-label="Column menu"
        >
            ...
        </button>
    </header>

    <div class="flex flex-1 flex-col gap-[1.2vh] p-[1.3vw]">
        <a
            href="{{ route('tasks.create', ['status' => $status]) }}"
            class="flex h-[5.5vh] items-center justify-center rounded-[0.7vw] border border-dashed border-black bg-white text-[2vh] font-semibold tracking-wide text-gray-600 transition hover:-translate-x-[0.1vw] hover:-translate-y-[0.1vh] hover:bg-yellow-100 hover:text-black hover:shadow-[0.25vw_0.25vw_0_#000]"
        >
            + Add Task
        </a>

        {{ $slot }}
    </div>
</section>