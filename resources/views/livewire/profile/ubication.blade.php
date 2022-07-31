<div class="formSection">
    <div class="titleSection">
        <h3>Información sobre ubicaciones</h3>
        <p class="description">
            Agrega una ubicación a la cual entregar tus productos, recuerda que esta debe ser lo más precisa posible,
            ya que no nos hacemos responsables por envíos a ubicaciones erroneas.
        </p>
        <p class="description">
            La dirección que marques con una estrella será la dirección actual de entrega. Asegúrate de que sea la
            dirección correcta antes de hacer el pedido, dado que no podrás modificarla mientras se realiza el envío
        </p>
        <p class="description">
            Los productos ya enviados no cambiarán su punto de entrega aunque haya una modificación. Si existe algún problema
            con la información específicada a la hora de hacer una compra, contáctanos por cualquera de nustros medios y
            estaremos encantados de atenderte.
        </p>
    </div>

    @if ($activePurchases)
        @foreach ($userAddresses as $userAddress)
            <div class="userAddressContainer">
                <div class="usserAddressInfo">
                    <p><span class="bold">Estado: </span> {{$userAddress->state}}</p>
                    <p><span class="bold">Ciudad: </span> {{$userAddress->city}}</p>
                    <p><span class="bold">Calle y número: </span> {{$userAddress->street}}</p>
                    <p><span class="bold">Código Postal: </span> {{$userAddress->postal_code}}</p>
                </div>
                <div class="userAddressOptions">
                    @if ($userAddress->selected)
                        <div><i class="fas fa-star"></i></div>
                    @else
                        <div
                            id="editAddress.{{$userAddress->id}}"
                            wire:click="editAddress({{$userAddress->id}})">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div
                            id="deleteAddress.{{$userAddress->id}}"
                            wire:click="deleteAddress({{$userAddress->id}})">
                            <i class="fas fa-trash"></i>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        @foreach ($userAddresses as $userAddress)
            <div class="userAddressContainer">
                <div class="usserAddressInfo">
                    <p><span class="bold">Estado: </span> {{$userAddress->state}}</p>
                    <p><span class="bold">Ciudad: </span> {{$userAddress->city}}</p>
                    <p><span class="bold">Calle y número: </span> {{$userAddress->street}}</p>
                    <p><span class="bold">Código Postal: </span> {{$userAddress->postal_code}}</p>
                </div>
                <div class="userAddressOptions">
                    <div
                        id="editAddress.{{$userAddress->id}}"
                        wire:click="editAddress({{$userAddress->id}})">
                        <i class="fas fa-pen"></i>
                    </div>
                    @if ($userAddress->selected)
                        <div><i class="fas fa-star"></i></div>
                    @else
                        <div
                            id="changeSelectedAddress.{{$userAddress->id}}"
                            wire:click="changeSelectedAddress({{$userAddress->id}})">
                            <i class="far fa-star"></i>
                        </div>
                        <div
                            id="deleteAddress.{{$userAddress->id}}"
                            wire:click="deleteAddress({{$userAddress->id}})">
                            <i class="fas fa-trash"></i>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <div class="formContainer">
        <div class="formContent">
            <div class="inputContainer">
                <label for="state" class="loginLabel">Estado:</label>
                <select id="state" name="state" class="loginInput" wire:model="selectedAddress.state">
                    <option value="no">Seleccione uno...</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Ciudad de México">Ciudad de México</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima">Colima</option>
                    <option value="Durango">Durango</option>
                    <option value="Estado de México">Estado de México</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="Michoacán">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select>
                <x-jet-input-error for="selectedAddress.state" class="mt-2" />
            </div>
            <div class="inputContainer">
                <label for="city" class="loginLabel">Ciudad o municipio:</label>
                <input id="city" type="text" class="loginInput" name="city" wire:model.defer="selectedAddress.city">
                <x-jet-input-error for="selectedAddress.city" class="mt-2" />
            </div>
            <div class="inputContainer">
                <label for="street" class="loginLabel">Calle y número:</label>
                <input id="street" type="text" class="loginInput" name="street" wire:model.defer="selectedAddress.street">
                <x-jet-input-error for="selectedAddress.street" class="mt-2" />
            </div>
            <div class="inputContainer">
                <label for="postal_code" class="loginLabel">Código Postal:</label>
                <input
                    id="postal_code"
                    type="number"
                    max="99999"
                    class="loginInput"
                    name="postal_code"
                    wire:model="selectedAddress.postal_code">
                <x-jet-input-error for="selectedAddress.postal_code" class="mt-2" />
            </div>
        </div>
        @if ($existingAddress)
            <button
                class="registerButton"
                wire:click="updateAddress"
                id="updateAddressButton"
                wire:loading.remove
                wire:target="updateAddress, deleteAddress">
                Editar ubicación
            </button>
        @else
            <button class="registerButton" wire:click="createAddress" wire:loading.remove wire:target="createAddress">
                Agregar ubicación
            </button>
        @endif
    </div>
</div>
