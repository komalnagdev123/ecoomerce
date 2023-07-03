<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;
use App\Models\User;
use DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data = Payment::select('*')->orderby('id', 'DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->editColumn('user_id', function ($row) {
                        $customer_name = User::find($row->user_id);
                        return $customer_name->name  ?? '--';
                    })
        
                    ->make(true);
        }
        
        return view('admin.dashbaord');
    }

    function welcome()
    {
        $data = Product::select('*')->orderby('id', 'DESC')->get();
        return view('welcome', ['products' => $data]);
    }
      
}
