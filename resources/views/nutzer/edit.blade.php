@extends('layouts.app')

@section('head')
    <title>Nutzer bearbeiten | {{ config('app.name', 'Laravel') }}</title>
@endsection


@php
    $errorInput = 'focus:border-red-500 focus:ring-red-500 sm:text-sm border-red-600';
    $input = 'focus:border-primary-500 focus:ring-1 focus:ring-primary-500  sm:text-sm border-primary-600';
@endphp


@section('body')
    <main class="max-w-7xl w-full p-5  mx-auto">
        {{-- <form>
            <div class="grid gap-6 mb-6 md:grid-cols-2 ">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First name</label>
                    <input type="text" id="name" value="{{ $user->name ? $user->name : old("name") }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-5 py-4 " placeholder="John" required="">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <input type="email" id="email" value="{{ $user->email ? $user->email : old("email") }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-5 py-4 " placeholder="Emails" required="">
                </div>
                <div>
                    <label for="email2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email v2</label>
                    <input type="email2" id="email2" value="{{ $user->email ? $user->email : old("email2") }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-5 py-4 " placeholder="Emails" required="">
                </div>
            </div>
            <button type="submit" class="text-slate-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center block">Submit</button>
        </form>
         --}}

        <div class="mt-10 sm:mt-0">
            <div class="relative">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="{{ route('nutzer.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    {{-- name --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">{{__('Name')}}</label>
                                        <input type="text" id="name" name="name"
                                            value="{{ $user->name ? $user->name : old('name') }}" placeholder="Name"
                                            autocomplete="name"
                                            class="@error('name') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- email --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">{{__('Email')}}</label>
                                        <input type="email" id="email" name="email"
                                            value="{{ $user->email ? $user->email : old('email') }}" placeholder="email"
                                            autocomplete="email"
                                            class="@error('email') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('email')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>


                                    {{-- email 2 --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email2" class="block text-sm font-medium text-gray-700">{{__('Email')}}
                                            2</label>
                                        <input type="email" id="email2" name="email2"
                                            value="{{ $user->email2 ? $user->email2 : old('email2') }}"
                                            placeholder="email2"
                                            autocomplete="email2"class="@error('email2') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('email2')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- type --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="type" class="block text-sm font-medium text-gray-700">{{__('Type')}}</label>
                                        <select id="type" name="type" autocomplete="type"
                                            class="mt-1 block w-full rounded-md border-2 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm px-4 py-3 border-primary-600">
                                            @if ($user->isAdmin())
                                                <option value="user">{{__('User')}}</option>
                                                <option value="admin" selected>{{__('Admin')}}</option>
                                            @else
                                                <option value="user" selected>{{__('User')}}</option>
                                                <option value="admin">{{__('Admin')}}</option>
                                            @endif
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="bg-primary-600 px-4 py-3 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{__('Aktualisieren')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
