<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de usuarios:</label>
        <p>
            <b>Nota: </b>
            Para mejorar la velocidad de la búsqueda, no se podrá buscar por los siguientes campos:
            Rol
        </p>
        <input
            type="text"
            class="form-control"
            id="searchField"
            placeholder="Introduzca algún término de búsqueda"
            wire:model="search">
    </div>

    <div class="table-responsive mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th 
                        scope="col" 
                        style="cursor: pointer" 
                        wire:click="sort('id')">
                        @if ($sort === 'id')
                            <div class="d-flex justify-content-between align-items-center">
                                ID
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            ID
                        @endif
                    </th>
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('name')">
                        @if ($sort === 'name')
                            <div class="d-flex justify-content-between align-items-center">
                                Nombre
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Nombre
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('email')">
                        @if ($sort === 'email')
                            <div class="d-flex justify-content-between align-items-center">
                                Correo
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Correo
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('created_at')">
                        @if ($sort === 'created_at')
                            <div class="d-flex justify-content-between align-items-center">
                                Fecha de creación
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Fecha de creación
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('user_type')">
                        @if ($sort === 'user_type')
                            <div class="d-flex justify-content-between align-items-center">
                                Rol
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Rol
                        @endif
                    </th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            @switch($user->user_type)
                                @case('admin')
                                    Administrador
                                    @break
                                @case('user')
                                    Usuario
                                    @break
                                @case('user.noComment')
                                    Usuario sin permiso de comentar
                                    @break
                                @default
                                    Eroor
                            @endswitch
                        </td>
                        <th class="d-flex justify-content-center flex-column">
                            @if ($user->user_type === 'admin')
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    wire:click="removeAdmin({{$user->id}})">
                                    Remover administrador
                                </button>
                            @else
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    wire:click="makeAdmin({{$user->id}})">
                                    Hacer administrador
                                </button>
                            @endif
                            @if ($user->user_type === 'user.noComment')
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    wire:click="removeBlockComments({{$user->id}})">
                                    Desbloquear Usuario
                                </button>
                            @else
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    wire:click="blockComments({{$user->id}})">
                                    Bloquear Usuario
                                </button>
                            @endif
                            <button
                                type="button"
                                class="btn btn-dark"
                                wire:click="showAddress({{$user->id}})">
                                Ver dirección y teléfonos
                            </button>
                            <button
                                type="button"
                                class="btn btn-outline-dark"
                                wire:click="deleteUser({{$user->id}})">
                                Eliminar
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$users->links()}}
    </div>
</div>
