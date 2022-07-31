<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $newProduct;
    public $newProductVariations = [];
    public $newImage;
    public $images = [];
    public $categories;
    public $sizes;
    public $existingProducts;
    public $addToExistingProduct = [];

    protected $messages = [
        'newProductVariations.required' => 'Debe contener al menos una variación del producto',
        'images.required' => 'Debe contener al menos una imágen'
    ];

    public function mount() {
        $this->categories = Category::all();
        $this->sizes = Size::all();
        $this->newProduct['category'] = 1;
        $this->newImage = ['image' => '', 'alt' => ''];
        $this->existingProducts = Product::select('id', 'groupName')->orderBy('groupName', 'asc')->get();
        $this->addToExistingProduct['active'] = false;
        if(count($this->existingProducts) > 0) $this->addToExistingProduct['id'] = $this->existingProducts[0]->id;
    }

    public function updatedAddToExistingProduct() {
        if($this->addToExistingProduct['active']) {
            $this->validate(['addToExistingProduct.id' => 'required|numeric|exists:products,id']);
            $existingProduct = Product::find($this->addToExistingProduct['id']);
            $excludedSizes = $existingProduct->productVariations->pluck('size_id')->toArray();
            $this->sizes = Size::whereNotIn('id', $excludedSizes)->get();
        }
        else $this->sizes = Size::all();
    }

    public function updatedNewImageImage() {
        $this->newImage['validatedImage'] = $this->newImage['image'];
        $this->newImage['image'] = '';
        $this->validate([
            'newImage.validatedImage' => 'file|image'
        ]);
        $this->newImage['image'] = $this->newImage['validatedImage'];
    }

    public function addImage() {
        $this->validate([
            'newImage.validatedImage' => 'required|file|image'
        ]);
        unset($this->newImage['validatedImage']);
        array_push($this->images, $this->newImage);
        $this->newImage['image'] = '';
        $this->newImage['alt'] = '';
    }

    public function deleteImage($id = '') {
        if(array_key_exists($id, $this->images)) {
            unset($this->images[$id]);
        }
    }

    public function addVariation() {
        array_push($this->newProductVariations, ['size' => 1]);
    }

    public function deleteVariation($id = '') {
        if(array_key_exists($id, $this->newProductVariations)) {
            unset($this->newProductVariations[$id]);
        }
    }

    public function createProduct() {
        if($this->addToExistingProduct['active']) {
            $this->validate([
                'addToExistingProduct.id' => 'required|numeric|exists:products,id',
                'newProductVariations' => 'required',
                'newProductVariations.*.name' => 'required|max:255|min:1|string',
                'newProductVariations.*.description' => 'required|string',
                'newProductVariations.*.size' => 'required|numeric|exists:sizes,id|distinct',
                'newProductVariations.*.price' => 'required|numeric|gte:0|lte:9999999',
                'newProductVariations.*.stock' => 'required|numeric|gte:0|lte:9999999',
            ]);
            $createdProduct = Product::find($this->addToExistingProduct['id']);
        }
        else {
            $this->validate([
                'newProduct.groupName' => 'required|max:255|min:1|string',
                'newProduct.category' => 'required|numeric|exists:categories,id',
                'images' => 'required',
                'newProductVariations' => 'required',
                'newProductVariations.*.name' => 'required|max:255|min:1|string',
                'newProductVariations.*.description' => 'required|string',
                'newProductVariations.*.size' => 'required|numeric|exists:sizes,id|distinct',
                'newProductVariations.*.price' => 'required|numeric|gte:0|lte:9999999',
                'newProductVariations.*.stock' => 'required|numeric|gte:0|lte:9999999',
            ]);
            $createdProduct = Product::create([
                'groupName' => $this->newProduct['groupName'],
                'category_id' => $this->newProduct['category'],
            ]);
            
            foreach($this->images as $image) {
                $uploadedImage = $image['image']->store('products');
                Image::create([
                    'image' => $uploadedImage,
                    'alt' => $image['alt'],
                    'product_id' => $createdProduct->id,
                ]);
            }
        }

        foreach($this->newProductVariations as $newProductVariation) {
            ProductVariation::create([
                'name' => $newProductVariation['name'],
                'slug' => Str::slug($newProductVariation['name']),
                'description' => $newProductVariation['description'],
                'price' => $newProductVariation['price'],
                'stock' => $newProductVariation['stock'],
                'size_id' => $newProductVariation['size'],
                'product_id' => $createdProduct->id,
            ]);
        }

        return redirect()->route('admin.products');
    }

    public function render() {
        return view('livewire.admin.product-create');
    }
}
