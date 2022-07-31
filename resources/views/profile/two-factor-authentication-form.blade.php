<x-jet-action-section>
    <x-slot name="title">
        Autenticación en dos factores
    </x-slot>

    <x-slot name="description">
        Añade seguridad adicional a tu cuenta utilizando la autenticación en dos factores
    </x-slot>

    <x-slot name="content">
        <h3 class="twoFactorTitle">
            @if ($this->enabled)
                Has activado la autenticación en dos factores
            @else
                No has activado la autenticación en dos factores
            @endif
        </h3>

        <div class="description">
            <p>
                Cuando la autenticación de dos factores está habilitada, se te asignará un token aleatorio seguro durante la autenticación. Puedes recuperar este token de la aplicación Google Authenticator de tu teléfono.
            </p>
        </div>

        @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="description">
                        <p>
                            La autenticación en dos factores se encuentra ahora activada, Escanea el siguiente código QR usando la aplicación autenticadora de tu teléfono
                        </p>
                    </div>

                    <div class="qrContainer">
                        <div class="qrCode">
                            {!! $this->user->twoFactorQrCodeSvg() !!}
                        </div>
                    </div>
                @endif

                @if ($showingRecoveryCodes)
                    <div class="description">
                        <p>
                            Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Se pueden usar para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación de dos factores.
                        </p>
                    </div>

                    <div class="description">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
        @endif

        <div class="actionsContent">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button 
                        class="registerButton"
                        type="submit"
                        wire:loading.attr="disabled">
                        Activar
                    </button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <button 
                            class="registerButton"
                            type="submit"
                            wire:loading.attr="disabled">
                            Volver a generar códigos de Recuperación
                        </button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <button 
                            class="registerButton"
                            type="submit"
                            wire:loading.attr="disabled">
                            Mostrar códigos de recuperación
                        </button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <button 
                        class="cancelButton"
                        type="submit"
                        wire:loading.attr="disabled">
                        Desactivar
                    </button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
