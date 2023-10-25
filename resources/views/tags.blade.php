@extends('layouts.app')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="relative flex justify-end">
                <a href="#" class="relative px-5 py-2 rounded-full bg-indigo-400 text-sm text-white font-semibold">
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
    <main class="max-w-7xl mx-auto p-5 hidden">
        @error('updateUser')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $message }}
            </div>
        @enderror

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $errors->first() }}
            </div>
        @endif

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg " role="alert">
                <span class="font-medium">{{ __('Erfolg') }}</span> {{ Session::get('success') }}
            </div>
        @endif

        <div class="relative p-4 mb-4 flex justify-end">
            <a href="{{ route('tags.new', 'new') }}"
                class="font-medium text-black bg-sichtungen px-3 py-1 rounded-full hover:underline">{{ __('Add New') }}</a>
        </div>

        {{-- <h1>{{ __('backend.tags.headlines.tags') }}</h1>
        <a href="./">{{ __('backend.back') }}</a><br />
        <a href="./tags/new">{{ __('backend.add') }}<i class="fas-solid fa-plus"></i></a>
        <ul>
            @foreach ($tags as $tag)
                <li>{{ __('backend.tags.code') }} {{ $tag['code'] }} Client {{ $tag['client']->name }} <a
                        href="./tags/{{ $tag->id }}">{{ __('backend.edit') }}</a>|<a
                        href="./tags/delete/{{ $tag->id }}">{{ __('backend.delete') }}</a>
                    @if (count($tag->user) > 0)
                        <br />
                        Users:
                        <ul>
                            @foreach ($tag->user as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (count($tag->sightings) > 0)
                        <br />Sightings:
                        <ul>
                            @foreach ($tag->sightings as $sighting)
                                <li>{{ $sighting->message }} {{ $sighting->contact }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul> --}}
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs border-b-2 navigation text-white bg-header ">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                {{ __('#') }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z">
                                    </path>
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('FAS-ID: Beschreibung') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Von') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Bis') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Aktion') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        @if (true)
                            <tr class="bg-white border-b ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $tag->id }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $tag->code }}: {{ !empty($tag->name) ? ucfirst($tag->name) : '-' }}
                                </td>
                                <td class="py-4 px-6">
                                    {{-- {{ $tag->created_at->format('d.m.Y') }} --}}
                                    {{ $tag->activated != null ? date('d.m.Y', strtotime($tag->activated)) : 'Unknown' }}
                                </td>
                                <td class="py-4 px-6">
                                    {{-- {{ $tag->updated_at->format('d.m.Y') }} --}}
                                    {{ $tag->valid_until != null ? date('d.m.Y', strtotime($tag->valid_until)) : 'Unknown' }}
                                </td>
                                <td class="py-4 px-6 flex ">
                                    <a href="{{ route('tags.new', $tag->id) }}"
                                        class="relative flex space-x-3 items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    @if (true)
                                        <form action="{{ route('tags.delete', $tag->id) }}" method="get"
                                            class="relative flex space-x-3 items-center font-medium text-red-600 dark:text-red-500 hover:underline">
                                            @csrf
                                            <button type="submit">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <div class="relative flex justify-center items-center ml-3">
                                        @if ($tag->status == 'active')
                                            <div class="h-5 w-5 bg-green-400 rounded-full"></div>
                                        @else
                                            <div class="h-5 w-5 bg-red-400 rounded-full"></div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
