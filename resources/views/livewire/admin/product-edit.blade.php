<div>
    {{-- Product group info --}}
    <div class="container p-5 mt-3 border border-info">

        {{-- Tittle --}}
        <div class="row">
            <b class="text-info w-100 text-center" style="font-size: 20px">Datos sobre el modelo</b>
        </div>

        {{-- Note --}}
        <div class="row text-center d-flex justify-content-center mb-3">
            <p>
                <b class="mr-1">Nota:</b>
                Al modificar estos datos, estarás modificando todos los productos relacionados con este modelo.
                Las imágenes funcionan de forma independiente a los demás datos.
            </p>
        </div>

        {{-- Group Name --}}
        <div class="row mb-2">
            <label for="groupName">Nombre del modelo:</label>
            <input
                class="form-control"
                id="groupName"
                type="text"
                wire:model="productGeneral.groupName">
            @error('productGeneral.groupName')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="row mb-3">
            <label for="category">Categoría:</label>
            <select class="form-control" wire:model="productGeneral.category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
            @error('productGeneral.category_id')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        {{-- Images --}}
        <div class="row pt-3">
            <div class="container">

                {{-- Tittle --}}
                <div class="row">
                    <b class="mb-3 text-info w-100 text-center">Edición de Imágenes</b>
                </div>

                {{-- Charging image alert --}}
                <div class="row">
                    <div 
                        class="alert alert-secondary w-100"
                        role="alert"
                        wire:loading wire:target="newImage.image">
                        Cargando la imágen, por favor espera
                    </div>
                </div>

                {{-- New Image --}}
                <div class="row">
                    @if ($newImage['image'])
                        <div style="width: 250px; height:250px;"
                        class="overflow-hidden ml-auto mr-auto mb-3 d-flex justify-content-center align-items-center">
                            <img
                                src="{{$newImage['image']->temporaryUrl()}}"
                                alt="{{$newImage['alt']}}"
                                id="imgPreview"
                                style="width: 100%">
                        </div>
                    @endif
                </div>

                {{-- Image input --}}
                <div class="row">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" wire:model="newImage.image">
                        <label class="custom-file-label" for="customFile">Añade una nueva imágen</label>
                    </div>
                    @error('newImage.validatedImage')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                {{-- Image alt --}}
                <div class="row">
                    <input 
                        class="form-control"
                        id="imageAlt"
                        type="text"
                        placeholder="Añade una descripción a la imágen(Opcional)"
                        wire:model="newImage.alt">
                </div>

                {{-- Upload image button --}}
                <div class="row">
                    <button 
                        type="button" 
                        class="btn btn-info w-100 disabled:opacity" 
                        wire:click="uploadImage"
                        wire:loading.remove
                        wire:target="uploadImage">
                        Subir imágen
                    </button>
                    <div class="btn btn-secondary w-100"
                        wire:loading
                        wire:target="uploadImage">
                        Subiendo imágen
                    </div>
                </div>

                {{-- Uploaded images --}}
                <div class="row mt-3">
                    <div class="w-100 d-flex justify-content-center flex-wrap">
                        @foreach ($images as $image)
                            <div 
                                style="width: 150px; height: 150px" 
                                class="
                                    overflow-hidden position-relative mr-2 mb-2 d-flex justify-content-center align-items-center">
                                @if (count($images) > 1)
                                    <i 
                                        style="cursor: pointer; bottom: 10px; right: 10px; z-index: 1;"
                                        class="fas fa-trash position-absolute text-light"
                                        wire:click="deleteImage({{$image->id}})">
                                    </i>
                                @endif
                                <div class="h-100 w-100 position-absolute bg-dark" style="opacity: 25%"></div>
                                <img src="{{asset('storage/' . $image->image)}}" alt="{{$image->alt}}" style="width: 100%">
                            </div>
                        @endforeach
                        <div 
                            class="alert alert-secondary w-100"
                            role="alert"
                            wire:loading wire:target="deleteImage">
                            Eliminando la imágen, por favor espera
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Variation info --}}
    <div class="container p-5 mt-3 border border-info">

        {{-- Tittle --}}
        <div class="row">
            <b class="mb-3 text-info w-100 text-center" style="font-size: 20px">Datos sobre la variación</b>
        </div>

        {{-- Name --}}
        <div class="row mb-2">
            <label for="name">Nombre:</label>
            <input
                class="form-control"
                id="name"
                type="text"
                wire:model="product.name">
            @error('product.name')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="row mb-2">
            <label for="description">Descripción:</label>
            <input
                class="form-control"
                id="description"
                type="text"
                wire:model="product.description">
            @error('product.description')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        {{-- Price --}}
        <div class="row mb-2">

            {{-- Regular price --}}
            @if ($product->offerActive)
                <div class="col">
                    <label for="oldPrice">Precio regular:</label>
                    <input
                        class="form-control"
                        id="oldPrice"
                        type="number"
                        wire:model="product.oldPrice">
                    @error('product.oldPrice')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            @endif

            {{-- Price --}}
            <div class="col">
                <label for="price">{{($product->offerActive)? 'Precio en oferta' : 'Precio'}}:</label>
                <input
                    class="form-control"
                    id="price"
                    type="number"
                    wire:model="product.price">
                @error('product.price')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{-- Offer active --}}
            <div class="col d-flex align-items-center justify-content-center">
                <div>
                    <input 
                        class="form-check-input ml-0"
                        id="offer"
                        type="checkbox"
                        wire:model="product.offerActive">
                    <label for="offer" class="pl-4">Oferta Activa</label>
                </div>
            </div>

        </div>

        {{-- Stock, Size --}}
        <div class="row mb-2">
            <div class="col">
                <label for="stock">Stock:</label>
                <input
                    class="form-control"
                    id="stock"
                    type="number"
                    wire:model="product.stock">
                @error('product.stock')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col">
                <label for="size">Tamaño:</label>
                <select class="form-control" wire:model="product.size_id">
                    @foreach ($sizes as $size)
                        <option value="{{$size->id}}">{{$size->size}}</option>
                    @endforeach
                </select>
                @error('product.size_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

    </div>

    {{-- Buttons --}}
    <div class="container p-5 mt-3 border border-info">
        <div class="row">
            <button
                type="button"
                class="btn btn-info w-100"
                wire:click="saveChanges"
                wire:loading.remove
                wire:target="saveChanges, cancelChanges">
                Guardar Cambios
            </button>
        </div>
        <div class="row">
            <button
                type="button"
                class="btn btn-secondary w-100"
                wire:click="cancelChanges"
                wire:loading.remove
                wire:target="saveChanges, cancelChanges">
                Reestablecer
            </button>
        </div>
        <div class="row">
            <div
                class="btn btn-secondary w-100"
                wire:loading
                wire:target="saveChanges">
                Guardando cambios
            </div>
            <div
                class="btn btn-secondary w-100"
                wire:loading
                wire:target="cancelChanges">
                Reestableciendo
            </div>
        </div>
        @error('*')
            <p class="text-danger mt-2">Existe algún error en los formularios, verifica que todo esté correcto</p>
        @enderror
    </div>

    {{-- Dummy div for the ending separation --}}
    <div class="p-3"></div>
    
</div>
