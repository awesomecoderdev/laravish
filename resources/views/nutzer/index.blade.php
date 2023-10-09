@extends('layouts.app')

@section('head')
    <title>Nutzer | {{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
    <main class="max-w-7xl w-full p-5  mx-auto">
        <div class="relative p-4 mb-4 flex justify-end">
            <a href="{{ route('nutzer.create') }}"
                class="font-medium text-black bg-sichtungen px-3 py-1 rounded-full hover:underline">{{ __('Add New') }}</a>
        </div>
        @error('updateUser')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $message }}
            </div>
        @enderror
        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert">
                <span class="font-medium">{{ __('Erfolg') }}</span> {{ Session::get('success') }}
            </div>
        @endif

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs border-b-2 navigation text-white bg-header">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                {{ __('ID') }}
                                {{-- <a href="#"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z">
                                    </path>
                                </svg>
                                {{-- </a> --}}
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Username') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Typ') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Aktion') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->id }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $user->name }}
                            </td>
                            <td class="py-4 px-6">
                                {{ Str::ucfirst($user->type) }}
                            </td>
                            <td class="py-4 px-6 flex items-center  space-x-4">

                                <a href="{{ route('nutzer.edit', $user) }}"
                                    class="relative flex space-x-3 items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>

                                @if (Auth::id() != $user->id)
                                    <form action="{{ route('nutzer.destroy', $user->id) }}"
                                        class="font-medium text-red-600 hover:underline flex justify-center items-center"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>

                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
