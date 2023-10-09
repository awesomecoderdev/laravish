<x-guest-layout>
    <section class="bg-gray-50 min-h-screen flex items-center justify-center">
        <!-- login container -->
        <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
            <!-- form -->
            <div class="md:w-1/2 px-8 md:px-16">
                <h2 class="font-bold text-2xl  border-b-2 pb-4 custom-border text-[#002D74]">{{ __('Forgot password') }}
                </h2>


                @if (Session::has('status'))
                    <p class="text-xs mt-4 text-[#002D74]">
                        {{ __('Please check email for the password reset link.') }}
                    </p>
                    <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            <span class="text-sm font-medium">
                            {{ __('Back to login page') }}
                            </span>
                        </a>
                @else
                    <p class="text-xs mt-4 text-black">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </p>
                    <!-- Session Status -->
                    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

                    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                        @csrf

                        <x-text-input id="email" class="p-2 mt-8 rounded-xl border" placeholder="Email"
                            type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <button class=" rounded-xl text-black bg-primary-500 py-2 hover:scale-105 duration-300">
                            {{ __('Send Link') }}
                        </button>
                    </form>
                @endif

            </div>

            <!-- image -->
            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl"
                    src="{{ public_url('/img/auth.jpg') }}" alt="Login"/>
            </div>
        </div>
    </section>
</x-guest-layout>
