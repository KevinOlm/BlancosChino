<?php

namespace App\Actions\Fortify;

use App\Models\ProductVariation;
use App\Models\Shoppingcart;
use App\Models\ShoppingCartProduct;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 
                function($attribute, $value, $fail) {
                    $domain = explode('@', $value);
                    $domain = end($domain);

                    if(!str_contains($domain, '.')) {
                        $fail('El dominio de su correo no es válido');
                    }
                },
            ],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        if(session()->has('cart')) {
            $cart = session('cart');
            $dbCart = Shoppingcart::create([
                'user_id' => $user->id,
            ]);

            foreach($cart->items as $cartProduct) {
                $product = ProductVariation::find($cartProduct->id);
                if($product) {
                    if($cartProduct->quantity > $product->stock) {
                        $cartProduct->quantity = $product->stock;
                        $cartProduct->subtotal = $product->stock * $product->price;
                    }
                    ShoppingCartProduct::create([
                        'quantity' => $cartProduct->quantity,
                        'subtotal' => $cartProduct->subtotal,
                        'shoppingcart_id' => $dbCart->id,
                        'product_variation_id' => $cartProduct->id,
                    ]);
                }
            }
        }
        else {
            Shoppingcart::create([
                'user_id' => $user->id,
            ]);
        }

        $user->createAsStripeCustomer();

        return $user;
    }
}
