<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $product = Product::findOrFail($id);
        return view('stock.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'id' => 'required',
            'new_stock' => 'bail|required|numeric',
        ]);
        $product = Product::findOrFail($request->id);
        $product->stock = $product->stock + $request->new_stock;
        if ($product->save()) {
            \Session::flash('stock_add_message', 'Stock Added Successfully!');
        } else {
            \Session::flash('stock_add_message', 'Stock Adding Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return back();

        // return view('stock.create', ['product' => $product]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
