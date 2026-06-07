@extends('layouts.app')
@section('content')

<div class="flex min-h-[92vh] flex-col bg-white text-gray-900">
    <section class="px-[4vw] py-[5vh]">

        <!-- Header -->
        <div class="mb-[5vh] flex flex-col gap-[3vh] xl:flex-row xl:items-end xl:justify-between">
            <div>
                <h2 class="text-[5vh] font-black leading-tight tracking-tight text-black sm:text-[6vh]">
                    Overview
                </h2>
                <p class="mt-[1vh] text-[2vh] font-semibold leading-normal tracking-wide text-gray-500">
                    Here is what's happening with your projects today.
                </p>
            </div>

            <div class="flex flex-col gap-[2vh] sm:flex-row sm:items-center">
                <div class="border border-white px-4 py-2">
                    <form action="#" method="GET" class="inline">
                        <input
                            type="{{ request('date') ? 'date' : 'text' }}"
                            name="date"
                            value="{{ request('date') }}"
                            placeholder="This Month"
                            onfocus="(this.type='date')"
                            onblur="if(!this.value) this.type='text'"
                            onchange="this.form.submit()"
                            class="h-[5.8vh] w-full max-w-[200px] rounded-[0.8vw] border border-black bg-white px-[4vw] text-[1.8vh] font-bold text-gray-700 shadow-[0.3vw_0.3vw_0_#000] outline-none lg:px-[1.2vw]"
                        >
                    </form>
                </div>
                <a href="{{ route('exportdata') }}" class="flex h-[5.8vh] w-full items-center justify-center gap-2 rounded-[0.8vw] border border-black bg-blue-600 px-[4vw] text-[1.8vh] font-bold text-white shadow-[0.3vw_0.3vw_0_#000] transition hover:translate-x-[0.15vw] hover:translate-y-[0.15vh] hover:shadow-none sm:w-auto lg:px-[1.5vw]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span>Export Data</span>
                </a>
            </div>
        </div>

        <!-- ── STAT CARDS ── -->
        <div class="grid grid-cols-1 gap-[3vh] sm:grid-cols-2 lg:grid-cols-4">

            <!-- Total Tasks -->
            <div class="flex flex-col justify-between rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] min-h-[160px]">
                <div class="flex items-center justify-between">
                    <span class="text-[1.6vh] font-black tracking-wide text-gray-800 uppercase">Total Tasks</span>
                    <div class="flex h-6 w-6 items-center justify-center rounded-full border-2 border-black bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <h1 class="text-[4.5vh] font-black text-black leading-none tracking-tight">1,284</h1>
                    <div class="inline-flex items-center gap-1 mt-2 px-2 py-0.5 bg-yellow-200 border border-black font-bold text-[1.4vh] text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>
                        <span>+12% vs last month</span>
                    </div>
                </div>
            </div>

            <!-- Active Projects -->
            <div class="flex flex-col justify-between rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] min-h-[160px]">
                <div class="flex items-center justify-between">
                    <span class="text-[1.6vh] font-black tracking-wide text-gray-800 uppercase">Active Projects</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.6-5.84a14.954 14.954 0 0 1 5.84-2.58m1.76 11.16a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <div class="mt-2">
                    <h1 class="text-[4.5vh] font-black text-black leading-none tracking-tight">42</h1>
                    <p class="mt-2 text-[1.5vh] font-bold text-gray-600">8 launching this week</p>
                </div>
            </div>

            <!-- Team Efficiency -->
            <div class="flex flex-col justify-between rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] min-h-[160px]">
                <div class="flex items-center justify-between">
                    <span class="text-[1.6vh] font-black tracking-wide text-gray-800 uppercase">Team Efficiency</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </div>
                <div class="mt-2">
                    <h1 class="text-[4.5vh] font-black text-black leading-none tracking-tight">94.2%</h1>
                    <div class="w-full h-3 bg-gray-100 border-2 border-black mt-3 overflow-hidden">
                        <div class="bg-yellow-300 h-full border-r border-black" style="width: 94.2%"></div>
                    </div>
                </div>
            </div>

            <!-- Overdue Tasks -->
            <div class="flex flex-col justify-between rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] min-h-[160px]">
                <div class="flex items-center justify-between">
                    <span class="text-[1.6vh] font-black tracking-wide text-gray-800 uppercase">Overdue Tasks</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-red-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="mt-2">
                    <h1 class="text-[4.5vh] font-black text-black leading-none tracking-tight">07</h1>
                    <p class="inline-flex items-center gap-1 mt-2 text-[1.5vh] font-black text-red-700">
                        <span>!</span> Requires Attention
                    </p>
                </div>
            </div>

        </div>

        <!-- ── ROW 2: Task Status + Recent Activity ── -->
        <div class="mt-[4vh] grid grid-cols-1 gap-[2vw] lg:grid-cols-3">

            <!-- Task Status Breakdown -->
            <div class="rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="mb-[3vh] text-[2vh] font-black uppercase tracking-wide text-black">Task Status</h3>

                <div class="space-y-[2.5vh]">
                    <!-- To Do -->
                    <div>
                        <div class="mb-1 flex items-center justify-between">
                            <span class="text-[1.6vh] font-bold text-gray-700">To Do</span>
                            <span class="text-[1.6vh] font-black text-black">384</span>
                        </div>
                        <div class="h-4 w-full overflow-hidden border-2 border-black bg-gray-100">
                            <div class="h-full bg-gray-400" style="width: 30%"></div>
                        </div>
                        <p class="mt-1 text-[1.3vh] font-semibold text-gray-400">30% of total</p>
                    </div>

                    <!-- In Progress -->
                    <div>
                        <div class="mb-1 flex items-center justify-between">
                            <span class="text-[1.6vh] font-bold text-gray-700">In Progress</span>
                            <span class="text-[1.6vh] font-black text-black">513</span>
                        </div>
                        <div class="h-4 w-full overflow-hidden border-2 border-black bg-gray-100">
                            <div class="h-full bg-yellow-300" style="width: 40%"></div>
                        </div>
                        <p class="mt-1 text-[1.3vh] font-semibold text-gray-400">40% of total</p>
                    </div>

                    <!-- Done -->
                    <div>
                        <div class="mb-1 flex items-center justify-between">
                            <span class="text-[1.6vh] font-bold text-gray-700">Done</span>
                            <span class="text-[1.6vh] font-black text-black">387</span>
                        </div>
                        <div class="h-4 w-full overflow-hidden border-2 border-black bg-gray-100">
                            <div class="h-full bg-green-400" style="width: 30%"></div>
                        </div>
                        <p class="mt-1 text-[1.3vh] font-semibold text-gray-400">30% of total</p>
                    </div>
                </div>

                <!-- Legend -->
                <div class="mt-[3vh] flex flex-wrap gap-3 border-t-2 border-black pt-[2vh]">
                    <span class="flex items-center gap-1 text-[1.4vh] font-bold"><span class="inline-block h-3 w-3 border border-black bg-gray-400"></span>To Do</span>
                    <span class="flex items-center gap-1 text-[1.4vh] font-bold"><span class="inline-block h-3 w-3 border border-black bg-yellow-300"></span>In Progress</span>
                    <span class="flex items-center gap-1 text-[1.4vh] font-bold"><span class="inline-block h-3 w-3 border border-black bg-green-400"></span>Done</span>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="lg:col-span-2 rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                <div class="mb-[3vh] flex items-center justify-between">
                    <h3 class="text-[2vh] font-black uppercase tracking-wide text-black">Recent Activity</h3>
                    <span class="rounded border border-black bg-yellow-300 px-3 py-1 text-[1.4vh] font-black">Live</span>
                </div>

                <div class="space-y-0 divide-y-2 divide-black">
                    @php
                        $activities = [
                            ['user' => 'Kaiju',   'action' => 'completed task',     'target' => 'Design Landing Page',      'time' => '2 min ago',  'color' => 'bg-green-400'],
                            ['user' => 'Faris',   'action' => 'created new task',   'target' => 'API Integration Sprint',   'time' => '15 min ago', 'color' => 'bg-blue-400'],
                            ['user' => 'Rena',    'action' => 'moved to In Progress','target' => 'Database Optimization',   'time' => '1 hr ago',   'color' => 'bg-yellow-300'],
                            ['user' => 'Dimas',   'action' => 'commented on',       'target' => 'User Auth Module',         'time' => '2 hr ago',   'color' => 'bg-indigo-300'],
                            ['user' => 'Kaiju',   'action' => 'marked overdue',     'target' => 'Payment Gateway Setup',    'time' => '3 hr ago',   'color' => 'bg-red-400'],
                            ['user' => 'Faris',   'action' => 'completed task',     'target' => 'Mobile Responsive Fix',    'time' => '5 hr ago',   'color' => 'bg-green-400'],
                        ];
                    @endphp

                    @foreach ($activities as $act)
                    <div class="flex items-center gap-[1vw] py-[1.5vh]">
                        {{-- Avatar --}}
                        <div class="flex h-[4.5vh] w-[4.5vh] shrink-0 items-center justify-center rounded-full border-2 border-black {{ $act['color'] }} text-[1.5vh] font-black text-black">
                            {{ strtoupper(substr($act['user'], 0, 1)) }}
                        </div>
                        {{-- Text --}}
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[1.6vh] font-bold text-black">
                                <span class="font-black">{{ $act['user'] }}</span>
                                <span class="font-semibold text-gray-500"> {{ $act['action'] }} </span>
                                <span class="font-black">{{ $act['target'] }}</span>
                            </p>
                        </div>
                        {{-- Time --}}
                        <span class="shrink-0 text-[1.3vh] font-semibold text-gray-400">{{ $act['time'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── ROW 3: Members Table + Quick Actions ── -->
        <div class="mt-[4vh] grid grid-cols-1 gap-[2vw] lg:grid-cols-3">

            <!-- Quick Actions -->
            <div class="rounded-[0.8vw] border-[3px] border-black bg-indigo-50 p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="mb-[3vh] text-[2vh] font-black uppercase tracking-wide text-black">Quick Actions</h3>

                <div class="flex flex-col gap-[1.5vh]">

                    <a href="{{ route('members.index') }}"
                        class="flex items-center gap-3 rounded-[0.6vw] border-2 border-black bg-white px-4 py-3 text-[1.6vh] font-black text-black shadow-[4px_4px_0_#000] transition hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Manage Members
                    </a>

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-[0.6vw] border-2 border-black bg-white px-4 py-3 text-[1.6vh] font-black text-black shadow-[4px_4px_0_#000] transition hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        View Board
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-[0.6vw] border-2 border-black bg-white px-4 py-3 text-[1.6vh] font-black text-black shadow-[4px_4px_0_#000] transition hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Members Overview -->
            <div class="lg:col-span-2 rounded-[0.8vw] border-[3px] border-black bg-white p-[1.5vw] shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                <div class="mb-[3vh] flex items-center justify-between">
                    <h3 class="text-[2vh] font-black uppercase tracking-wide text-black">Team Members</h3>
                    <a href="{{ route('members.index') }}" class="text-[1.5vh] font-black text-blue-600 underline hover:text-blue-800">View All →</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-[1.5vh]">
                        <thead>
                            <tr class="border-b-2 border-black bg-gray-50">
                                <th class="py-[1.5vh] pr-4 text-left font-black uppercase tracking-wide text-gray-600">Member</th>
                                <th class="py-[1.5vh] pr-4 text-left font-black uppercase tracking-wide text-gray-600">Username</th>
                                <th class="py-[1.5vh] pr-4 text-center font-black uppercase tracking-wide text-gray-600">Tasks Done</th>
                                <th class="py-[1.5vh] text-center font-black uppercase tracking-wide text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php
                                $teamData = [
                                    ['name' => 'Gvn',    'username' => '@atar',   'done' => 5, 'active' => true,  'color' => 'bg-yellow-300'],
                                    ['name' => 'Kaiju',  'username' => '@faa',    'done' => 3, 'active' => true,  'color' => 'bg-blue-300'],
                                    ['name' => 'Rena',   'username' => '@rena',   'done' => 3, 'active' => true,  'color' => 'bg-green-300'],
                                    ['name' => 'Dimas',  'username' => '@dimas',  'done' => 2, 'active' => false, 'color' => 'bg-indigo-300'],
                                    ['name' => 'Sinta',  'username' => '@sinta',  'done' => 9, 'active' => true,  'color' => 'bg-pink-300'],
                                ];
                            @endphp
                            @foreach ($teamData as $member)
                            <tr class="hover:bg-gray-50">
                                <td class="py-[1.5vh] pr-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-[3.8vh] w-[3.8vh] shrink-0 items-center justify-center rounded-full border-2 border-black {{ $member['color'] }} text-[1.4vh] font-black">
                                            {{ strtoupper(substr($member['name'], 0, 1)) }}
                                        </div>
                                        <span class="font-bold text-black">{{ $member['name'] }}</span>
                                    </div>
                                </td>
                                <td class="py-[1.5vh] pr-4 font-semibold text-gray-500">{{ $member['username'] }}</td>
                                <td class="py-[1.5vh] pr-4 text-center">
                                    <span class="inline-block rounded border border-black bg-green-100 px-2 py-0.5 font-black text-black">{{ $member['done'] }}</span>
                                </td>
                                <td class="py-[1.5vh] text-center">
                                    @if ($member['active'])
                                        <span class="inline-flex items-center gap-1 rounded border border-black bg-green-400 px-2 py-0.5 text-[1.3vh] font-black text-black">
                                            <span class="h-1.5 w-1.5 rounded-full bg-black"></span> Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded border border-black bg-gray-200 px-2 py-0.5 text-[1.3vh] font-black text-gray-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span> Away
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection
