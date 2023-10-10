@extends('layouts.app')

@section('head')
    <title>{{ __('Sichtungen') }} | {{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
    <main class="relative w-full max-w-7xl mx-auto p-5">

        @error('QR')
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg " role="alert">
                <span class="font-medium">{{ __('Oops!') }}</span> {{ $message }}
            </div>
        @enderror

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-black bg-sichtungen rounded-lg " role="alert">
                <span class="font-medium">{{ __('Erfolg') }}</span> {{ Session::get('success') }}
            </div>
        @endif


        <form action="{{ route('sichtungen.redir') }}" method="post" class="relative">
            @csrf
            {{ __('Bitte scanne jetzt den QR code auf Deinem gefundenen Gegenstand, oder trage die fas-ID händisch ein, um die Eigentümerin zu kontaktieren:') }}
            <img src="{{ public_url('/img/teaser.png') }}" alt="Scanning QR code"/>

            <div class="relative ">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Gefundenen Gegenstand identifizieren (Your found fas-ID-Nr.)') }}</label>
                <input required="required" name="id" id="id"
                          class=" mt-1 block w-full  max-w-md rounded-md border-2 shadow-sm  px-4 py-3 "/>
            </div>

            <div class="relative py-5 mb-10">
                <button type="submit"
                        class="text-sm font-semibold text-white bg-blue-500 rounded-md py-2.5 px-5">{{ __('Senden') }}</button>
            </div>

        </form>


    </main>
@endsection
