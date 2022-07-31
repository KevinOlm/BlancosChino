<x-guest-layout>
    <x-slot name="title">Restablecer Contraseña</x-slot>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label class="loginLabel" for="email">Correo:</label>
                <input id="email" class="loginInput" type="email" name="email" value="{{old('email')}}" required autofocus/>
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="password">Contraseña:</label>
                <input id="password" class="loginInput" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="password_confirmation">Confirmar contraseña:</label>
                <input id="password_confirmation" class="loginInput" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <button class="registerButton" type="submit">Restablecer</button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
