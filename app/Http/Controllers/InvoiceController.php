<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
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
    public function show($orderId) {
        $order = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
                    ->where('orders.is_deleted', '=', 0)
                    ->first();
        // dd($order);
        $settings = Setting::findOrFail(1);
        $invoice = Invoice::where('order_id', $order->id)->first();
        $products = DB::table('order_products')
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->select('order_products.*', 'products.*')
                            ->get();

        return view('order.show', [
            'order' => $order,
            'settings' => $settings,
            'invoice' => $invoice,
            'products' => $products,
        ]);
    }

    public function printInvoice($orderId) {
        $order = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address')
                    ->where('orders.is_deleted', '=', 0)
                    ->first();
        // dd($order);
        $settings = Setting::findOrFail(1);
        $invoice = Invoice::where('order_id', $order->id)->first();
        $products = DB::table('order_products')
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->select('order_products.*', 'products.*')
                            ->get();

        return view('invoice.show', [
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
}
