<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- @json(auth()->user()) --}}
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="relative py-10">
        <h1 class="text-3xl font-semibold">Email Recipients</h1>
        <div class="relative flex py-10 w-full max-w-xl mx-auto justify-between items-center">
            <div class="relative">
                <p class="text-slate-500 font-semibold text-sm">Logged In Email</p>
                <div class="flex space-x-4 text-xs text-slate-500">
                    <span>{{ Auth::user()->email }}</span>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative">
                <p class="text-slate-500 font-semibold text-sm">Second Email Recipients</p>
                <div class="flex space-x-4 text-xs text-slate-500">
                    <span>{{ Auth::user()->email2 != null ? Auth::user()->email2 : '-------------------' }}</span>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative bg-zinc-100 p-14 rounded-xl">
            <h1 class="text-2xl font-semibold ">My IDs at a glance</h1>

            <div class="relative py-20">
                @foreach ($tags as $key => $tag)
                    <div class="relative flex justify-between items-center border-b border-slate-200">
                        <span class="uppercase px-5 w-36">{{ $tag->code ?? 'Unknown' }}</span>
                        <img class="w-36 h-auto" src="{{ public_url('img/fas_svg.svg') }}" alt="Found and Scan Logo"
                            class="faslogo_bare" />
                        <a href="#" class="w-20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="relative flex justify-end">
                <a href="#"
                    class="relative px-5 py-2 rounded-full bg-indigo-400 text-sm text-white font-semibold">
                    Add New ID
                </a>
            </div>

            <div class="relative flex justify-between items-center py-10">
                <span class="px-5 w-36 text-xs font-semibold">Valid nntil</span>
                <div class=" h-auto">
                    <span class="text-red-500 text-xs font-normal">
                        {{ date('F d,Y') }}(120days)
                    </span>
                </div>
                <a href="#"
                    class="relative px-4 py-1.5 rounded-full border border-indigo-400 text-sm text-indigo-500 font-semibold">
                    Reacharge
                </a>
            </div>

            <h1 class="text-2xl font-semibold ">History</h1>
            <div class="grid grid-cols-4 rounded-xl text-slate-500 font-medium text-sm bg-white mt-10">
                <div class="relative flex justify-center p-3">Data</div>
                <div class="relative flex justify-center p-3">ID</div>
                <div class="relative flex justify-center p-3">Message</div>
                <div class="relative flex justify-center p-3">Survey</div>
            </div>

            <div class="relative space-y-2">
                <div class="grid grid-cols-4 rounded-xl text-slate-500 font-normal text-xs">
                    <div class="relative flex justify-center p-3">{{ date('m.d.Y') }}</div>
                    <div class="relative flex justify-center p-3 text-slate-800 font-semibold">FDFD34343DK</div>
                    <div class="relative flex justify-center items-center p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mx-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                        Hooray Found!
                    </div>
                    <div class="relative flex justify-center p-3 text-emerald-500">Compleated</div>
                </div>
                <div class="grid grid-cols-4 rounded-xl text-slate-500 font-normal text-sm">
                    <div class="relative flex justify-center p-3">{{ date('m.d.Y') }}</div>
                    <div class="relative flex justify-center p-3 text-slate-800 font-semibold">FDFD34343DK</div>
                    <div class="relative flex justify-center items-center p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mx-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                        Hooray Found!
                    </div>
                    <div class="relative flex justify-center p-3">Survey</div>
                </div>
            </div>

            <div class="relative flex justify-center">
                <a href="#"
                    class="relative px-4 py-1.5 rounded-full border border-indigo-400 text-sm text-indigo-500 font-semibold">
                    See more...
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
