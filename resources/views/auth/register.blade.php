<x-guest-layout>
    <x-slot name="title">Registro</x-slot>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label class="loginLabel" for="name">Nombre:</label>
                <input id="name" class="loginInput" type="text" name="name" value="{{old('name')}}" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="email">Correo:</label>
                <input id="email" class="loginInput" type="email" name="email" value="{{old('email')}}" required />
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="password">Contraseña:</label>
                <input id="password" class="loginInput" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label class="loginLabel" for="password_confirmation">Confirmar contraseña:</label>
                <input id="password_confirmation" class="loginInput" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4 terms-privacy">
                <span>* Al crear una cuenta aceptas nuestros</span>
                <a href="{{route('termsAndPrivacy')}}">Términos y Condiciones y Política de Privacidad</a>
                <span>*</span>
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm" href="{{ route('login') }}">
                    ¿Ya tienes una cuenta?
                </a>

                <button class="registerButton" type="submit">Registrarse</button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
