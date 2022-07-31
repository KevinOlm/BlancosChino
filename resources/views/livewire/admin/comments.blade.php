<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de productos:</label>
        <input
            type="text"
            class="form-control"
            id="searchField"
            placeholder="Introduzca algún término de búsqueda"
            wire:model="searchField">
    </div>
    
    <div class="table-responsive mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th 
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('reviews.id')">
                        @if ($sort === 'reviews.id')
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
                        wire:click="sort('users.name')">
                        @if ($sort === 'users.name')
                            <div class="d-flex justify-content-between align-items-center">
                                Usuario
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Usuario
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('products.groupName')">
                        @if ($sort === 'products.groupName')
                            <div class="d-flex justify-content-between align-items-center">
                                Grupo de productos
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Grupo de productos
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('reviews.review')">
                        @if ($sort === 'reviews.review')
                            <div class="d-flex justify-content-between align-items-center">
                                Calificación
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Calificación
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('reviews.comment')">
                        @if ($sort === 'reviews.comment')
                            <div class="d-flex justify-content-between align-items-center">
                                Comentario
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Comentario
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('reviews.created_at')">
                        @if ($sort === 'reviews.created_at')
                            <div class="d-flex justify-content-between align-items-center">
                                Fecha de la reseña
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Fecha de la reseña
                        @endif
                    </th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{$comment->id}}</th>
                        <td>{{$comment->name}}</td>
                        <td>{{$comment->groupName}}</td>
                        <td>{{$comment->review}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-info w-100"
                                wire:click="editComment({{$comment->id}})">
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary w-100"
                                wire:click="eliminateComment({{$comment->id}})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$comments->links()}}
    </div>
</div>
