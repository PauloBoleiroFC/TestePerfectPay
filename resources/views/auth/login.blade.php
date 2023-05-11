<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img src="{{url('img/perfect-pay-logo.webp')}}" width="150px" />
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <a href="{{url('/')}}">Voltar</a>
                <x-button class="ml-3">
                    Logar
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
