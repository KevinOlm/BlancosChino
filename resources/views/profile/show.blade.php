<x-main>
    @push('styles')
        <link rel="stylesheet" href="{{mix('css/pages/configuration.css')}}">
    @endpush
    <x-slot name="title">Configuración</x-slot>
    <div class="configurationContainer">
        <h1>Configuración</h1>

        <div class="configurationContent">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif
            <hr>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')
            @endif
            <hr>

            @livewire('profile.ubication')
            <hr>

            @livewire('profile.phones')
            <hr>

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                @livewire('profile.two-factor-authentication-form')
            @endif
            <hr>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
            <hr>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-main>
