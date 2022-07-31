<div class="formSection">
    <div class="titleSection">
        <h3>Información sobre teléfonos</h3>
        <p class="description">
            Agrega números telefónicos para mantener un mejor contacto. Esta opciñon es completamente opcional, pero nos
            ayuda bastante a la hora de atender tus envíos y responder a tus necesidades.
        </p>
    </div>

    @foreach ($userPhones as $userPhone)
        <div class="userAddressContainer">
            <div class="usserAddressInfo">
                <p><span class="bold">Teléfono: </span> {{$userPhone->phone_number}}</p>
            </div>
            <div class="userAddressOptions">
                <div
                    id="editPhone.{{$userPhone->id}}"
                    wire:click="editPhone({{$userPhone->id}})">
                    <i class="fas fa-pen"></i>
                </div>
                <div
                    id="deletePhone.{{$userPhone->id}}"
                    wire:click="deletePhone({{$userPhone->id}})">
                    <i class="fas fa-trash"></i>
                </div>
            </div>
        </div>
    @endforeach

    <div class="formContainer">
        <div class="formContent">
            <div class="inputContainer">
                <label for="phone_number" class="loginLabel">Número telefónico:</label>
                <input
                    id="phone_number"
                    type="number"
                    class="loginInput"
                    name="phone_number"
                    wire:model="selectedPhone.phone_number">
                <x-jet-input-error for="selectedPhone.phone_number" class="mt-2" />
            </div>
        </div>
        @if ($existingPhone)
            <button
                class="registerButton"
                wire:click="updatePhone"
                id="updatePhoneButton"
                wire:loading.remove
                wire:target="updatePhone, deletePhone">
                Editar teléfono
            </button>
        @else
            <button class="registerButton" wire:click="createPhone" wire:loading.remove wire:target="createPhone">
                Agregar teléfono
            </button>
        @endif
    </div>
</div>
