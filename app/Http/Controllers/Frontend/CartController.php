<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = "Cart";
        $data['cart'] = $this->getCart();
        return view('frontend.cart', $data);
    }

    public function addToCart(Product $product)
    {
        $cart = $this->getCart();
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
        if (empty($cartItem)) {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
            $cartItem->price = $product->sale_price;
            $cartItem->quantity = 1;
        } else {
            $cartItem->quantity = $cartItem->quantity + 1;
        }
        $cartItem->save();

        return redirect()->route('cart');
    }

    public function getCart()
    {
        $userId = auth()->user()->id;
        $cart = Cart::where('user_id', $userId)->whereNull('order_id')->first();
        if (empty($cart)) {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();
        }
        return $cart;
    }
}
