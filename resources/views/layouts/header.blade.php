<header class="relative max-w-6xl mx-auto h-auto lg:px-0 md:px-4 sm:px-5 xs:px-5 px-4 ">
    <div class="relative grid grid-cols-2 py-2.5 ">
        <a href="{{ site_url('/') }}">
            <img class="w-36 h-auto" src="{{ public_url('img/fas_svg.svg') }}" alt="Found and Scan Logo"
                class="faslogo_bare" />
        </a>
        <div class="relative flex items-center gap-4">
            <nav class="w-full relative flex justify-end">
                {!! wp_nav_menu(
                    // show nav
                    [
                        'container' => false,
                        'theme_location' => has_nav_menu('primary') ? 'primary' : null,
                        'menu_class' => 'relative flex space-x-4 text-slate-600 dark:text-white',
                    ],
                ) !!}
            </nav>

            <svg class="w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
    </div>
</header>
