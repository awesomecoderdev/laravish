<x-guest-layout>
    <section class="bg-gray-50 min-h-screen flex items-center justify-center">
        <!-- login container -->
        <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
            <!-- form -->
            <div class="relative md:w-1/2 px-8 md:px-16">
                <h2 class="font-bold text-2xl text-[#002D74]">{{ __('Reset password') }}</h2>
                <form method="POST" class=" flex flex-col gap-4" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->

                    <x-text-input id="email" class="p-2 rounded-xl border" type="email" name="email"
                        placeholder="{{ __('Email') }}" :value="old('email', $request->email)" required autofocus />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <!-- Password -->
                    <x-text-input id="password" class="p-2 rounded-xl border" type="password" name="password"
                        placeholder="{{ __('Password') }}" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <!-- Confirm Password -->
                    <x-text-input id="password_confirmation" class="p-2 rounded-xl border" type="password"
                        placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>

            <!-- image -->
            <div class="md:block hidden w-1/2">
                <img class="rounded-2xl"
                     src="{{ public_url('/img/auth.jpg') }}" alt="Login"/>
            </div>
        </div>
    </section>
</x-guest-layout>
