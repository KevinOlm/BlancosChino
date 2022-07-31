<?php

namespace App\Http\Livewire;

use App\Mail\AdminPurchaseOrderMailable;
use App\Mail\PurchaseOrderMailable;
use App\Models\CartSession;
use App\Models\ProductVariation;
use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use App\Models\Shoppingcart;
use App\Models\ShoppingCartProduct;
use App\Models\Size;
use App\Notifications\UserPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ProductOverview extends Component
{
    public $product;
    public $sizes;
    public $actualSize;
    public $quantity = 1;
    public $selectedImage = 0;

    protected $listeners = [
        'render',
        'purchaseConfirmation',
        'redirectToPaymentMethods',
        'redirectToPurchases',
        'redirectToConfiguration',
    ];

    public function mount(ProductVariation $product) {
        $this->product = $product;
        $this->actualSize = $this->product->size_id;
        $sizesId = ProductVariation::where('product_id', '=', $this->product->product_id)->pluck('size_id');
        $this->sizes = Size::whereIn('id', $sizesId)->get();
    }

    public function updatedQuantity() {
        if($this->quantity > $this->product->stock) {
            $this->quantity = $this->product->stock;
        }
    }

    public function updatedActualSize() {
        $this->quantity = 1;
    }

    public function store() {
        if($this->quantity < 1) $this->quantity = 1;

        if (Auth::check()) {
            $cart = Shoppingcart::where('user_id', '=', Auth::user()->id)->first();
            $cartProduct = ShoppingCartProduct::where([
                ['product_variation_id', '=', $this->product->id],
                ['shoppingcart_id', '=', $cart->id],
            ])->first();
            if($cartProduct) {
                if($cartProduct->quantity + $this->quantity > $this->product->stock) {
                    $cartProduct->quantity = $this->product->stock;
                }
                else {
                    $cartProduct->quantity += $this->quantity;
                }
                $cartProduct->subtotal = $this->product->price * $cartProduct->quantity;
                $cartProduct->save();
            }
            else {
                ShoppingCartProduct::create([
                    'shoppingcart_id' => $cart->id,
                    'product_variation_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'subtotal' => $this->product->price * $this->quantity,
                ]);
            }
        }
        else {
            $oldCart = (session()->has('cart'))? session('cart'): null;
            $cart = new CartSession($oldCart);
            $cart->add($this->product, $this->quantity);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart');
    }

    public function purchase(Request $request) {
        if(Auth::check()) {
            if($request->user()->hasPaymentMethod()) {
                if(count(Auth::user()->userAddresses) > 0) {
                    if($this->product->stock > 0) {
                        if($this->quantity < 1) $this->quantity = 1;
                        $amount = $this->quantity * $this->product->price;
                        $this->emit('confirmPurchase', $this->product->name, $this->product->price, $this->quantity, $amount);
                    }
                }
                else $this->emit('noAddress');
            }
            else $this->emit('noPaymentMethod');
        }
    }

    public function purchaseConfirmation(Request $request) {
        if(Auth::check()) {
            if($this->quantity < 1) $this->quantity = 1;
            $amountPesos = ($this->quantity * $this->product->price);
            $amountCentavos = $amountPesos * 100;
            
            $newOrder = PurchaseOrder::create([
                'total' => $amountPesos,
                'user_id' => Auth::user()->id,
                'user_mail' => Auth::user()->email,
            ]);
    
            PurchasedProduct::create([
                'quantity' => $this->quantity,
                'subtotal' => $amountPesos,
                'purchased_price' => $this->product->price,
                'purchased_name' => $this->product->name,
                'purchased_image' => $this->product->product->images[0]->image,
                'purchased_image_alt' => $this->product->product->images[0]->alt,
                'purchase_order_id' => $newOrder->id,
            ]);
    
            $this->product->stock -= $this->quantity;
            $this->product->amountPurchased += $this->quantity;
            $this->product->save();

            $purchases[0] = [
                'quantity' => $this->quantity,
                'subtotal' => $amountPesos,
                'price' => $this->product->price,
                'name' => $this->product->name,
            ];
    
            $userMail = new PurchaseOrderMailable($purchases, $amountPesos);
            $userMail->subject('Tu Recibo de Blancos El Chino');
            Mail::to(Auth::user())->send($userMail);

            $adminMail = new AdminPurchaseOrderMailable($purchases, $amountPesos, Auth::user()->email);
            $adminMail->subject('Nueva compra en Blancos El Chino');
            Mail::to("blancoselchinosj@gmail.com")->send($adminMail);
    
            $request->user()->charge($amountCentavos, $request->user()->defaultPaymentMethod()->id);

            $this->emit('render');
        }
    }

    public function redirectToPaymentMethods() {
        return redirect()->route('billing-portal');
    }

    public function redirectToPurchases() {
        return redirect()->route('purchases');
    }

    public function redirectToConfiguration() {
        return redirect()->route('user.config');
    }

    public function render() {
        $this->product = ProductVariation::where([
            ['product_id', '=', $this->product->product_id],
            ['size_id', '=', $this->actualSize],
        ])->first();

        $this->emit('resize');

        return view('livewire.product-overview');
    }
}
