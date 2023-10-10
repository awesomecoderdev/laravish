@extends('layouts.app')

@section('head')
    <title>{{ __('Feedback') }} | {{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
    <main class="relative w-full max-w-7xl mx-auto p-5">
        <h2 class="font-bold text-2xl custom-border italic text-[#002D74]">{{ __('ID aktivieren') }}</h2>
        <p>
            {{ __('Vielen Dank für den Kauf einer Found&Scan ID. Wir brauchen nur noch kurz den Code und Ihre Emailadresse.') }}

        </p>
        <form action="{{ route('activation.send', $id) }}" method="post" class="relative">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}" />

            <div class="relative ">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Email') }}*</label>
                <input type="email" required="required" autocomplete="yourmail@yourprovider.com" name="email" id="message" cols="30" rows="10"
                       class=" mt-1 block w-full  max-w-md rounded-md border-2 shadow-sm  px-4 py-3 "/>
                @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">{{ __('Oops!') }}
                                                        </span>{{ $message }}</p>
                @enderror
            </div>
            <div class="relative ">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Code') }}*</label>
                <input name="code" required="required" autocomplete="XX-XX-XXXX" id="code" value="{{ $code }}"
                       class=" mt-1 block w-full  max-w-md rounded-md border-2 shadow-sm  px-4 py-3 "/>
                @error('code')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">{{ __('Oops!') }}
                                                        </span>{{ $message }}</p>
                @enderror
            </div>

            <div class="relative py-5 mb-10">
                <button type="submit"
                    class="text-sm font-semibold text-white bg-blue-500 rounded-md py-2.5 px-5">{{ __('Senden') }}</button>
            </div>

        </form>
    </main>
@endsection
