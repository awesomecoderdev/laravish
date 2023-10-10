@extends('layouts.app')

@section('head')
    <title>{{ __('Sichtungen') }} | {{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
    <main class="relative w-full max-w-7xl mx-auto p-5">

        @error('updateUser')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg " role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $message }}
            </div>
        @enderror

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-black bg-sichtungen rounded-lg " role="alert">
                <span class="font-medium">{{ __('Erfolg') }}</span> {{ Session::get('success') }}
            </div>
        @endif

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-700 ">
                <thead class="text-xs border-b-2 navigation text-white bg-header  ">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                            {{ __('Am') }}
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Tag') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Mitteilung') }}
                    </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Bewertung') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Status') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('Feedback') }}
                        </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sightings as $sighting)
                    <tr class="bg-white border-b ">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $sighting->when }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $sighting->tag }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $sighting->message }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $sighting->rating }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $sighting->success }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $sighting->feedback }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
