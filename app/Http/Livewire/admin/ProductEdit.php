<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Image;
use App\Models\ProductVariation;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $productGeneral;
    public $sizes;
    public $categories;
    public $images;
    public $newImage;

    protected $rules = [
        'productGeneral.groupName' => 'required|max:255|min:1|string',
        'productGeneral.category_id' => 'required|numeric|exists:categories,id',
        'product.name' => 'required|max:255|min:1|string',
        'product.description' => 'required|string',
        'product.price' => 'required|numeric|gte:0|lte:9999999',
        'product.oldPrice' => 'required|numeric|gte:0|lte:9999999',
        'product.offerActive' => 'required|boolean',
        'product.stock' => 'required|numeric|gte:0|lte:9999999',
        'product.size_id' => 'required|numeric|exists:sizes,id',
    ];

    public function mount($product) {
        $this->product = $product;
        $this->productGeneral = $this->product->product;
        $excludedSizes = $this->productGeneral->productVariations->pluck('size_id')->toArray();
        unset($excludedSizes[array_search($this->product->size_id, $excludedSizes)]);
        $this->sizes = Size::whereNotIn('id', $excludedSizes)->get();
        $this->categories = Category::all();
        $this->images = Image::where('product_id', $this->product->product->id)->get();
        $this->newImage['image'] = '';
        $this->newImage['alt'] = '';
    }

    public function saveChanges() {
        $this->validate();
        $this->productGeneral->save();
        $this->product->slug = Str::slug($this->product->name);
        $this->product->save();
        return redirect()->route('admin.productEdit', $this->product->id);
    }

    public function cancelChanges() {
        $this->product = ProductVariation::find($this->product->id);
        $this->productGeneral = $this->product->product;
    }

    public function updatedProductOfferActive() {
        if($this->product->offerActive) {
            $this->product->oldPrice = $this->product->price;
            $this->product->price = 1.00;
        }
        else {
            $this->product->price = $this->product->oldPrice;
            $this->product->oldPrice = 1.00;
        }
    }

    public function updatedNewImageImage() {
        $this->newImage['validatedImage'] = $this->newImage['image'];
        $this->newImage['image'] = '';
        $this->validate([
            'newImage.validatedImage' => 'file|image'
        ]);
        $this->newImage['image'] = $this->newImage['validatedImage'];
    }

    public function uploadImage() {
        $this->validate([
            'newImage.validatedImage' => 'required|file|image'
        ]);
        $uploadedImage = $this->newImage['image']->store('products');
        Image::create([
            'image' => $uploadedImage,
            'alt' => $this->newImage['alt'],
            'product_id' => $this->product->product->id,
        ]);
        $this->images = Image::where('product_id', $this->product->product->id)->get();
        $this->newImage['image'] = '';
        $this->newImage['validatedImage'] = '';
        $this->newImage['alt'] = '';
    }

    public function deleteImage($id = 0) {
        if($id > 0) {
            $deletedImage = Image::find($id);
            if($deletedImage) {
                $deletedImage->delete();
                $this->images = Image::where('product_id', $this->product->product->id)->get();
            }
        }
    }

    public function render() {
        return view('livewire.admin.product-edit');
    }
}
