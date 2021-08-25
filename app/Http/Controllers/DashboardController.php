<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index() {
        $total_products = Product::all()->count();
        $total_customers = Customer::all()->count();
        $total_orders = Order::all()->count();
        $total_transactions = Account::all()->count();
        $bill_pending = Order::where('is_paid', 0)->count();
        $devices_on_rent = DB::table('orders')->where('is_paid', 0)->sum('total_quantity');
        // dd($devices_on_rent);

        return view('dashboard', [
            'total_products' => $total_products,
            'total_customers' => $total_customers,
            'total_orders' => $total_orders,
            'total_transactions' => $total_transactions,
            'bill_pending' => $bill_pending,
            'devices_on_rent' => $devices_on_rent,
        ]);
    }
}
