@extends('layouts.app')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
    @if (isset($download))
        <meta http-equiv="refresh" content="1; url={{ $download }}">
    @endif
@endsection

@php
    $errorInput = 'focus:border-red-500 focus:ring-red-500 sm:text-sm border-red-600';
    $input = 'focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border-indigo-600';
@endphp

@section('body')
    <main class="max-w-7xl mx-auto p-5">
        @error('updateUser')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $message }}
            </div>
        @enderror
        <div class="flex items-center justify-center lg:h-screen h-auto">
            <div>
                <div class="flex flex-col justify-center items-center space-y-2">
                    @if (isset($svg) && $svg != '' && $svg != null)
                        <a href="{{ $url }}" class="relative w-full flex justify-center items-center">
                            <img class="lg:w-[85%] w-[120%] lg:pl-0 pl-[11px] lg:-mr-52 mr-[-65px]"
                                src="data:image/svg+xml;base64, {{ $svg }}" />
                        </a>
                    @endif
                    <h1 class="lg:text-4xl md:text-xl text-sm text-center font-bold">{{ __('Vielen Dank ! / Thank You !') }}
                    </h1>
                    <p>{{ $message }}</p>
                    <div class="relative flex justify-center items-center">
                        @if (isset($link) && $link != '' && $link != null)
                            <a href="{{ $link }}"
                                class="inline-flex items-center mx-2 px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                                <span class="text-sm font-medium">
                                    {{ __('Zurück / Go Back') }}
                                </span>
                            </a>
                        @endif
                        <a href="{{ config('licensemanager.shop_url') }}"
                            class="inline-flex items-center mx-2 px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            <span class="text-sm font-medium">
                                {{ __('Shop') }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
