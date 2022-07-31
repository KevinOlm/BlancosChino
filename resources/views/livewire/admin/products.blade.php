<div>
    <div class="form-group">
        <label for="searchField">Búsqueda de Productos:</label>
        <p>
            <b>Nota: </b>
            Para mejorar la velocidad de la búsqueda, no se podrá buscar por los siguientes campos:
            oferta activa, stock, comprados y calificación.
        </p>
        <input
            type="text"
            class="form-control"
            id="searchField"
            placeholder="Introduzca algún término de búsqueda"
            wire:model="searchField">
    </div>

    <a class="btn btn-info w-100 mb-3" href="{{route('admin.productCreate')}}">
        Crear nuevo modelo
    </a>
    
    <div class="table-responsive mb-3">
        <table class="table">
            <thead>
                <tr>
                    {{-- ID --}}
                    <th 
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('product_variations.id')">
                        @if ($sort === 'product_variations.id')
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
                    {{-- Name --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('product_variations.name')">
                        @if ($sort === 'product_variations.name')
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
                    {{-- Group name --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('products.groupName')">
                        @if ($sort === 'products.groupName')
                            <div class="d-flex justify-content-between align-items-center">
                                Modelo
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Modelo
                        @endif
                    </th>
                    {{-- Size --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('sizes.size')">
                        @if ($sort === 'sizes.size')
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
                    {{-- Category --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('categories.category')">
                        @if ($sort === 'categories.category')
                            <div class="d-flex justify-content-between align-items-center">
                                Categoría
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Categoría
                        @endif
                    </th>
                    {{-- Price --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('product_variations.price')">
                        @if ($sort === 'product_variations.price')
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
                    {{-- Offer --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('product_variations.offerActive')">
                        @if ($sort === 'product_variations.offerActive')
                            <div class="d-flex justify-content-between align-items-center">
                                Oferta activa
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Oferta activa
                        @endif
                    </th>
                    {{-- Stock --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('product_variations.stock')">
                        @if ($sort === 'product_variations.stock')
                            <div class="d-flex justify-content-between align-items-center">
                                Stock
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Stock
                        @endif
                    </th>
                    {{-- Purchased --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('product_variations.amountPurchased')">
                        @if ($sort === 'product_variations.amountPurchased')
                            <div class="d-flex justify-content-between align-items-center">
                                Comprados
                                @if ($direction === 'asc')
                                    <i class="fas fa-sort-down ml-2"></i>
                                @else
                                    <i class="fas fa-sort-up ml-2"></i>
                                @endif
                            </div>
                        @else
                            Comprados
                        @endif
                    </th>
                    {{-- Calification --}}
                    <th
                        scope="col" 
                        style="cursor: pointer"
                        wire:click="sort('products.calification')">
                        @if ($sort === 'products.calification')
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
                    {{-- Creation --}}
                    <th
                        scope="col"
                        style="cursor: pointer"
                        wire:click="sort('product_variations.created_at')">
                        @if ($sort === 'product_variations.created_at')
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
                    {{-- Options --}}
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->groupName}}</td>
                        <td>{{$product->size}}</td>
                        <td>{{$product->category}}</td>
                        <td>${{number_format($product->price, 2)}}mxn</td>
                        <td>{{($product->offerActive)? 'Sí' : 'No'}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->amountPurchased}}</td>
                        <td>{{number_format($product->calification, 1)}} de {{$product->calificationNumber}} usuarios</td>
                        <td>{{$product->created_at}}</td>
                        <td>
                            <a class="btn btn-info w-100" href="{{route('admin.productEdit', $product->id)}}">
                                Editar
                            </a>
                            <button
                                type="button"
                                class="btn btn-secondary w-100"
                                wire:click="deleteProduct({{$product->id}})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center pb-3">
        {{$products->links()}}
    </div>
</div>
