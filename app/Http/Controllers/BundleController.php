<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\BundleProduct;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bundles = Bundle::where('is_deleted', 0)->latest()->get();
        return view('bundle.index', ['bundles' => $bundles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('is_deleted', 0)
                            ->where('stock', '>', 0)
                            ->whereColumn('is_in_service', '<', 'stock')
                            ->latest()->get();
        $customers = Customer::where('is_deleted', 0)->get();
        return view('bundle.create', ['products' => $products, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create bundle
        $bundle = new Bundle();
        $bundle->name     = $request->bundleName;
        $bundle->save();
        $bundleId = $bundle->id;


        // Create bundle-Products
        if (isset($request->productId)) {
            foreach ($request->productId as $idx => $pid ) {
                $bp = new BundleProduct();
                $bp->bundle_id = $bundleId;
                $bp->product_id = $pid;
                $bp->quantity = $request->quantity[$idx];
                $bp->save();
            }

        }

        return redirect()->route('bundles.index');
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
        $products = Product::where('is_deleted', 0)
                            ->where('stock', '>', 0)
                            ->whereColumn('is_in_service', '<', 'stock')
                            ->latest()->get();
        $customers = Customer::where('is_deleted', 0)->get();
        $bundle = Bundle::findOrFail($id);
        $bundleProducts = BundleProduct::where('bundle_id', $id)->get();

        $bundleProductData = [];
        foreach($bundleProducts as $bundleProduct){
            $p = Product::where('id', $bundleProduct->product_id)->first();
            $p['quantity'] = $bundleProduct->quantity;
            $bundleProductData[] = $p;

        }
        // dd($product);
        return view('bundle.edit', ['products' => $products, 'customers' => $customers, 'bundle' => $bundle, 'bundleProducts' =>  $bundleProductData]);
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

        $request->validate([
            'bundleName' => 'required',
        ]);

        // create bundle
        $bundle = Bundle::findOrFail($id);

        $bundle->name     = $request->bundleName;
        $bundle->save();

        BundleProduct::where('bundle_id', $id)->delete();

        $bundleId = $id;


        // Create bundle-Products
        if (isset($request->productId)) {
            foreach ($request->productId as $idx => $pid ) {
                $bp = new BundleProduct();
                $bp->bundle_id = $bundleId;
                $bp->product_id = $pid;
                $bp->quantity = $request->quantity[$idx];
                $bp->save();
            }

        }

        return redirect()->route('bundles.index');
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

    public function delete($id)
    {
        $bundleDelete = Bundle::findOrFail($id);
        $bundleDelete->is_deleted = 1;
        if($bundleDelete->save()){
        $bundles = Bundle::where('is_deleted', 0)->latest()->get();
        return view('bundle.index', ['bundles' => $bundles]);
        }
    }
}
