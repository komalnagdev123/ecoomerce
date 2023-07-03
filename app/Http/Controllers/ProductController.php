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
use DataTables;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*')->orderby('id', 'DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
                        $delete = route('products.delete', $row->id);

                        $editbutton = '<div class="c-pointer">
                        <a href="' . route('products.edit', $row->id) .'" title="Edit" class="btn btn-primary">Edit</a></div>';
                        
                        $deletebutton  = '<div class="c-pointer">
                        <a href="' . $delete .'" title="Edit" class="btn btn-danger" onclick="return confirm(`Are you Sure?`)">Delete</a></div>';

                        $action = '<div class="d-flex btnCenter">' . $editbutton . $deletebutton . ' </div>';
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:products,name',
            'price' => 'required|numeric',
            'image' => "nullable|dimensions:max_width=500,max_height=500, min_width:150,min_height=150|mimes:jpeg,png,jpg",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // creating Folder if not exists
            $destinationPath = public_path('/storage/products/');

            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
            }

            $fileName = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/storage/products/', $fileName);
            }

            $product = new Product();
            $product->image = $fileName;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = ($request->description != null || $request->description != '') ? $request->description : '';
            $product->status = 1;
            $product->save();
            return redirect()->route('products.index')->with('success_message', 'Product Added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if (!empty($product)) {
            return view('products.edit', ['product' => $product]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = ($request->description != null || $request->description != '') ? $request->description : '';
            $product->status = 1;
            $product->save();
            return redirect()->route('products.index')->with('success_message', 'Product Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if (!empty($product)) {

            // First deleting older images from folder before deleting
            if (!is_null($product->image)) {
                if (File::exists(public_path('/storage/products/' . $product->image))) {
                    // Delete it from main folder
                    File::delete(public_path('/storage/products/' . $product->image));
                }
                if ($product->delete()) {
                    return redirect()->route('products.index')->with('success_message', 'Product Deleted Successfully!'); 
                }
            }
        }
    }

    }
