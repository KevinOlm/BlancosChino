<x-guest-layout>
    <x-slot name="title">Contraseña Olvidada</x-slot>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <div class="mb-4 text-sm text-gray-600">
            <span>¿Olvidaste tu contraseña? Déjanos tu correo y nosotros te ayudamos a recuperarla!</span>
            {{-- {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} --}}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label class="loginLabel" for="email">Correo:</label>
                <input id="email" class="loginInput" type="email" name="email" value="{{old('email')}}" required autofocus/>
            </div>

            <div class="flex items-center justify-end mt-6">
                <button class="registerButton" type="submit">Enviar un correo</button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
