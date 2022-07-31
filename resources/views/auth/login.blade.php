<x-guest-layout>
    <x-slot name="title">Inicio de Sesión</x-slot>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label class="loginLabel" for="email">Correo:</label>
                <input id="email" class="loginInput" type="email" name="email" value="{{old('email')}}" required autofocus/>
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="password">Contraseña:</label>
                <input id="password" class="loginInput" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm">Recuérdame</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button class="registerButton" type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
