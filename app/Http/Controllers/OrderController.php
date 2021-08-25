<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
                    ->where('orders.is_deleted', '=', 0)
                    ->latest()
                    ->get();
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.id as cid', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
                    ->where('orders.id', '=', $id)
                    ->where('orders.is_deleted', '=', 0)
                    ->first();

        $settings = Setting::findOrFail(1);
        $invoice = Invoice::where('order_id', $order->id)->first();
        $products = DB::table('order_products')
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->where('order_products.order_id', $id)
                            ->select('order_products.*', 'products.*')
                            ->get();

        return view('order.show', [
            'order' => $order,
            'settings' => $settings,
            'invoice' => $invoice,
            'products' => $products,
        ]);
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

    public function delete($id) {
        $order = Order::findOrFail($id);
        $order->is_deleted = 1;
        if ($order->save()) {
            \Session::flash('order_delete_message', 'Order Cancelled Successfully!');
        } else {
            \Session::flash('order_delete_message', 'Order Cancellation Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        // update acc, invoice
        // dd($product);
        $orders = Order::where('is_deleted', 0)->latest()->get();
        return redirect()->route('order.index', ['order' => $orders]);
    }

    public function return($id) {
        $order = Order::findOrFail($id);
        $order->is_return = true;
        $order->save();

        $orderProducts = DB::table("order_products")
                            ->where("order_id", "=", $id)
                            ->get();

        foreach($orderProducts as $orderProduct){
                $product = Product::findOrFail($orderProduct->product_id);
                $product->stock = $product->stock + $orderProduct->quantity;
                $product->save();
        }

        if ($product->save()) {
            \Session::flash('product_return_message', 'Product return Successfully!');
        } else {
            \Session::flash('product_return_message', 'Product return Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('orders.show', $order->id);

    }
}
