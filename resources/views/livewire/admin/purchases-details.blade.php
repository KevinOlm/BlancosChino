<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de productos comprados:</label>
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
                    <th scope="col">Imágen</th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('purchased_name')">
                        @if ($sort === 'purchased_name')
                            <div class="d-flex justify-content-between align-items-center">
                                Producto
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Producto
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('purchased_price')">
                        @if ($sort === 'purchased_price')
                            <div class="d-flex justify-content-between align-items-center">
                                Precio
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Precio
                        @endif
                    </th>
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('quantity')">
                        @if ($sort === 'quantity')
                            <div class="d-flex justify-content-between align-items-center">
                                Cantidad
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Cantidad
                        @endif
                    </th>
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('subtotal')">
                        @if ($sort === 'subtotal')
                            <div class="d-flex justify-content-between align-items-center">
                                Subtotal
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Subtotal
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
                @foreach ($purchasesDetails as $purchaseDetails)
                    <tr>
                        <th scope="row">{{$purchaseDetails->id}}</th>
                        <td>
                            <div 
                                style="width: 100px; height: 100px;" 
                                class="overflow-hidden d-flex justify-content-center align-items-center">
                                <img
                                    style="width: 100%"
                                    src="{{asset('storage/' . $purchaseDetails->purchased_image)}}"
                                    alt="{{$purchaseDetails->purchased_alt}}">
                            </div>
                        </td>
                        <td>
                            <a href="{{route('product-overview', Str::slug($purchaseDetails->purchased_name))}}">
                                {{$purchaseDetails->purchased_name}}
                            </a>
                        </td>
                        <td>${{number_format($purchaseDetails->purchased_price, 2)}}mxn</td>
                        <td>{{$purchaseDetails->quantity}}</td>
                        <td>${{number_format($purchaseDetails->subtotal, 2)}}mxn</td>
                        <td>{{$purchaseDetails->status}}</td>
                        <td>{{$purchaseDetails->created_at}}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-info w-100"
                                wire:click="updateState({{$purchaseDetails->id}})">
                                Actualizar estado
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$purchasesDetails->links()}}
    </div>
</div>
