@extends('layouts.app')
@section('content')
    {{-- start slider --}}
    <div class="relative w-full bg-zinc-100 ">
        <div class="relative h-full w-full max-w-6xl mx-auto py-6 flex items-center">
            <div class="relative w-full">
                <div class="relative h-full space-y-2  py-4">
                    <p class="text-lg font-semibold">Personlich,chenell,bequen</p>
                    <h1 class="text-zinc-800 text-5xl font-extrabold text-balance max-w-sm py-4">Deine Sachen Zuruck zu Dir
                    </h1>
                    <br>
                    <a href="#"
                        class=" bg-blue-300 mt-6 px-3 py-2 rounded-full text-white text-sm font-semibold border border-slate-100">Get
                        yours
                        now</a>
                </div>
                <div class="relative w-full flex gap-2 justify-center items-center pt-6">
                    <div class="h-4 w-4 rounded-full border-2 border-pink-600 bg-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 border-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 border-pink-600"></div>
                    <div class="h-4 w-4 rounded-full border-2 border-pink-600"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
    {{-- end slider --}}
    @if (have_posts())
        @while (have_posts())
            @php the_post(); @endphp
            <h1>{!! the_title() !!}</h1>
            {{-- {!! the_content() !!} --}}
        @endwhile
    @endif
@endsection
