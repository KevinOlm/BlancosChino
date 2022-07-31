<div>
    {{-- Product group info --}}
    <div class="container p-5 mt-3 border border-info">
        {{-- Tittle --}}
        <div class="row">
            <b class="mb-3 text-info w-100 text-center" style="font-size: 20px">Datos sobre el modelo</b>
        </div>

        {{-- Existing Product Checkbox --}}
        @if (count($existingProducts) > 0)
            <div class="row mb-3 d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="existingProduct" wire:model="addToExistingProduct.active">
                    <label class="form-check-label" for="defaultCheck1">
                        Las variaciones formarán parte de un modelo existente
                    </label>
                </div>
            </div>
        @endif

        @if ($addToExistingProduct['active'])
            {{-- Existing Product Select --}}
            <div class="row">
                <label for="existingProducts">Modelo:</label>
                <select class="form-control" id="existingProducts" wire:model="addToExistingProduct.id">
                    @foreach ($existingProducts as $existingProduct)
                        <option value="{{$existingProduct->id}}">{{$existingProduct->groupName}}</option>
                    @endforeach
                </select>
                @error('addToExistingProduct.id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        @else
            {{-- Group name --}}
            <div class="row mb-2">
                <label for="groupName">Nombre del modelo:</label>
                <input
                    class="form-control"
                    id="groupName"
                    type="text"
                    wire:model="newProduct.groupName">
                @error('newProduct.groupName')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="row mb-3">
                <label for="category">Categoría:</label>
                <select class="form-control" wire:model="newProduct.category">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
                @error('newProduct.category')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{-- Images --}}
            <div class="row">
                <div class="container mb-4 w-100">
                    {{-- Tittle --}}
                    <div class="row">
                        <b class="mb-3 text-info w-100 text-center">Edición de imágenes</b>
                    </div>

                    {{-- Charging image alert --}}
                    <div class="row">
                        <div 
                            class="alert alert-secondary w-100"
                            role="alert"
                            wire:loading
                            wire:target="newImage.image">
                            Cargando la imágen, por favor espera
                        </div>
                    </div>

                    {{-- New Image --}}
                    @if ($newImage['image'])
                        <div class="row">
                            <div
                                style="width: 250px; height:250px;"
                                class="overflow-hidden ml-auto mr-auto mb-3 d-flex justify-content-center align-items-center">
                                <img src="{{$newImage['image']->temporaryUrl()}}" alt="{{$newImage['alt']}}" style="width: 100%">
                            </div>
                        </div>
                    @endif

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
                            wire:click="addImage"
                            wire:loading.remove
                            wire:target="addImage, newImage.image">
                            Añadir imágen
                        </button>
                    </div>

                    {{-- Upload image alert --}}
                    <div class="row">
                        <div class="btn btn-secondary w-100"
                            wire:loading
                            wire:target="addImage">
                            Añadiendo imágen
                        </div>
                    </div>

                    {{-- Uploaded images --}}
                    <div class="row mt-3">
                        <div class="w-100 d-flex justify-content-center flex-wrap">
                            @foreach ($images as $key=>$image)
                                <div
                                    style="width: 150px; height: 150px"
                                    class="overflow-hidden position-relative mr-2 mb-2 d-flex justify-content-center align-items-center">
                                    @if (count($images) > 1)
                                        <i 
                                            style="cursor: pointer; bottom: 10px; right: 10px; z-index: 1;"
                                            class="fas fa-trash position-absolute text-light"
                                            wire:click="deleteImage({{$key}})">
                                        </i>
                                    @endif
                                    <div class="h-100 w-100 position-absolute bg-dark" style="opacity: 25%"></div>
                                    <img src="{{$image['image']->temporaryUrl()}}" alt="{{$image['alt']}}" width="100%">
                                </div>
                            @endforeach
                            <div 
                                class="alert alert-secondary w-100"
                                role="alert"
                                wire:loading wire:target="deleteImage">
                                Eliminando la imágen, por favor espera
                            </div>
                        </div>
                        @error('images')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Variation info --}}
    <div class="container p-5 mt-3 border border-info">
        {{-- Tittle --}}
        <div class="row">
            <b class="mb-3 text-info w-100 text-center" style="font-size: 20px">Crear variaciones del producto</b>
        </div>

        {{-- Variations --}}
        @foreach ($newProductVariations as $key=>$newProductVariation)
            <div class="container p-3">

                {{-- Tittle --}}
                <div class="row">
                    <b class="mb-3 text-info w-100 text-center">
                        Variación {{$key + 1}}
                        <i
                            style="cursor: pointer;"
                            class="fas fa-trash text-info ml-3"
                            wire:click="deleteVariation({{$key}})"></i>
                    </b>
                </div>

                {{-- Name --}}
                <div class="row mb-2">
                    <label for="name.{{$key}}">Nombre:</label>
                    <input
                        class="form-control"
                        id="name.{{$key}}"
                        type="text"
                        wire:model="newProductVariations.{{$key}}.name">
                </div>

                {{-- Description --}}
                <div class="row mb-2">
                    <label for="description.{{$key}}">Descripción:</label>
                    <input
                        class="form-control"
                        id="description.{{$key}}"
                        type="text"
                        wire:model="newProductVariations.{{$key}}.description">
                </div>

                {{-- Size --}}
                <div class="row mb-2">
                    <label for="size.{{$key}}">Tamaño:</label>
                    <select class="form-control" wire:model="newProductVariations.{{$key}}.size">
                        @foreach ($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Price, Stock --}}
                <div class="row mb-2">
                    <div class="col">
                        <label for="price.{{$key}}">Precio:</label>
                        <input
                            class="form-control"
                            id="price.{{$key}}"
                            type="number"
                            wire:model="newProductVariations.{{$key}}.price">
                    </div>
                    <div class="col">
                        <label for="stock.{{$key}}">Stock:</label>
                        <input
                            class="form-control"
                            id="stock.{{$key}}"
                            type="number"
                            wire:model="newProductVariations.{{$key}}.stock">
                    </div>
                </div>
                
            </div>
        @endforeach

        {{-- Add variation button--}}
        <div class="row d-flex justify-content-center">
            <button
                type="button"
                class="btn btn-outline-info"
                id="addVariationButton"
                wire:click="addVariation"
                wire:loading.remove
                wire:target="addVariation">
                Añadir variación
            </button>
        </div>

        {{-- Adding variation alert --}}
        <div class="row d-flex justify-content-center">
            <button
                type="button"
                class="btn btn-outline-secondary"
                id="addingVariationButton"
                wire:loading
                wire:target="addVariation">
                Añadiendo variación
            </button>
        </div>

        {{-- Errors --}}
        <div class="mt-3">
            @error('newProductVariations')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @error('newProductVariations.*.name')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @error('newProductVariations.*.description')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @error('newProductVariations.*.size')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @error('newProductVariations.*.price')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @error('newProductVariations.*.stock')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>

    {{-- Buttons --}}
    <div class="container p-5 mt-3 border border-info">
        <button
            type="button"
            class="btn btn-info w-100"
            wire:click="createProduct">
            Crear Producto
        </button>
        @error('*')
            <p class="text-danger mt-2">Existe algún error en los formularios, verifica que todo esté correcto</p>
        @enderror
    </div>

    {{-- Dummy div for the ending separation --}}
    <div class="p-3"></div>
</div>
