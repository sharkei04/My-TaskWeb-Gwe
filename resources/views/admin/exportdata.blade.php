@extends('layouts.app')
@section('content')

<div class="flex min-h-[92vh] flex-col bg-white text-gray-900">
    <section class="px-[4vw] py-[5vh]">
        <div class="mb-[4vh] flex flex-col gap-[3vh] xl:flex-row xl:items-end xl:justify-between">
            <div>
                <h2 class="text-[5vh] font-black leading-tight tracking-tight text-black sm:text-[6vh]">
                    Export Data
                </h2>

                <p class="mt-[1vh] text-[2vh] font-semibold leading-normal tracking-wide text-gray-500">
                    Select the data modules and date range you wish to export to your preferred
                    format. All exports are logged for auditing purposes.
                </p>
            </div>
        </div>

        <h2 class="mb-[2vh] text-[3vh] font-black leading-tight tracking-tight text-black">
            Data Modules
        </h2>

        <div class="mb-[4vh] flex flex-col xl:flex-row gap-8">

            <!-- LEFT SIDE -->
            <div class="flex-1">
                <div class="grid grid-cols-2 gap-4">

                    <!-- Card 1 -->
                    <div class="card bg-white flex min-h-[11rem] flex-col gap-3 rounded border-2 border-black p-5 shadow-[4px_4px_0px_#000] transition-colors duration-150 hover:bg-yellow-100">
                        <div class="flex items-start justify-between">
                            <i class="ti ti-clipboard-list text-3xl text-black"></i>

                            <div onclick="toggleCheck(this)"
                                class="check-box flex h-7 w-7 cursor-pointer items-center justify-center rounded-sm border-2 border-black bg-white">
                                <i class="ti ti-check check-icon text-lg font-bold text-black hidden"></i>
                            </div>
                        </div>

                        <p class="text-base font-bold text-black">Tasks & Projects</p>
                        <p class="text-sm leading-relaxed text-gray-700">
                            Active tasks, milestones, and project timelines.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="card bg-white flex min-h-[11rem] flex-col gap-3 rounded border-2 border-black p-5 shadow-[4px_4px_0px_#000] transition-colors duration-150 hover:bg-yellow-100">
                        <div class="flex items-start justify-between">
                            <i class="ti ti-trending-up text-3xl text-black"></i>

                            <div onclick="toggleCheck(this)"
                                class="check-box flex h-7 w-7 cursor-pointer items-center justify-center rounded-sm border-2 border-black bg-white">
                                <i class="ti ti-check check-icon text-lg font-bold text-black hidden"></i>
                            </div>
                        </div>

                        <p class="text-base font-bold text-black">Team Performance</p>
                        <p class="text-sm leading-relaxed text-gray-500">
                            KPIs, velocity charts, and individual member metrics.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="card bg-white flex min-h-[11rem] flex-col gap-3 rounded border-2 border-black p-5 shadow-[4px_4px_0px_#000] transition-colors duration-150 hover:bg-yellow-100">
                        <div class="flex items-start justify-between">
                            <i class="ti ti-cash text-3xl text-black"></i>

                            <div onclick="toggleCheck(this)"
                                class="check-box flex h-7 w-7 cursor-pointer items-center justify-center rounded-sm border-2 border-black bg-white">
                                <i class="ti ti-check check-icon text-lg font-bold text-black hidden"></i>
                            </div>
                        </div>

                        <p class="text-base font-bold text-black">Financial Reports (MRR/Revenue)</p>
                        <p class="text-sm leading-relaxed text-gray-500">
                            Subscription billing data, revenue growth, and churn.
                        </p>
                    </div>

                    <!-- Card 4 -->
                    <div class="card bg-white flex min-h-[11rem] flex-col gap-3 rounded border-2 border-black p-5 shadow-[4px_4px_0px_#000] transition-colors duration-150 hover:bg-yellow-100">
                        <div class="flex items-start justify-between">
                            <i class="ti ti-terminal-2 text-3xl text-black"></i>

                            <div onclick="toggleCheck(this)"
                                class="check-box flex h-7 w-7 cursor-pointer items-center justify-center rounded-sm border-2 border-black bg-white">
                                <i class="ti ti-check check-icon text-lg font-bold text-black hidden"></i>
                            </div>
                        </div>

                        <p class="text-base font-bold text-black">System Logs</p>
                        <p class="text-sm leading-relaxed text-gray-500">
                            Security events, user access logs, and error trails.
                        </p>
                    </div>

                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="w-full xl:w-[325px]">

                <div class="border-2 border-black bg-gray-100 p-6 shadow-[6px_6px_0px_#000]">

                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-bold text-black">
                            File Format
                        </h3>

                        <div class="flex flex-col gap-3">
                            <button onclick="selectFormat(this)"
                                class="format-btn border-2 border-black bg-yellow-400 py-4 text-lg font-medium shadow-[3px_3px_0px_#000]">
                                CSV
                            </button>

                            <button onclick="selectFormat(this)"
                                class="format-btn border-2 border-black bg-white py-4 text-lg font-medium hover:bg-yellow-100">
                                PDF
                            </button>

                            <button onclick="selectFormat(this)"
                                class="format-btn border-2 border-black bg-white py-4 text-lg font-medium hover:bg-yellow-100">
                                JSON
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-bold text-black">
                            Date Range
                        </h3>

                        <select class="w-full border-2 border-black bg-white px-4 py-4 text-lg outline-none">
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>Last 3 Months</option>
                            <option>This Year</option>
                            <option>All Time</option>
                        </select>
                    </div>

                    <a href="#" class="flex h-14 w-full items-center justify-center gap-2 border-2 border-black bg-yellow-400 font-bold shadow-[4px_4px_0px_#000] hover:bg-yellow-300">
                        <i class="ti ti-download"></i>
                        <span>Download Export</span>
                    </a>

                </div>
            </div>
        </div>
    </section>

    <footer
        class="mt-auto flex h-[7vh] items-center justify-center border-t border-black bg-white text-[1.7vh] font-semibold tracking-wide text-gray-500">
        © 2026 Taskora. All rights reserved.
    </footer>
</div>

<script>
    function toggleCheck(box) {
        const card = box.closest('.card');
        const icon = box.querySelector('.check-icon');
        const isChecked = card.classList.contains('checked');

        if (isChecked) {
            card.classList.remove('checked', 'bg-yellow-400', 'hover:bg-yellow-300');
            card.classList.add('bg-white', 'hover:bg-yellow-100');

            box.classList.remove('bg-yellow-400');
            box.classList.add('bg-white');

            icon.classList.add('hidden');
        } else {
            card.classList.add('checked', 'bg-yellow-400', 'hover:bg-yellow-300');
            card.classList.remove('bg-white', 'hover:bg-yellow-100');

            box.classList.remove('bg-white');
            box.classList.add('bg-white');

            icon.classList.remove('hidden');
        }
    }
    function selectFormat(button) {
        document.querySelectorAll('.format-btn').forEach(btn => {
            btn.classList.remove(
                'bg-yellow-400',
                'shadow-[3px_3px_0px_#000]'
            );

            btn.classList.add('bg-white');
        });

        button.classList.remove('bg-white');
        button.classList.add(
            'bg-yellow-400',
            'shadow-[3px_3px_0px_#000]'
        );
    }
</script>

@endsection