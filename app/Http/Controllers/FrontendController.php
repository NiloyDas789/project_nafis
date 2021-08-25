<?php

namespace App\Http\Controllers;

use App\Order;
use App\Bundle;
use App\Account;
use App\Invoice;
use App\Product;
use App\Receipt;
use App\Setting;
use App\Customer;
use App\OrderProduct;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $products = Product::where('is_deleted', 0)
                            ->where('stock', '>', 0)
                            ->whereColumn('is_in_service', '<', 'stock')
                            ->latest()->get();
        $customers = Customer::where('is_deleted', 0)->get();
        $bundles = Bundle::where('is_deleted', 0)->get();
        return view('frontend.home', ['products' => $products, 'customers' => $customers, 'bundles' => $bundles]);
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
    public function store(Request $request) {
        // dd($request->all());
        $customerId = 1;
        $customerName = 'Walk-in Customer';
        $show_receipt = false;

        // Create new customer
        if (isset($request->customerName)) {
            $customer = new Customer();
            $customer->name = $request->customerName;

            if (isset($request->mobile)) {
                $customer->mobile = $request->mobile;
            }
            if (isset($request->address)) {
                $customer->address = $request->address;
            }
            if (isset($request->nid)) {
                $customer->nid = $request->nid;
            }
            if (isset($request->passport)) {
                $customer->passport = $request->passport;
            }
            if (isset($request->comment)) {
                $customer->comment = $request->comment;
            }
            $customer->save();
            $customerId   = $customer->id;
            $customerName = $request->customerName;
        }
        $discount = 0;
        if (isset($request->discount)) {
            $discount = $request->discount;
        }
        $paid_amount = 0;
        if (isset($request->paid)) {
            $paid_amount = $request->paid;
            $show_receipt = true;
        }

        // New start date
        $a = date_create_from_format("m/d/Y",$request->startDate);
        // dd($a);
        $startDate = $a->format('Y-m-d');

        $b = date_create_from_format("m/d/Y",$request->returnDate);
        // dd($b);
        $returnDate = $b->format('Y-m-d');

        // create order
        $order = new Order();
        $order->customer_id     = $customerId;
        $order->start_date     = $startDate;
        $order->return_date     = $returnDate;
        $order->order_value     = $request->totalAmount;
        $order->discount_amount = $discount;
        $order->amount_paid     = $paid_amount;
        $order->total_quantity  = 0;

        if ($paid_amount == $request->totalAmount) {
            $order->is_paid = true;
        } else {
            $order->is_paid = false;
        }
        $order->save();
        $orderId = $order->id;


        $total_quantity = 0;
        // Create Order-Products
        if (isset($request->productId)) {
            foreach ($request->productId as $idx => $pid ) {
                $all_array[] = [ $pid, $request->subTotal[$idx], $request->quantity[$idx] ];
                $op = new OrderProduct();
                $op->order_id = $orderId;
                $op->product_id = $pid;
                $op->quantity = $request->quantity[$idx];
                $op->price = $request->subTotal[$idx];
                $op->save();

                $p = Product::findOrFail($pid);
                $prev_stock = $p->stock;
                $prev_in_service = $p->is_in_service;
                $p->stock = $prev_stock - $request->quantity[$idx];
                $p->is_in_service = $prev_in_service + $request->quantity[$idx];

                $p->save();

                $total_quantity += $request->quantity[$idx];
                // dd($total_quantity, $request->quantity[$idx]);
            }
            $order = Order::findOrFail($orderId);
            $order->total_quantity = $total_quantity;
            $order->save();

        }

        // create invoice
        $settings = Setting::findOrFail(1);
        $customerInvoices = Invoice::where('customer_id', $customerId)->get();
        $presence = $customerInvoices->count();
        $newNum = (int)$presence + 1;
        $invoice = new Invoice();
        $invoice->invoice_id = $settings->invoice_prefix.$customerId.$newNum;
        $invoice->order_id = $orderId;
        $invoice->issue_date = date('Y-m-d');

        // dd($a, $a->format('Y-m-d'));
        $invoice->due_date = $returnDate;
        $invoice->save();

        // Create receipt
        if ($paid_amount > 0) {
            $receipt = new Receipt();
            $receipt->order_id = $orderId;
            $receipt->payment_amount = $paid_amount;
            $receipt->discount = $discount;
            $receipt->save();

            // Update acc
            $account = new Account();
            $account->amount        = $paid_amount;
            $account->account_type  = 'Cash';
            $account->customer_id   = $customerId;
            $account->customer_name = $customerName;
            $account->category      = 'Advance Payment';
            $account->reference     = 'Self';
            // $account->description   = $customer_name;
            $account->save();

        }

        // return back();
        return redirect()->route('orders.show', $orderId);
        // return to OrderViewById -> This will contain buttons for invoice and receipt



        // if receipt
            // return with invoiceId, receiptId to printBothButton
        // else
            // return with invoiceId to printInvoiceButton
    }
}
