<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de Categorías:</label>
        <input
            type="text"
            class="form-control"
            id="searchField"
            placeholder="Introduzca algún término de búsqueda"
            wire:model="searchField">
    </div>

    <button
        type="button"
        class="btn btn-info w-100 mb-3"
        wire:click="createSize">
        Crear nuevo tamaño
    </button>
    
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
                        wire:click="sort('size')">
                        @if ($sort === 'size')
                            <div class="d-flex justify-content-between align-items-center">
                                Tamaño
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Tamaño
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
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <th scope="row">{{$size->id}}</th>
                        <td>{{$size->size}}</td>
                        <td>{{$size->created_at}}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-info w-100"
                                wire:click="updateSize({{$size->id}})">
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary w-100"
                                wire:click="deleteSize({{$size->id}})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$sizes->links()}}
    </div>
</div>
