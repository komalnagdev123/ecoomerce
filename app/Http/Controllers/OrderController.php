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
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    function order_now()
    {
        $user_id = Auth::user()->id;
        $total = $products = DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id','=',$user_id)
            ->sum('products.price');
            return view('ordernow', ['total' => $total]);
    }

    function order_confirm(Request $request)
    {
        $user_id = Auth::user()->id;

        $total_qty = Cart::where('user_id',$user_id)->count();
        $total_amount = $request->final_amt;
        
        $cartCheck = Cart::where('user_id', $user_id)->get();
        
        if (count($cartCheck) > 0) {

            $order_booking_id = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "0123456789";

            for ($i = 0; $i < 8; $i++) {
                $order_booking_id .= $codeAlphabet[mt_rand(0, strlen($codeAlphabet) - 1)];
            }

            //Insert Into Orders Table
            $OrderData = new Order();
            $OrderData->user_id = $user_id;
            $OrderData->order_no = $order_booking_id;
            $OrderData->order_date = \Carbon\Carbon::now();
            $OrderData->estimate_delivery_date = \Carbon\Carbon::now();
            $OrderData->total_qty =  $total_qty;
            $OrderData->ship_price = 0;
            $OrderData->order_status_id = 1;
            $OrderData->total_amount = $total_amount;
            $OrderData->status = 1;
            $OrderData->save();
            $order_id = $OrderData->id;
            // Get Cart Value And Insert In Order Details
            foreach ($cartCheck as $key => $val)
            {
                $OrderDetails = new OrderDetail();
                $OrderDetails->order_id = $order_id;
                $OrderDetails->product_id = $val->product_id; 
                $OrderDetails->qty = 1; 
                $OrderDetails->save();
            }
        }

        //delete from cart table
        Cart::where('user_id',$user_id)->delete();
        return view('payment',['data' => $total_amount, 'order_id' => $order_id]);
    }

    function order_list()
    {
        $user_id = Auth::user()->id;
        // $products = DB::table('orders')->select('products.*','orders.*')
        //     ->join('products','orders.product_id','=','products.id')
        //     ->join('order_details','order_details.product_id','=','products.id')
        //     ->where('orders.user_id','=',$user_id)
        //     ->get();
        return view('orderList');
    }

}
