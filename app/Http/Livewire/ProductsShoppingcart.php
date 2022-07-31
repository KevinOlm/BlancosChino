<?php

namespace App\Http\Livewire;

use App\Mail\AdminPurchaseOrderMailable;
use App\Mail\PurchaseOrderMailable;
use App\Models\CartSession;
use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use App\Models\Shoppingcart;
use App\Models\ShoppingCartProduct;
use App\Notifications\UserPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsShoppingcart extends Component
{
    use WithPagination;

    public $loaded = false;
    public $cartProducts;

    protected $listeners = [
        'render',
        'cleanCartConfirmation',
        'redirectToPaymentMethods',
        'redirectToPurchases',
        'redirectToProducts',
        'purchaseConfirmation',
        'redirectToConfiguration',
    ];

    public function pageLoaded() {
        $this->loaded = true;
    }

    public function cleanCart() {
        $this->emit('cleanCartWarning');
    }

    public function purchase(Request $request) {
        if(Auth::check()) {
            if($request->user()->hasPaymentMethod()) {
                if(count($this->cartProducts)) {
                    if(count(Auth::user()->userAddresses) > 0) {
                        $htmlSummary = '';
                        foreach($this->cartProducts as $cartProduct) {
                            $htmlSummary .=
                                '<div class="productSummary">' .
                                    '<p class="popUpDescription"><span class="bold">Producto: </span>' .
                                        $cartProduct->product->name .
                                    '</p>' .
                                    '<p class="popUpDescription"><span class="bold">Precio Individual: </span>$' .
                                        number_format($cartProduct->product->price, 2) .
                                    'mxn</p>' .
                                    '<p class="popUpDescription"><span class="bold">Cantidad: </span>' .
                                        $cartProduct->quantity .
                                    '</p>' .
                                    '<p class="popUpDescription"><span class="bold">Subtotal: </span>$' .
                                        number_format($cartProduct->subtotal, 2) .
                                    'mxn</p>' .
                                '</div>';
                        }
                        $total = number_format($this->cartProducts[0]->shoppingcart->total, 2);
                        $this->emit('confirmPurchase', $htmlSummary, $total);
                    }
                    else $this->emit('noAddress');
                }
                else $this->emit('noCartProducts');
            }
            else $this->emit('noPaymentMethod');
        }
    }

    public function cleanCartConfirmation() {
        if(Auth::check()) {
            if($this->cartProducts) foreach($this->cartProducts as $cartProduct) $cartProduct->delete();
        }
        else session()->forget('cart');
    }

    public function purchaseConfirmation(Request $request) {
        if(Auth::check()) {
            $purchases = [];
            $cart = Shoppingcart::where('user_id', '=', Auth::user()->id)->first();
            $amountCentavos = $cart->total * 100;
    
            $newOrder = PurchaseOrder::create([
                'total' => $cart->total,
                'user_id' => Auth::user()->id,
                'user_mail' => Auth::user()->email,
            ]);
    
            foreach($this->cartProducts as $cartProduct) {
                PurchasedProduct::create([
                    'quantity' => $cartProduct->quantity,
                    'subtotal' => $cartProduct->subtotal,
                    'purchased_price' => $cartProduct->product->price,
                    'purchased_name' => $cartProduct->product->name,
                    'purchased_image' => $cartProduct->product->product->images[0]->image,
                    'purchased_image_alt' => $cartProduct->product->product->images[0]->alt,
                    'purchase_order_id' => $newOrder->id,
                ]);
    
                $cartProduct->product->stock -= $cartProduct->quantity;
                $cartProduct->product->amountPurchased += $cartProduct->quantity;
                $cartProduct->product->save();
                array_push($purchases, [
                    'quantity' => $cartProduct->quantity,
                    'subtotal' => $cartProduct->subtotal,
                    'price' => $cartProduct->product->price,
                    'name' => $cartProduct->product->name,
                ]);
            }

            $mail = new PurchaseOrderMailable($purchases, $cart->total);
            $mail->subject('Tu Recibo de Blancos El Chino');
            Mail::to(Auth::user())->send($mail);

            $adminMail = new AdminPurchaseOrderMailable($purchases, $cart->total, Auth::user()->email);
            $adminMail->subject('Nueva compra en Blancos El Chino');
            Mail::to("blancoselchinosj@gmail.com")->send($adminMail);
    
            $request->user()->charge($amountCentavos, $request->user()->defaultPaymentMethod()->id);
    
            $this->cleanCartConfirmation();
        }
    }

    public function redirectToPaymentMethods() {
        return redirect()->route('billing-portal');
    }

    public function redirectToPurchases() {
        return redirect()->route('purchases');
    }

    public function redirectToProducts() {
        return redirect()->route('products');
    }

    public function redirectToConfiguration() {
        return redirect()->route('user.config');
    }

    public function render() {
        $this->cartProducts = [];
        if(Auth::check()) {
            $cart = Shoppingcart::where('user_id', '=', Auth::user()->id)->first();
            $this->cartProducts = ShoppingCartProduct::where('shoppingcart_id', '=', $cart->id)->get();
        }
        else {
            $cart = (session()->has('cart'))? session('cart'): (object) ['items' => [], 'total' => 0];
            $this->cartProducts = $cart->items;
        }
        $total = $cart->total;
        return view('livewire.products-shoppingcart', compact('total'));
    }
}
