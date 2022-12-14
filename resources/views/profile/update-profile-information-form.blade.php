<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Información del perfil
    </x-slot>

    <x-slot name="description">
        Actualiza la información del perfil y el correo electrónico
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="inputContainer">
            <label class="loginLabel" for="name">Nombre:</label>
            <input id="name" class="loginInput" type="text" name="name" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" />
        </div>

        <!-- Email -->
        <div class="inputContainer">
            <label class="loginLabel" for="email">Correo:</label>
            <input id="email" class="loginInput" type="email" name="email" wire:model.defer="state.email"/>
            <x-jet-input-error for="email" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message on="saved">
            Guardado
        </x-jet-action-message>

        <button 
            class="registerButton"
            type="submit"
            wire:loading.attr="disabled"
            wire:target="photo">
            Guardar Cambios
        </button>
    </x-slot>
</x-jet-form-section>
