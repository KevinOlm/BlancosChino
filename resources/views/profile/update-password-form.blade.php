<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        Cambiar contraseña
    </x-slot>

    <x-slot name="description">
        Asegúrate de que tu contraseña cuente con al menos una letra Mayúscula,
        un número y ocho caracteres para mantenerte seguro.
    </x-slot>

    <x-slot name="form">
        <div class="inputContainer">
            <label class="loginLabel" for="current_password">Contraseña actual:</label>
            <input 
                id="current_password" 
                class="loginInput" 
                type="password" 
                name="current_password" 
                autocomplete="current-password"
                wire:model.defer="state.current_password"/>
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="inputContainer">
            <label class="loginLabel" for="password">Nueva contraseña:</label>
            <input 
                id="password" 
                class="loginInput" 
                type="password" 
                name="password" 
                autocomplete="new-password"
                wire:model.defer="state.password"/>
            <x-jet-input-error for="current_password" class="mt-2" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="inputContainer">
            <label class="loginLabel" for="password_confirmation">Confirmación de contraseña:</label>
            <input 
                id="password_confirmation" 
                class="loginInput" 
                type="password" 
                name="password_confirmation" 
                autocomplete="new-password"
                wire:model.defer="state.password_confirmation"/>
            <x-jet-input-error for="current_password" class="mt-2" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
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
