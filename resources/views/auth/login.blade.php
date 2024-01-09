<x-guest-layout>

<div class="flex justify-center items-center h-screen bg-gray-300">
        <x-authentication-card class="bg-white p-8 rounded-md shadow-md">
            <x-slot name="logo">

            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-300">

                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />

                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-200 hover:text-gray-500 focus:outline-none" href="{{ route('password.request') }}">                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Iniciar sesion') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    </div>

</x-guest-layout>
