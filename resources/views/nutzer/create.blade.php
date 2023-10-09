@extends('layouts.app')

@section('head')
    <title> {{__('Nutzer anlegen')}} | {{ config('app.name', 'Laravel') }}</title>
@endsection

@php
    $errorInput = 'focus:border-red-500 focus:ring-red-500 sm:text-sm border-red-600';
    $input = 'focus:border-primary-500 focus:ring-primary-500 sm:text-sm border-primary-600';
@endphp

@section('body')
    <main class="max-w-7xl w-full p-5  mx-auto">

        @error('updateUser')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{__('Oops!')}}</span> {{ $message }}
            </div>
        @enderror

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert">
                <span class="font-medium">{{__('Erfolg')}}</span> {{ Session::get('success') }}
            </div>
        @endif

        <div class="mt-10 sm:mt-0">
            <div class="relative">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="{{ route('nutzer.store') }}" method="POST">
                        @csrf
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    {{-- name --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            placeholder="Name" autocomplete="name"
                                            class="@error('name') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- email --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            placeholder="email" autocomplete="email"
                                            class="@error('email') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- email 2 --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email2" class="block text-sm font-medium text-gray-700">Email
                                            2</label>
                                        <input type="email" id="email2" name="email2" value="{{ old('email2') }}"
                                            placeholder="email2" autocomplete="email2"
                                            class="@error('email2') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('email2')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>


                                    {{-- type --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                        <select id="type" name="type" autocomplete="type"
                                            class="@error('type') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            <option value="user" selected>{{__('User')}}</option>
                                            <option value="admin">{{__('Admin')}}</option>
                                        </select>

                                    </div>

                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">{{__('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>
@endsection
