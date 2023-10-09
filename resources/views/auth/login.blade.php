<x-guest-layout>
    <section class="bg-gray-50 min-h-screen flex items-center justify-center">
        <!-- login container -->
        <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
            <!-- form -->
            <div class="md:w-1/2 px-8 md:px-16">
                <div class="relative flex items-center my-2">
                    <x-application-logo class="mx-0 w-8 mr-2" />
                    <h2 class="font-bold text-2xl custom-border italic text-[#002D74]">{{ __('Login') }}</h2>
                </div>
                <div class="relative h-0.5 mx-auto w-full custom-border-background"></div>

                <p class="text-xs mt-4 text-[#002D74]">{{ __('If you are already a member, easily login') }}</p>

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    <x-text-input id="email" class="p-2 mt-8 rounded-xl border" placeholder="Email" type="email"
                        name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="relative">
                        <x-text-input id="password" class="p-2 rounded-xl border w-full" type="password"
                            name="password" placeholder="Password" required autocomplete="current-password" />
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"
                            class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <button class=" rounded-xl text-black bg-primary-500 py-2 hover:scale-105 duration-300">
                        {{ __('Login') }}
                    </button>
                </form>

                <div class="mt-5 text-xs border-b-2 custom-border py-4 text-[#002D74]">
                    <a href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a>
                </div>

                <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
                    <p>{{ __("Noch kein Konto?") }}</p>
                    <a href="{{ route('register') }}"
                        class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>

            <!-- image -->
            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl"
                     src="{{ public_url('/img/auth.jpg') }}" alt="Login"/>
            </div>
        </div>
    </section>
</x-guest-layout>
