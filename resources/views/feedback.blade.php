@extends('layouts.app')

@section('head')
    <title>Feedback | {{ config('app.name', 'Laravel') }}</title>
@endsection


@section('body')
    <main class="relative w-full max-w-7xl mx-auto p-5">
        <form action="{{ route('feedback.send') }}" method="post" class="relative">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}" />
            <h1 class="text-3xl text-slate-600 font-medium py-5">{{ __('Erfolg') }}</h1>

            <div class=" relative flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="terms1" type="checkbox" name="terms1" value="wurde zurück gegeben"
                        class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                </div>
                <label for="terms1"
                    class="ml-2 text-sm font-medium text-gray-900 ">{{ __('Das Fundstück wurde zurück gegeben') }}
                </label>
            </div>
            <div class=" relative flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="terms2" type="checkbox" name="terms2" value="wird zurück gegeben"
                        class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                </div>
                <label for="terms2"
                    class="ml-2 text-sm font-medium text-gray-900 ">{{ __('Das Fundstück wird demnächst zurück gegeben') }}
                </label>
            </div>
            <div class=" relative flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="terms3" type="checkbox" name="terms3" value="Der Eigentümer oder Finder reagiert nicht"
                        class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                </div>
                <label for="terms3"
                    class="ml-2 text-sm font-medium text-gray-900 ">{{ __('Der Eigentümer oder Finder reagiert nicht') }}
                </label>
            </div>
            <div class=" relative flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="terms4" type="checkbox" name="terms4" value="kein Finderlohn"
                        class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                </div>
                <label for="terms4"
                    class="ml-2 text-sm font-medium text-gray-900 ">{{ __('Der Finderlohn wurde nicht überreicht') }}
                </label>
            </div>
            <h1 class="text-3xl text-slate-600 font-medium py-5">{{ __('Kundenzufriedenheit mit dem Service') }}</h1>

            <div class=" relative flex space-x-3 mb-6">
                <div class="flex flex-col">
                    <div class="flex justify-center items-center h-5">
                        <input id="terms6" type="radio" name="feedback" value="1"
                            class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="terms6" class="text-sm font-medium text-green-500  ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>

                    </label>
                </div>
                <div class="flex flex-col">
                    <div class="flex justify-center items-center h-5">
                        <input id="terms6" type="radio" name="feedback" value="2"
                            class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="terms6" class="text-sm font-medium text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6  ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </label>
                </div>
                <div class="flex flex-col">
                    <div class="flex justify-center items-center h-5">
                        <input id="terms6" type="radio" name="feedback" value="3"
                            class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300">
                    </div>
                    <label for="terms7" class="text-sm font-medium text-red-500 "><svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                        </svg>
                    </label>
                </div>
            </div>

            <div class="relative ">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Mitteilung') }}</label>
                <textarea name="message" id="message" cols="30" rows="10"
                    class=" mt-1 block w-full  max-w-md rounded-md border-2 shadow-sm  px-4 py-3 "></textarea>
            </div>

            <div class="relative py-5 mb-10">
                <button type="submit"
                    class="text-sm font-semibold text-white bg-blue-500 rounded-md py-2.5 px-5">{{ __('Senden') }}</button>
            </div>

        </form>
    </main>
@endsection
