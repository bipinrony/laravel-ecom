<?php

namespace App\Helpers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function getCartCount()
    {
        $cartCount = 0;
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->whereNull('order_id')->first();
            if (!empty($cart)) {
                $cartCount = $cart->cartItems->count();
            }
        }
        return $cartCount;
    }
}
