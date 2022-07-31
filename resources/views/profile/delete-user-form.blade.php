<x-jet-action-section>
    <x-slot name="title">
        Eliminar cuenta
    </x-slot>

    <x-slot name="description">
        Elimina permanentemente tu cuenta
    </x-slot>

    <x-slot name="content">
        <div class="description">
            Una vez que se elimine tu cuenta, todos tus recursos y datos se eliminarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
        </div>

        <div class="mt-5">
            <button 
                class="cancelButton"
                type="submit"
                wire:loading.attr="disabled"
                wire:click="confirmUserDeletion">
                Borrar cuenta
            </button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                Borrar cuenta
            </x-slot>

            <x-slot name="content">
                <p class="description">
                    ¿Estás seguro de que deseas eliminar tu cuenta? Una vez que se elimine tu cuenta, todos tus recursos y datos se eliminarán permanentemente. Ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.
                </p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" class="loginInput"
                                placeholder="Contraseña"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="errorMessage" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button 
                    class="registerButton"
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:click="$toggle('confirmingUserDeletion')">
                    Cancelar
                </button>

                <button 
                    class="cancelButton"
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:click="deleteUser">
                    Borrar cuenta
                </button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
