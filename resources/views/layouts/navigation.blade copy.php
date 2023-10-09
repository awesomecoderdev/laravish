<div id="hamburger">
    <input type="checkbox" id="hamburg" onclick="toggleNav()">
    <label for="hamburg" class="hamburg">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </label>
</div>
<nav id="mainnav" x-data="{ open: false }" class="border-b border-gray-100 d-none">
    <!-- Primary Navigation Menu -->
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-column justify-between h-16">


            <!-- screen to narrow, include horizontal top nav-->
            @foreach ($nav2 as $navItem)
                <div>
                    <a class="narrow-nav" :active="request() - > routeIs('index')"
                        href="{{ $navItem->url }}">{{ $navItem->title }}</a>
                </div>
            @endforeach
            <!-- main Navigation Links -->
            @foreach ($nav as $navItem)
                <div>
                    <a :active="request() - > routeIs('index')" href="{{ $navItem->url }}">{{ $navItem->title }}</a>
                </div>
            @endforeach

            @auth

                @if (Auth::user()->isAdmin())
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('nutzer.index')" :active="request()->routeIs('nutzer.index')">
                            {{ __('Users') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('sichtungen')" :active="request()->routeIs('sichtungen')">
                            {{ __('Sichtungen') }}
                        </x-nav-link>
                    </div>
                @endif

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                        {{ __('Fas-IDs') }}
                    </x-nav-link>
                </div>
            @endauth


        </div>

        <!-- Settings Dropdown -->
        @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                {{-- <x-language /> --}}

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    @auth

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>

                    @endauth
                </x-dropdown>
            </div>
        @else
            <div class="">
                {{-- <x-language /> --}}

                <a href="{{ route('login') }}">
                    <div>{{ __('Login') }}</div>
                </a>

            </div>
        @endauth


    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @foreach ($nav as $navItem)
            <div class="pt-2 pb-1 narrow-nav">
                <x-responsive-nav-link href="{{ $navItem->url }}" :active="request()->routeIs('index')">
                    {{ $navItem->title }}
                </x-responsive-nav-link>
            </div>
        @endforeach

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <!--- show the navigation to login use with if and endif -->
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('nutzer.index')" :active="request()->routeIs('nutzer.index')">
                        {{ __('Users') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('sichtungen')" :active="request()->routeIs('sichtungen')">
                        {{ __('Sichtungen') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                        {{ __('Fas-IDs') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

    </div>


</nav>
<nav id="secnav" class="secnav border-b border-gray-100" x-data="{ open: false }">
    @foreach ($nav2 as $navItem)
        <x-nav-link href="{{ $navItem->url }}" class="wide-nav" :active="request()->routeIs('index')">
            {{ $navItem->title }}
        </x-nav-link>
    @endforeach
</nav>
