<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Receipt;
use App\Setting;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
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
    public function create($orderId) {
        $order = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.id as cid', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address', 'customers.delivery_address as delivery_address')
                    ->where('orders.id', '=', $orderId)
                    ->where('orders.is_deleted', '=', 0)
                    ->first();

        $settings = Setting::findOrFail(1);
        $invoice = Invoice::where('order_id', $order->id)->first();
        $products = DB::table('order_products')
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->where('order_products.order_id', $orderId)
                            ->select('order_products.*', 'products.*')
                            ->get();

        return view('receipt.create', [
            'order' => $order,
            'settings' => $settings,
            'invoice' => $invoice,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $receipt = new Receipt();
        $receipt->order_id = $request->id;
        $receipt->payment_amount = $request->paid_now;
        $receipt->save();

        $order1 = Order::findOrFail($request->id);
        $order1->amount_paid = $order1->amount_paid + $receipt->payment_amount;

        if ($order1->amount_paid >= ($order1->order_value - $order1->discount_amount)) {
            $order1->is_paid = true;
        }
        $order1->save();


        $order = DB::table('orders')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->select('orders.*', 'customers.id as cid', 'customers.name as cname', 'customers.mobile as mobile', 'customers.address as address', 'customers.delivery_address as delivery_address')
                    ->where('orders.id', '=', $request->id)
                    ->where('orders.is_deleted', '=', 0)
                    ->first();

        $settings = Setting::findOrFail(1);
        $invoice = Invoice::where('order_id', $order->id)->first();
        $products = DB::table('order_products')
                            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
                            ->where('order_products.order_id', $request->id)
                            ->select('order_products.*', 'products.*')
                            ->get();

        $paid_amount = $request->paid_now;
        $customerId = $order->cid;
        $customerName = $order->cname;
        // Update acc
        $account = new Account();
        $account->amount        = $paid_amount;
        $account->account_type  = 'Cash';
        $account->customer_id   = $customerId;
        $account->customer_name = $customerName;
        $account->category      = 'Final Payment';
        $account->reference     = 'Self';
        $account->save();

        return view('receipt.show', [
            'order' => $order,
            'settings' => $settings,
            'invoice' => $invoice,
            'products' => $products,
            'receipt' => $receipt,
        ]);
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
