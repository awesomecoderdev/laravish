@extends('layouts.app')
@section('content')
    <div class="relative w-full bg-zinc-100 lg:px-4 sm:px-5 xs:px-5 px-4 pt-10">
        <div class="relative h-full w-full max-w-6xl mx-auto py-6 flex items-center">
            <div class="relative w-full">
                <div class="relative h-full space-y-2  py-4">
                    <p class="text-lg font-semibold">Personlich,chenell,bequen</p>
                    <h1 class="text-zinc-800 lg:text-5xl md:text-4xl text-3xl font-extrabold text-balance max-w-sm py-4">
                        Deine Sachen
                        Zuruck zu Dir
                    </h1>
                    <br>
                    <a href="#"
                        class=" bg-blue-300 mt-6 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                        Get yours now
                    </a>
                </div>
                <div class="relative w-full flex gap-2 justify-center items-center pt-6">
                    <div class="h-4 w-4 rounded-full border-2 cursor-pointer border-pink-600 bg-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 cursor-pointer border-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 cursor-pointer border-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 cursor-pointer border-pink-600"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="relative bg-gradient-to-b from-primary ">
        <div class=" {{ theme_class('lg:pt-16 pt-10') }}">
            <h1 class="text-zinc-800 lg:text-5xl md:text-4xl text-3xl font-extrabold text-balance max-w-md md:py-4">
                9 Ways to Use FAS In Shared Environments
            </h1>
            @if ($posts->have_posts())
                @php $posts_count = 0; @endphp
                <div class="relative grid lg:grid-cols-3 md:grid-cols-2 col-span-1 gap-8 py-8">
                    @while ($posts->have_posts())
                        @php $posts->the_post(); @endphp
                        @php $posts_count++; @endphp
                        <div
                            class="relative lg:col-span-1 {{ $posts_count > 2 ? 'md:col-span-2' : '' }} h-auto border border-slate-100 rounded overflow-hidden shadow-lg">
                            <a href="{{ get_the_permalink() }}"
                                class="block relative lg:aspect-[6/3] {{ $posts_count > 2 ? 'md:aspect-[7/3]' : '' }} aspect-[4/2] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                                style="background-image: url({{ get_the_post_thumbnail_url() }})">
                            </a>
                            <div class="relative bg-white">
                                <a href="{{ get_the_permalink() }}" class="relative block  p-3">
                                    <h1 class="line-clamp-2 text-sm font-semibold text-zinc-800">
                                        {{ get_the_title() }}
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur recusandae quia
                                        veniam
                                        magnam magni odio reprehenderit facere, doloribus minus at corporis necessitatibus
                                        labore ullam quas consequatur autem nihil est cupiditate?
                                    </h1>
                                </a>
                                <div class="relative border-t border-slate-100 pb-1">
                                    <span
                                        class="text-zinc-500 text-[8px] px-3 font-semibold">{{ human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago' }}</span>
                                </div>
                            </div>
                        </div>
                    @endwhile
                </div>
            @endif
        </div>
    </section>
@endsection

@section('body')
    <section class="relative lg:py-5 lg:mt-5">
        <h1 class="text-zinc-800 lg:text-5xl md:text-4xl text-3xl font-extrabold text-balance max-w-md py-4">
            How it works
        </h1>
        <div class="relative grid md:grid-cols-2 col-span-1 lg:gap-20 gap-8 lg:py-8">
            <a href="{{ get_the_permalink() }}" class="relative block h-auto border-slate-100">
                <div href="{{ get_the_permalink() }}"
                    class=" relative rounded overflow-hidden aspect-[4/2] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                    style="background-image: url({{ get_the_post_thumbnail_url() }})">
                </div>
                <div class="relative bg-white py-2">
                    <h2 class="line-clamp-2 text-base font-semibold text-zinc-800 text-balnce">
                        {{-- {{ get_the_title() }} --}}
                        Erstens, [choose your favorite format]
                    </h2>
                </div>
            </a>
            <a href="{{ get_the_permalink() }}" class="relative block h-auto border-slate-100">
                <div href="{{ get_the_permalink() }}"
                    class=" relative rounded overflow-hidden aspect-[4/2] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                    style="background-image: url({{ get_the_post_thumbnail_url() }})">
                </div>
                <div class="relative bg-white py-2">
                    <h2 class="line-clamp-2 text-base font-semibold text-zinc-800 text-balnce">
                        {{-- {{ get_the_title() }} --}}
                        Zweitens, Befestige Deine fas-ID@ auf Deinem Gegenstand.
                    </h2>
                </div>
            </a>
        </div>
    </section>

    <section class="relative py-5 max-sm:mt-10">
        <h1
            class="text-zinc-800 md:text-center lg:text-5xl md:text-4xl text-4xl font-extrabold text-balance mx-auto lg:py-4">
            Es funktioniert so einfach.
        </h1>
        <div class="relative flex items-center md:justify-center">
            <a href="#"
                class=" bg-blue-300 mt-6 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                Get yours now
            </a>
        </div>
    </section>
@endsection

@section('section')
    <section class="relative">
        <div class="absolute inset-0 top-32 bg-gradient-to-b from-primary"></div>
        <div class=" {{ theme_class() }}">
            @if ($pages->have_posts())
                @php $pages_count = 0; @endphp
                <div class="relative grid md:grid-cols-2 col-span-1 lg:gap-10 md:gap-5 gap-6 py-8">
                    @while ($pages->have_posts())
                        @php $pages->the_post(); @endphp
                        @php $pages_count++; @endphp

                        @if (wp_is_mobile())
                            <div class="relative border border-slate-100 rounded overflow-hidden shadow-lg">
                                <div class="relative lg:aspect-[6/4] aspect-[6/4] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                                    style="background-image: url({{ get_the_post_thumbnail_url() }})">
                                </div>
                            </div>
                            <div class="relative flex items-center overflow-hidden">
                                <div class="relative gap-4 flex flex-col justify-start items-start">
                                    <h1 class="lg:text-3xl md:text-2xl text-xl font-semibold text-zinc-900">
                                        {{ get_the_title() }}</h1>
                                    <a href="{{ get_the_permalink() }}"
                                        class="text-center bg-blue-300 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                                        Get yours now
                                    </a>
                                </div>
                            </div>
                        @else
                            @if ($pages_count % 2 == 1)
                                <div class="relative border border-slate-100 rounded overflow-hidden shadow-lg">
                                    <div class="relative lg:aspect-[6/4] aspect-[6/4] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                                        style="background-image: url({{ get_the_post_thumbnail_url() }})">
                                    </div>
                                </div>
                                <div class="relative flex items-center overflow-hidden">
                                    <div class="relative gap-4 flex flex-col justify-start items-start">
                                        <h1 class="lg:text-3xl md:text-2xl text-xl font-semibold text-zinc-900">
                                            {{ get_the_title() }}</h1>
                                        <a href="{{ get_the_permalink() }}"
                                            class="text-center bg-blue-300 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                                            Get yours now
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="relative flex items-center overflow-hidden">
                                    <div class="relative  gap-4 flex flex-col justify-end items-end">
                                        <h1 class="lg:text-3xl md:text-2xl text-xl text-right font-semibold text-zinc-900">
                                            {{ get_the_title() }}
                                        </h1>
                                        <a href="{{ get_the_permalink() }}"
                                            class="text-center bg-blue-300 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                                            Get yours now
                                        </a>
                                    </div>
                                </div>
                                <div class="relative border border-slate-100 rounded overflow-hidden shadow-lg">
                                    <div href="{{ get_the_permalink() }}"
                                        class="relative lg:aspect-[6/4] aspect-[6/4] bg-zinc-100 bg-no-repeat bg-cover bg-center border-b border-slate-100"
                                        style="background-image: url({{ get_the_post_thumbnail_url() }})">
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endwhile
                </div>
            @endif
        </div>

        <div class="{{ theme_class('p-10 w-full flex justify-center items-center') }}">
            <div
                class="relative flex justify-evenly items-center md:flex-row flex-col h-52 w-full max-w-5xl border-2 border-highlight">
                <h1
                    class="text-zinc-800 md:text-center lg:text-3xl md:text-3xl text-2xl font-extrabold text-balance lg:py-4">
                    Already have yours?
                </h1>
                <a href="#"
                    class="block bg-blue-400 px-5 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">
                    Activate Now
                </a>
            </div>
        </div>
    </section>

    <section class="relative py-14">
        <div class="relative max-w-7xl w-full min-h-[30rem] mx-auto flex justify-end items-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-no-repeat bg-[-25rem_center] drop-shadow-2xl shadow-2xl z-[5]"
                style="background-image: url({{ theme_asset('images/building.png') }});">
            </div>
            <div class="absolute -left-5 flex justify-center items-end h-full w-56 bg-gradient-to-r from-white z-10">
            </div>
            <div class="absolute -left-5 flex justify-center items-end h-full w-56 bg-gradient-to-r from-white z-10">
            </div>
            <div class="{{ theme_class(' h-60 w-full flex justify-end items-center  p-4') }}">
                <div class="absolute inset-0 bg-indigo-400 shadow-indigo-400 drop-shadow-xl shadow-2xl z-0"></div>
                <div class="relative h-full w-full max-w-lg z-20 p-4 space-y-3">
                    <span class="text-5xl font-semibold text-highlight">B2B</span>
                    <h2 class="text-zinc-900 text-4xl font-semibold">We have iteas for business</h2>
                    <p class="text-zinc-800 font-normal text-base">From customizing QR code with your company logo to
                        activating for your business, we know what to do.
                    </p>
                </div>
                <a href="#"
                    class="absolute underline z-20 cursor-pointer text-xs text-zinc-100 bottom-4 right-6">Learn more</a>
            </div>
        </div>

    </section>
@endsection
