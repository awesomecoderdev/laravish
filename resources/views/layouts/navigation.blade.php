
<div class="relative flex items-center gap-4">
    <nav id="secnav" class="w-full wide-nav relative flex justify-end">
        {!! wp_nav_menu(
            // show nav
            [
                'container' => false,
                'theme_location' => has_nav_menu('primary') ? 'primary' : null,
                'menu_class' => 'relative flex space-x-4 text-zinc-900 dark:text-white',
            ],
        ) !!}
    </nav>

</div>
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
        <div class="hamburgernav h-16">


            <!-- screen to narrow, include horizontal top nav-->
            @foreach ($nav2 as $navItem)
                <div>
                    <a  class="narrow-nav"  href="{{$navItem->url}}">{{$navItem->title}}</a>
                </div>
            @endforeach
        <!-- main Navigation Links -->
            @foreach ($nav as $navItem)
                <div>
                    <a  href="{{$navItem->url}}">{{$navItem->title}}</a>
                </div>
            @endforeach

            @auth

                @if (Auth::user()->isAdmin())
                    <div>
                        <a :href="route('nutzer.index')" :active="request()->routeIs('nutzer.index')">
                            {{ __('Users') }}
                        </a>
                    </div>
                    <div>
                        <a :href="route('sichtungen')" :active="request()->routeIs('sichtungen')">
                            {{ __('Sichtungen') }}
                        </a>
                    </div>
                @endif

                    <div >
                        <a :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                            {{ __('Fas-IDs') }}
                        </a>
                    </div>
                    <div >
                        <a :href="route('logout')">
                            {{ __('Logout') }}
                        </a>
                    </div>
            @endauth


        </div>




    </div>

    <!-- Responsive Navigation Menu -->

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @foreach ($nav as $navItem)
            <div class="pt-2 pb-1 narrow-nav">
                <x-responsive-nav-link href="{{$navItem->url}}" :active="request()->routeIs('index')">
                    {{$navItem->title}}
                </x-responsive-nav-link>
            </div>
    @endforeach

    <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1">
            @auth
                <div class="px-4">
                    <div class="font-medium ">{{ Auth::user()->name }}</div>
                    <div class="font-medium ">{{ Auth::user()->email }}</div>
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

