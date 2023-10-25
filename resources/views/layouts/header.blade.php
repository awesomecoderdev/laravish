<header class="site-header bg-primary z-[999999]" x-data="{ open: false, toggle() { this.open = !this.open; } }">
    <div class="relative max-w-6xl mx-auto h-auto lg:px-4 md:px-4 sm:px-5 xs:px-5 px-4 grid grid-cols-2 py-2.5 "
        @click.outside="open = false">
        <a href="{{ site_url('/') }}">
            <img class="w-36 h-auto" src="{{ public_url('img/fas_svg.svg') }}" alt="Found and Scan Logo"
                class="faslogo_bare" />
        </a>
        <div class="relative flex items-center justify-end gap-4">
            <nav class="w-full relative md:flex hidden justify-end">
                {!! wp_nav_menu(
                    // show nav
                    [
                        'container' => false,
                        'theme_location' => has_nav_menu('primary') ? 'primary' : null,
                        'menu_class' => 'relative flex space-x-4 text-zinc-900 dark:text-white',
                    ],
                ) !!}
            </nav>

            <svg @click="toggle" class="w-8 cursor-pointer h-8 text-blue-400"
                :class="!open ? '' : 'opacity-0 pointer-events-none'" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
    </div>
    <div class="relative max-w-6xl mx-auto" style="display: none;" x-show="open" x-collapse
        @click.outside="open = false">
        <div class="fixed top-0 right-0 bg-indigo-400 w-72 h-screen z-[100] p-4 pt-10 space-y-4">
            <nav class="w-full relative md:hidden">
                {!! wp_nav_menu([
                    'container' => false,
                    'theme_location' => has_nav_menu('primary') ? 'primary' : null,
                    'menu_class' => 'relative right-navigation grid text-white font-semebold space-y-4',
                ]) !!}
            </nav>
            <nav class="w-full relative">
                {!! wp_nav_menu([
                    'container' => false,
                    'theme_location' => has_nav_menu('right') ? 'right' : 'primary',
                    'menu_class' => 'relative right-navigation grid text-white font-semebold space-y-4',
                ]) !!}
            </nav>

            <div class="relative right-navigation grid text-white font-semebold space-y-4">
                <ul>
                    <li class="page_item page-item-3">
                        @auth
                            <a href="{{ route('tags.index') }}">
                                <div>{{ __('Fas-IDs') }}</div>
                            </a>
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('nutzer.index') }}">
                                    <div>{{ __('Users') }}</div>
                                </a>
                                <a href="{{ route('sichtungen.prompt') }}">
                                    <div>{{ __('Sichtungen') }}</div>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}">
                                <div>{{ __('Logout') }}</div>
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                <div>{{ __('Login') }}</div>
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>


            <svg class="w-6 h-6 absolute cursor-pointer text-white right-4 top-4" @click="toggle"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </div>
    </div>
</header>
