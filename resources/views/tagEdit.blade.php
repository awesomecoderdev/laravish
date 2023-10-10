@extends('layouts.app')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
@endsection

@php
    $errorInput = 'focus:border-red-500 focus:ring-red-500 sm:text-sm border-red-600';
    $input = 'focus:border-primary-500 focus:ring-primary-500 focus-visible:ring-primary-500 focus-visible:border-primary-500 sm:text-sm border-primary-600';
@endphp

@section('body')
    <main class="max-w-7xl w-full p-5  mx-auto ">
        @error('updateUser')
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium">__('Oops!')</span> {{ $message }}
        </div>
        @enderror

        @if (Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                 role="alert">
                <span class="font-medium">__('Erfolg')</span> {{ Session::get('success') }}
            </div>
        @endif

        <div class="mt-10 sm:mt-0">
            <div class="relative">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="{{ route('tags.store') }}" method="POST">
                        <img src="{{ public_url('./img/logo_withouttext.svg') }}" alt="Logo" class="float-right" style="float:right"/>
                        @csrf
                        @if ($tag['id'] != -1)
                            <a href="{{ $tag->getSightingURL() }}" class="relative w-full flex justify-start items-center pb-14 my-5">
                                <img class="lg:w-[65%] w-[120%] lg:pl-0 pl-[11px] lg:-mr-52 mr-[-65px]" src="data:image/svg+xml;base64, {{ $tag['qr'] }}"/>
                            </a>
                        @endif
                        <input type="hidden" id="id" name="id" required="" value="{{ $tag['id'] }}">

                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    @if (($tag['id'] == -1) && (Auth::user()->isAdmin()))
                                        {{-- count --}}
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="count"
                                                   class="block text-sm font-medium text-gray-700">Anzahl</label>
                                            <select name="count"
                                                    class="@error('count') {{ $errorInput }} @else {{ $input }} @enderror mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="25">25</option>
                                            </select>

                                            @error('count')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- name --}}
                                    <div
                                        class="{{ ($tag['id'] == -1) && (Auth::user()->isAdmin()) ? 'col-span-2 sm:col-span-2' : 'col-span-6 sm:col-span-3' }}">
                                        <label for="name"
                                               class="block text-sm font-medium text-gray-700">{{__('Name')}}</label>
                                        <input type="text" id="name" name="name"
                                               value='{{ $tag['name'] ? $tag['name'] : old('name') }}'
                                               placeholder="Name"
                                               autocomplete="name"
                                               class="@error('name') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div
                                        class="{{ ($tag['id'] == -1) && (Auth::user()->isAdmin()) ? 'col-span-3 sm:col-span-3' : 'col-span-6 sm:col-span-3' }}">
                                    </div>

                                    {{-- code --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="code"
                                            class="block text-sm font-medium text-gray-700">{{__('Fas-ID')}}</label>
                                        <input type="text" id="code" name="code"
                                            value='{{ $tag['code'] ? $tag['code'] : old('code') }}'
                                            placeholder="Fas-ID"
                                            @if(!Auth::user()->isAdmin())
                                            readonly="readonly"
                                            disabled="disabled"
                                            @endif
                                            autocomplete="code"
                                            class="@error('code') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('code')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- valid_unitl --}}
                                    <div class="col-span-6 " x-data="app()" x-init="[initDate(), getNoOfDays()]"
                                         x-cloak>

                                        <div class="relative">
                                            @if (Auth::user()->isAdmin())
                                                <label for="valid_until" class="block text-sm font-medium text-gray-700">{{__('Bis')}}</label>
                                                <input type="text" id="valid_until" name="valid_until" readonly
                                                       @if(Auth::user()->isAdmin())
                                                       x-on:click="showDatepicker = !showDatepicker"
                                                       x-model="datepickerValue"
                                                       x-on:keydown.escape="showDatepicker = false"
                                                       @endif
                                                       value="{{ $tag['valid_until'] ? date('Y.m.d', strtotime( $tag['valid_until'])) : old('valid_until') }}"
                                                       placeholder="valid_until" autocomplete="valid_until"
                                                       class="@error('valid_until') {{ $errorInput }} @else {{ $input }} @enderror {{ Auth::user()->isAdmin() ? '' : ' pointer-events-none opacity-50' }} mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">


                                                <div class="absolute top-0 right-0 px-3 py-2">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>

                                                <div
                                                    class="bg-white mt-12 rounded-lg shadow p-4 z-20 absolute top-0 left-0"
                                                    style="width: 17rem" x-show.transition="showDatepicker"
                                                    @click.away="showDatepicker = false">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div>
                                                        <span x-text="MONTH_NAMES[month]"
                                                              class="text-lg font-bold text-gray-800"></span>
                                                            <span x-text="year"
                                                                  class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                        </div>
                                                        <div>
                                                            <button type="button"
                                                                    class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                                                    @click="if (month == 0) {
                                                                              year--;
                                                                              month = 12;
                                                                          } month--; getNoOfDays()">
                                                                <svg class="h-6 w-6 text-gray-400 inline-flex"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                                </svg>
                                                            </button>
                                                            <button type="button"
                                                                    class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                                                    @click="if (month == 11) {
                                                                              month = 0;
                                                                              year++;
                                                                          } else {
                                                                              month++;
                                                                          } getNoOfDays()">
                                                                <svg class="h-6 w-6 text-gray-400 inline-flex"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2" d="M9 5l7 7-7 7"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="flex flex-wrap mb-3 -mx-1">
                                                        <template x-for="(day, index) in DAYS" :key="index">
                                                            <div style="width: 14.26%" class="px-0.5">
                                                                <div x-text="day"
                                                                     class="text-gray-800 font-medium text-center text-xs">
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>

                                                    <div class="flex flex-wrap -mx-1">
                                                        <template x-for="blankday in blankdays">
                                                            <div style="width: 14.28%"
                                                                 class="text-center border p-1 border-transparent text-sm">
                                                            </div>
                                                        </template>
                                                        <template x-for="(date, dateIndex) in no_of_days"
                                                                  :key="dateIndex">
                                                            <div style="width: 14.28%" class="px-1 mb-1">
                                                                <div @click="getDateValue(date)" x-text="date"
                                                                     class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                                                     :class="{
                                                                    'bg-primary-200': isToday(date) == true,
                                                                    'text-gray-600 hover:bg-primary-200': isToday(
                                                                            date) == false &&
                                                                        isSelectedDate(
                                                                            date) == false,
                                                                    'bg-primary-500 text-white hover:bg-opacity-75': isSelectedDate(
                                                                        date) == true
                                                                }">
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>

                                                </div>
                                            @else
                                                {{ $tag['valid_until']}}
                                            @endif
                                        </div>

                                        @error('valid_until')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror


                                        <script>
                                            const MONTH_NAMES = [
                                                "January",
                                                "February",
                                                "March",
                                                "April",
                                                "May",
                                                "June",
                                                "July",
                                                "August",
                                                "September",
                                                "October",
                                                "November",
                                                "December",
                                            ];
                                            const MONTH_SHORT_NAMES = [
                                                "Jan",
                                                "Feb",
                                                "Mar",
                                                "Apr",
                                                "May",
                                                "Jun",
                                                "Jul",
                                                "Aug",
                                                "Sep",
                                                "Oct",
                                                "Nov",
                                                "Dec",
                                            ];
                                            const DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                                            function app() {
                                                return {
                                                    showDatepicker: false,
                                                    datepickerValue: "",
                                                    // selectedDate: "2021.02.04",
                                                    selectedDate: "{{ isset($tag['valid_until']) && $tag['valid_until'] != null ? date('Y.m.d', strtotime($tag['valid_until'])) : date('Y.m.d', strtotime('now')) }}",
                                                    dateFormat: "DD.MM.YYYY",
                                                    month: "",
                                                    year: "",
                                                    no_of_days: [],
                                                    blankdays: [],
                                                    initDate() {
                                                        let today;
                                                        if (this.selectedDate) {
                                                            // today = new Date(Date.parse(this.selectedDate));
                                                            let datestr = this.selectedDate.split('.');
                                                            let year = parseInt(datestr[0]);
                                                            let month = parseInt(datestr[1]);
                                                            let day = parseInt(datestr[2]);
                                                            today = new Date(+year, month - 1, +day);

                                                        } else {
                                                            today = new Date();
                                                        }

                                                        this.month = today.getMonth();
                                                        this.year = today.getFullYear();
                                                        this.datepickerValue = this.formatDateForDisplay(
                                                            today
                                                        );
                                                    },
                                                    formatDateForDisplay(date) {
                                                        let formattedDay = DAYS[date.getDay()];
                                                        let formattedDate = ("0" + date.getDate()).slice(
                                                            -2
                                                        ); // appends 0 (zero) in single digit date
                                                        let formattedMonth = MONTH_NAMES[date.getMonth()];
                                                        let formattedMonthShortName =
                                                            MONTH_SHORT_NAMES[date.getMonth()];
                                                        let formattedMonthInNumber = (
                                                            "0" +
                                                            (parseInt(date.getMonth()) + 1)
                                                        ).slice(-2);
                                                        let formattedYear = date.getFullYear();
                                                        if (this.dateFormat === "DD-MM-YYYY") {
                                                            return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 02-04-2021
                                                        }
                                                        if (this.dateFormat === "DD.MM.YYYY") {
                                                            return `${formattedDate}.${formattedMonthInNumber}.${formattedYear}`; // 02-04-2021
                                                        }
                                                        if (this.dateFormat === "YYYY-MM-DD") {
                                                            return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2021-04-02
                                                        }
                                                        if (this.dateFormat === "D d M, Y") {
                                                            return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 02 Mar 2021
                                                        }
                                                        return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
                                                    },
                                                    isSelectedDate(date) {
                                                        const d = new Date(this.year, this.month, date);
                                                        return this.datepickerValue ===
                                                        this.formatDateForDisplay(d) ?
                                                            true :
                                                            false;
                                                    },
                                                    isToday(date) {
                                                        const today = new Date();
                                                        const d = new Date(this.year, this.month, date);
                                                        return today.toDateString() === d.toDateString() ?
                                                            true :
                                                            false;
                                                    },
                                                    getDateValue(date) {
                                                        let selectedDate = new Date(
                                                            this.year,
                                                            this.month,
                                                            date
                                                        );
                                                        this.datepickerValue = this.formatDateForDisplay(
                                                            selectedDate
                                                        );
                                                        // this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + formattedMonthInNumber).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
                                                        this.isSelectedDate(date);
                                                        this.showDatepicker = false;
                                                    },
                                                    getNoOfDays() {
                                                        let daysInMonth = new Date(
                                                            this.year,
                                                            this.month + 1,
                                                            0
                                                        ).getDate();
                                                        // find where to start calendar day of week
                                                        let dayOfWeek = new Date(
                                                            this.year,
                                                            this.month
                                                        ).getDay();
                                                        let blankdaysArray = [];
                                                        for (var i = 1; i <= dayOfWeek; i++) {
                                                            blankdaysArray.push(i);
                                                        }
                                                        let daysArray = [];
                                                        for (var i = 1; i <= daysInMonth; i++) {
                                                            daysArray.push(i);
                                                        }
                                                        this.blankdays = blankdaysArray;
                                                        this.no_of_days = daysArray;

                                                    },
                                                };
                                            }

                                        </script>
                                    </div>

                                    {{-- lizenz --}}
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="activationcode"
                                               class="block text-sm font-medium text-gray-700">{{ __('Lizenzcode') }}</label>
                                        <input type="text" id="license" name="license"
                                               value='{{ $tag['license'] ? $tag['license'] : old('license') }}'
                                               placeholder="Lizenzcode" autocomplete="code"
                                               class="@error('license') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                        @error('license')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                class="font-medium">{{__('Oops!')}}
                                                </span>{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- activationcode --}}
                                    @if(Auth::user()->isAdmin())
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="activationcode"
                                                class="block text-sm font-medium text-gray-700"><a
                                                    href="{{$tag->getActivationURL()}}">{{ __('Aktivierungscode') }}</a></label>
                                            <input type="text" id="activationcode" name="activationcode"
                                                @if(!Auth::user()->isAdmin())
                                                readonly="readonly"
                                                disabled="disabled"
                                                @endif
                                                value='{{ $tag['activationcode'] ? $tag['activationcode'] : old('activationcode') }}'
                                                placeholder="Activationcode" autocomplete="code"
                                                class="@error('activationcode') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            @error('activationcode')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                    </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- comment --}}
                                    @if(Auth::user()->isAdmin())
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="comment"
                                                class="block text-sm font-medium text-gray-700">{{ __('Kommentar') }}</label>
                                            <input type="text" id="comment" name="comment"
                                                value='{{ $tag['comment'] ? $tag['comment'] : old('comment') }}'
                                                placeholder="Comment" autocomplete="code"
                                                class="@error('comment') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            @error('comment')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium"> {{ __('Oops!') }}
                                                    </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- status --}}
                                    @if(Auth::user()->isAdmin())
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="status"
                                                class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                                            @if(Auth::user()->isAdmin())
                                                {{ Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive',  'expired' => 'Expired'], $tag['status'], [
                                                    'class' =>
                                                        'focus:border-primary-500 focus:ring-primary-500 sm:text-sm border-primary-600 mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ',
                                                    'id' => 'status',
                                                ]) }}
                                            @else
                                                {{ Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive', 'expired' => 'Expired'], $tag['status'], [
                                                    'class' =>
                                                        'pointer-events-none opacity-50 focus:border-primary-500 focus:ring-primary-500 sm:text-sm border-primary-600 mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ',
                                                    'id' => 'status',
                                                ]) }}
                                            @endif
                                        </div>
                                    @endif


                                    {{-- user --}}
                                    @if(Auth::user()->isAdmin())

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="user"
                                                class="block text-sm font-medium text-gray-700">{{ __('Nutzer') }}</label>
                                            @if(Auth::user()->isAdmin())
                                                {{ Form::select('user_id', $usernames, $tag['user_id'], [
                                                    'class' =>
                                                        'focus:border-primary-500 focus:ring-primary-500 sm:text-sm border-primary-600 mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ',
                                                    'id' => 'user',
                                                ]) }}
                                            @else
                                                {{ Form::select('user_id', $usernames, $tag['user_id'], [
                                                    'class' =>
                                                        'pointer-events-none opacity-50 focus:border-primary-500 focus:ring-primary-500 sm:text-sm border-primary-600 mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ',
                                                    'id' => 'user',
                                                ]) }}
                                            @endif
                                        </div>
                                    @endif

                                    {{-- email --}}
                                    @if(Auth::user()->isAdmin())
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email1"
                                                class="block text-sm font-medium text-gray-700">{{ __('Email 1') }}</label>
                                            <input type="email" id="email1" name="email1"
                                                value="{{ $tag['email1'] ? $tag['email1'] : old('email1') }}"
                                                placeholder="email" autocomplete="email"
                                                class="@error('email1') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            @error('email1')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                    </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- email 2 --}}
                                    @if(Auth::user()->isAdmin())
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="email2"
                                                class="block text-sm font-medium text-gray-700">{{ __('Email 2') }}
                                            </label>
                                            <input type="email" id="email2" name="email2"
                                                value="{{ $tag['email2'] ? $tag['email2'] : old('email2') }}"
                                                placeholder="email2" autocomplete="email2"
                                                class="@error('email2') {{ $errorInput }} @else {{ $input }} @enderror  mt-1 block w-full rounded-md border-2 shadow-sm  px-4 py-3 ">
                                            @error('email2')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                                    class="font-medium">{{__('Oops!')}}
                                                    </span>{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

                    @if (count($sightings)>0)
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 bg-gray-50  ">
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
                    @endif
                </div>

            </div>
        </div>


    </main>
@endsection
