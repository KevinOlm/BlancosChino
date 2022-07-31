<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de compras:</label>
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
                        wire:click="sort('user_mail')">
                        @if ($sort === 'user_mail')
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
                        wire:click="sort('total')">
                        @if ($sort === 'total')
                            <div class="d-flex justify-content-between align-items-center">
                                Total
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Total
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('status')">
                        @if ($sort === 'status')
                            <div class="d-flex justify-content-between align-items-center">
                                Estado
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Estado
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('created_at')">
                        @if ($sort === 'created_at')
                            <div class="d-flex justify-content-between align-items-center">
                                Fecha de la orden
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Fecha de la orden
                        @endif
                    </th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <th scope="row">{{$purchase->id}}</th>
                        <td>{{$purchase->user_mail}}</td>
                        <td>${{number_format($purchase->total, 2)}}mxn</td>
                        <td>{{$purchase->status}}</td>
                        <td>{{$purchase->created_at}}</td>
                        <td>
                            <a
                                class="btn btn-info w-100"
                                href="{{route('admin.purchasesDetails', $purchase->id)}}">
                                Ver detalles
                            </a>
                            <button
                                type="button"
                                class="btn btn-secondary w-100"
                                wire:click="updateState({{$purchase->id}})">
                                Actualizar estado
                            </button>
                            @if ($purchase->user_id)
                                <button
                                    type="button"
                                    class="btn btn-dark w-100"
                                    wire:click="showAddress({{$purchase->user_id}})">
                                    Ver dirección y teléfonos
                                </button>
                            @else
                                <button
                                    type="button"
                                    class="btn btn-light w-100">
                                    Este usuario ha sido eliminado
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$purchases->links()}}
    </div>
</div>
