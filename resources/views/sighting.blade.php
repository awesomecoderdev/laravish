@extends('layouts.app')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
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
        @if (Session::has('success'))
            <div class="flex items-center justify-center h-screen">
                <div>
                    <div class="flex flex-col items-center space-y-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600 w-28 h-28" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h1 class="text-4xl font-bold">{{ __('Vielen Dank ! / Thank You !') }}</h1>
                        <p>{{ __('Ihr Feedback wurde erfolgreich gesendet! / Your feedback has been sent successfully!') }}</p>
                        <a href="{{ route('sichtungen') }}"
                           class="inline-flex items-center px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                            </svg>
                            <span class="text-sm font-medium">
                                {{ __('Zurück / Go Back') }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-10 sm:mt-0">
                <div class="relative">
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="{{ route('sichtungen.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="tag_id" name="tag_id" required=""
                                   value="{{ isset($tag_code) ? $tag_code : '' }}">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        {{-- email --}}
                                        <div class="col-span-6">

                                            <label for="contact"
                                                   class="block text-sm font-medium text-gray-700">{{ __('Meine Emailadresse oder Telefonnummer/my email address or phone number') }}</label>
                                            <input required="required" id="contact" name="contact"
                                                   value='{{ isset($sighting['contact']) ? $sighting['contact'] : old('contact') }}'
                                                   placeholder="Email" autocomplete="contact"
                                                   class="@error('contact') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            @error('contact')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                        </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- message --}}
                                        <div class="col-span-6">
                                            <label for="name"
                                                   class="block text-sm font-medium text-gray-700">{{__('Meine Nachricht an den Eigentümer/My message to the owner')}}</label>
                                            <textarea name="message" id="message" cols="30" rows="10"
                                                      class="@error('name') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">{{ $sighting['message'] ? $sighting['message'] : old('message') }}</textarea>
                                            @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                        </span>{{ $message }}</p>
                                            @enderror
                                            </div>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox" id="geolocation">
                                                <span class="ml-2">{{__('Meine Position teilen')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                </div>


                                <div class="flex justify-between items-center bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        {{ __('Absenden/Send') }}
                                    </button>
                                </div>
                            </div>
                            <div style="font-size:small;float:right;">
                                <a href="{{ route('tags.new', $tag_id) }}">{{ __('Diese ID gehört mir') }}</a><br><br>
                            </div>

                            <input type="hidden" name="lat" value="0" id="lat">
                            <input type="hidden" name="long" value="0" id="long">

                        </form>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script>

        const geoLocationBtn = document.getElementById('geolocation');
        const lat = document.getElementById('lat');
        const long = document.getElementById('long');

        navigator.permissions.query({ name: "geolocation" }).then((result) => {
            // console.log('result :>> ', result);
            if (result.state === "granted") {
                // console.log('granted :>> ');
                geoLocationBtn.checked = true;

                navigator.geolocation.getCurrentPosition(showPosition);

            } else if (result.state === "prompt") {
                geoLocationBtn.checked = false;
            } else if (result.state === "denied") {
                geoLocationBtn.checked = false;
            }
        });

        geoLocationBtn.addEventListener('click', (e) => {
            if(geoLocationBtn.checked){
                if (navigator.geolocation) {
                    e.preventDefault();
                    navigator.geolocation.getCurrentPosition(showPosition,errorCallback);
                } else {
                    console.log('geolocation Unavaiable :>> ');
                }
            }else{
                geoLocationBtn.checked = false;
                lat.value = 0;
                long.value = 0;
            }
        });



        function showPosition(position) {
            const { latitude, longitude } = position.coords;
            // Scroll map to latitude / longitude.
            console.log('location :>> ', latitude, longitude);
            if(latitude){
                lat.value = latitude;
            }
            if(longitude){
                long.value = longitude;
            }

            if(latitude && longitude){
                geoLocationBtn.checked = true;
            }else{
                geoLocationBtn.checked = false;
            }
        }


        function errorCallback(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    geoLocationBtn.checked = false;
                    break;
                case error.TIMEOUT:
                    geoLocationBtn.checked = false;
                    break;
                case error.UNKNOWN_ERROR:
                    geoLocationBtn.checked = false;
                    break;
            }
        }

    </script>
@endsection
