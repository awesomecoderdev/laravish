<x-guest-layout>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="mx-auto block">
                <x-application-logo class="w-16 h-20 fill-current text-gray-500" />
            </a>
            <div class="relative w-full">
                <h2 class="font-bold text-2xl custom-border italic text-[#002D74] text-center my-2">{{ __("REGISTRATION") }}</h2>
            </div>
            <div class="relative h-0.5 mx-auto w-2/4 bg-primary-500"></div>
        </x-slot>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full px-2 py-1" type="text" name="name"
                    :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full px-2 py-1" type="email" name="email"
                    :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!--
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full px-2 py-1" type="password" name="password"
                    required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full px-2 py-1" type="password"
                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
-->
            <div class="flex items-center justify-end mt-4">
                <a class=" underline text-sm register-link  " href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
