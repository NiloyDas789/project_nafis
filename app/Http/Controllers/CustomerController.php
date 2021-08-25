<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $customers = Customer::where('is_deleted', 0)->get();
        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->delivery_address = $request->deliveryAddress;
        $customer->nid = $request->nid;
        $customer->passport = $request->passport;
        $customer->comment = $request->comment;

        if ($customer->save()) {
            \Session::flash('customer_add_message', 'Customer Added Successfully!');
        } else {
            \Session::flash('customer_add_message', 'Customer Adding Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->delivery_address = $request->deliveryAddress;
        $customer->nid = $request->nid;
        $customer->passport = $request->passport;
        $customer->comment = $request->comment;

        if ($customer->save()) {
            \Session::flash('customer_update_message', 'Customer Update Successfully!');
        } else {
            \Session::flash('customer_update_message', 'Customer Updating Failed!');
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
    public function destroy($id)
    {
        //
    }

    public function delete($id) {
        $customer = Customer::findOrFail($id);
        $customer->is_deleted = 1;
        $customers = Customer::where('is_deleted', 0)->latest()->get();

        if ($customer->id == 1) {
            \Session::flash('customer_delete_message', 'Walk-in customer can not be deleted!');
            \Session::flash('alert-class', 'alert-danger');
            return redirect()->route('customers.index', ['customers' => $customers]);
        }
        if ($customer->save()) {
            \Session::flash('customer_delete_message', 'Customer Deleted Successfully!');
        } else {
            \Session::flash('customer_delete_message', 'Customer Deleted Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('customers.index', ['customers' => $customers]);
    }
}
