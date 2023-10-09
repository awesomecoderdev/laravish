@extends('layouts.app')

@section('head')
    <title> {{ $user->name }} - {{__('Nutzer')}} | {{ config('app.name', 'Laravel') }}</title>
@endsection


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
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                {{-- name --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">{{__("Name")}}</label>
                                    <input type="text" disabled id="name" name="name"
                                        value="{{ $user->name ? $user->name : old('name') }}" placeholder="Name"
                                        autocomplete="name"
                                        class="mt-1 block w-full rounded-md border-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border-indigo-600">
                                </div>

                                {{-- email --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">{{__("Email")}}</label>
                                    <input type="email" disabled id="email" name="email"
                                        value="{{ $user->email ? $user->email : old('email') }}" placeholder="email"
                                        autocomplete="email"
                                        class="mt-1 block w-full rounded-md border-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border-indigo-600">
                                </div>

                                {{-- email 2 --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email2" class="block text-sm font-medium text-gray-700">{{__("Email 2")}}</label>
                                    <input type="email" disabled id="email2" name="email2"
                                        value="{{ $user->email2 ? $user->email2 : old('email2') }}" placeholder="email2"
                                        autocomplete="email2"
                                        class="mt-1 block w-full rounded-md border-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border-indigo-600">
                                </div>


                                {{-- type --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="type" class="block text-sm font-medium text-gray-700">{{__("Typ")}}</label>
                                    <select disabled id="type" name="type" autocomplete="type"
                                        class="mt-1 block w-full rounded-md border-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 border-indigo-600">
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
                        <div class="flex justify-end space-x-4 bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <a href="{{ route('nutzer.edit', $user->id) }}"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{__('Bearbeiten')}}</a>

                            <form action="{{ route('nutzer.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" href="{{ route('nutzer.destroy', $user->id) }}"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">{{__('Löschen')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
