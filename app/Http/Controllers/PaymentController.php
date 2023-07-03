<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use View;
use Session;
use Redirect;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    public function __construct()
    {   
    }
    
    public function index(Request $request)
    { 
        return view('payment');
    }

    public function payment(Request $request)
    { 
        $this->validate($request, [
            'amount' => 'required',
            'purpose' => 'required',
            'buyer_name' => 'required',
            'phone' => 'required',
        ]);
        
        $ch = curl_init();

        // For Live Payment change CURLOPT_URL to https://www.instamojo.com/api/1.1/payment-requests/
       
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_7a89e1fbf1528ce28aca9c8f5eb",
                "X-Auth-Token:test_8f08e70c29f0130edcf83b1053c"));
        $payload = Array(
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'buyer_name' => $request->buyer_name,
            'redirect_url' => url('/returnurl'),
            'send_email' => false,
            'webhook' => 'http://instamojo.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            \Session::put('error','Payment Failed1, Try Again!!');
            return redirect()->back();
        } else {
            $data = json_decode($response);
        }


        if($data->success == true) {
            return redirect($data->payment_request->longurl);
        } else { 
            \Session::put('error','Payment Failed2, Try Again!!');
            return redirect()->back();
        }

    }

    public function returnurl(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_7a89e1fbf1528ce28aca9c8f5eb",
                "X-Auth-Token:test_8f08e70c29f0130edcf83b1053c"));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('payment');
        } else {
            $data = json_decode($response);
        }
        
        if($data->success == true) {
           // dd($data);

            // Add Data in Orders table and delete from cart table
            $user_id = Auth::user()->id;

            $cartItems = Cart::where('user_id',$user_id)->get();
            
            foreach($cartItems as $item)
            {
                $order = new Order();
                $order->product_id = $item->product_id;
                $order->user_id = $item->user_id;
                $order->order_status = 1;
                $order->payment_method = 'Instamojo';
                $order->payment_status = 'Credit';
                $order->save();
            }
            Cart::where('user_id',$user_id)->delete();

            //Insert Into Payment Table
            $payment = new Payment();
            $payment->i_payment_id = $data->payment->payment_id;
            $payment->user_id = $user_id;
            $payment->amount = $data->payment->amount;
            $payment->payment_status = $data->payment->status;
            $payment->save();

            if($data->payment->status == 'Credit') {
                
                // From here you can save respose data in database from $data
            

                \Session::put('success','Your payment has been pay successfully, Enjoy!!');
                return redirect()->route('order_list');

            } else {
                \Session::put('error','Payment Failed, Try Again!!');
                return redirect()->route('order_list');
            }
        } else {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('order_list');
        }
    }

}	
