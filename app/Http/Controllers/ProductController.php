<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use Image;
use File;
use Illuminate\Contracts\Session\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::where('is_deleted', 0)->latest()->get();
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'title' => 'bail|required|max:255',
            'description' => 'max:1000',
            'category' => 'required',
            'quantity' => 'required',
            'art_no' => 'required',
            'price' => 'required',
            'customFile' => 'bail|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('customFile')) {
            $image           = $request->file('customFile');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $file_path       = 'public/uploads/'.$name;
            $image->move($destinationPath, $name);
        }

        $is_in_service = 0;
        $product = new Product();
        $product->title       = $request->title;
        $product->description = $request->description;
        $product->category    = json_encode($request->category);
        $product->stock       = $request->quantity;
        $product->art_no      = $request->art_no;
        $product->unit_price  = $request->price;

        // return $product;
        if ($request->is_in_service) {
            $is_in_service = $request->is_in_service;
        }
        $product->is_in_service  = $is_in_service;

        if (isset($file_path)) {
            $product->image_path  = $file_path;
        } else {
            $product->image_path  = 'public/uploads/default.png';
        }
        if ($product->save()) {
            \Session::flash('product_add_message', 'Product Added Successfully!');
        } else {
            \Session::flash('product_add_message', 'Product Adding Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return back();
        // return redirect('edit_url_slug')->with('success','Profile Updated Successfully');
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
    public function edit($id) {
        $product = Product::findOrFail($id);
        // dd($product);
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'bail|required|max:255',
            'description' => 'max:1000',
            'quantity' => 'required',
            'art_no' => 'required',
            'price' => 'required',
            'customFile' => 'bail|mimes:png,jpg,jpeg|max:2048',
        ]);

        $is_in_service = 0;
        $product = Product::findOrFail($id);
        if ($request->hasFile('customFile')) {
            $image           = $request->file('customFile');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $file_path       = 'public/uploads/'.$name;
            $image->move($destinationPath, $name);

            if (isset($file_path)) {
                $product->image_path  = $file_path;
            } else {
                $product->image_path  = 'public/uploads/default.png';
            }
        }

        $product->title       = $request->title;
        $product->description = $request->description;
        $product->category    = json_encode($request->category);
        $product->stock       = $request->quantity;
        $product->art_no      = $request->art_no;
        $product->unit_price  = $request->price;
        if ($request->is_in_service) {
            $is_in_service = $request->is_in_service;
        }
        $product->is_in_service  = $is_in_service;

        if ($product->save()) {
            \Session::flash('product_update_message', 'Product Update Successfully!');
        } else {
            \Session::flash('product_update_message', 'Product Updating Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $products = Product::where('is_deleted', 0)->latest()->get();
        return view('product.index', ['products' => $products]);
    }

    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->is_deleted = 1;
        if ($product->save()) {
            \Session::flash('product_delete_message', 'Product Deleted Successfully!');
        } else {
            \Session::flash('product_delete_message', 'Product Deleted Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        // dd($product);
        $products = Product::where('is_deleted', 0)->latest()->get();
        return redirect()->route('products.index', ['products' => $products]);
    }
}
