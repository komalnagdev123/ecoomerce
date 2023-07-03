<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Carbon\Carbon;
use DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    { 
        if ($request->ajax()) {

            $data = Order::with('viewOrderDetails')
                            ->where('orders.status',1)
                            ->groupBy('orders.id')->orderby('orders.id', 'DESC')->get();
    
            return DataTables::of($data)
    
            ->editColumn('order_status_id', function ($row) {
                $status_name = OrderStatus::find($row->order_status_id);
                return $status_name->name;
            })

            ->editColumn('customer_name', function ($row) {
                $customer_name = User::find($row->user_id);
                return $customer_name->name ?? '--';
            })

            ->editColumn('order_date', function ($row) {
                return date("d M Y", strtotime($row->created_at));
            })
            ->addColumn('action', function ($row) {
                $updateButton = '<div class="c-pointer">
                        <a href="' . route('order_details', $row->id) .'" title="Edit" class="btn btn-primary">Edit</a></div>';
                return $updateButton;
            })
            ->rawColumns(['order_item','order_status_id','action'])
            ->make(true);
            }
        
        return view('admin.dashbaord');
    }

    function welcome()
    {
        $data = Product::select('*')->orderby('id', 'DESC')->get();
        return view('welcome', ['products' => $data]);
    }

    function order_details($id)
    {
        $orders = Order::find($id);
        $user_id = $orders->user_id;
        $viewOrderDetails = Order::find($id)->viewOrderDetails;
        $productsList = OrderDetail::select('product_id')->where('order_id',$id)->get()->toArray();
        $userDetails = User::find($user_id);
        $orderStatus = OrderStatus::get();

        return view('admin.order_details', ['orders' => $orders, 'viewOrderDetails' => $viewOrderDetails, 'userDetails' => $userDetails, 'orderStatus' => $orderStatus, '$productsList' => $productsList]);
    }

    function changeStatus(Request $request)
    {
        if ($request->ajax()) 
        {     
            $order = Order::find($request->order_id);
            $order->order_status_id = $request->order_status_id;
            $order->save();
            return response()->json(array('success' => true));
        }
    }

      
}
