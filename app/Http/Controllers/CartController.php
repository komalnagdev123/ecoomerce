<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;



class CartController extends Controller
{
    function add_to_cart(Request $request)
    {
        $user_id = Auth::user()->id;

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = $user_id;
        $cart->save();
        return redirect()->back()->with('success_message', 'Product Added Successfully to cart!');
    }

    public static function cartTotal()
    {
        $user_id = Auth::user()->id;
        return Cart::where('user_id',$user_id)->count();
    }

    public static function checkCartProduct($product_id)
    {
        $user_id = Auth::user()->id;
        $product = Cart::where('product_id',$product_id)->where('user_id',$user_id)->first();
        if(isset($product)) return true; else return false;
    }

    public function cart_list()
    {
        $user_id = Auth::user()->id;
        $products = DB::table('cart')->select('products.*','cart.id')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id','=',$user_id)
            ->get();
            return view('cartList', ['products' => $products]);
    }

    function remove_cart(Request $request)
    {
        cart::destroy($request->cart_id);
        return redirect()->back()->with('success_message', 'Product deleted Successfully from cart!');
    }

    
}
