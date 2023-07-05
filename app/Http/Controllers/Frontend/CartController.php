<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helper;
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


    public function getCount()
    {
        $response = array();
        $response['cart_total'] = Helper::getCartCount();
        return response()->json($response);
    }

    public function addToCart(Product $product, $quantity)
    {
        $response = array();

        $cart = $this->getCart();
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
        if (empty($cartItem)) {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $product->id;
            $cartItem->price = $product->sale_price;
            $cartItem->quantity = $quantity;
        } else {
            $cartItem->quantity = $cartItem->quantity + $quantity;
        }
        $cartItem->save();

        // update cart amount
        $this->updateCartAmount($cart);

        $response['status'] = true;
        $response['message'] = "Product added to cart successfully.";

        return response()->json($response);
    }

    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete();

        // update cart amount
        $this->updateCartAmount($this->getCart());

        return redirect()->route('cart');
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $response = array();
        $request->validate([
            'quantity' => 'required|numeric'
        ]);

        if ($request->quantity) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $response['status'] = true;
            $response['message'] = "Quantity updated successfully";
        } else {
            $cartItem->delete();

            $response['status'] = true;
            $response['message'] = "Item removed successfully.";
        }

        // update cart amount
        $this->updateCartAmount($this->getCart());

        return response()->json($response);
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

    public function updateCartAmount($cart)
    {

        $cartItems = $cart->cartItems;
        $subTotal = 0;
        $taxAmount = 0;
        foreach ($cartItems as $cartItem) {
            $amount = $cartItem->quantity * $cartItem->price;
            $subTotal = $subTotal + ($amount);
            // cart item -> product
            // product->category
            // $category->tax
            $tax = 18;
            $taxAmount = $taxAmount + (($tax / 100) * $amount);
        }
        $cart->sub_total = $subTotal;
        $cart->tax = $taxAmount;
        $cart->total = $subTotal + $taxAmount;
        $cart->save();
    }
}
