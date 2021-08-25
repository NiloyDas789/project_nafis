<?php

namespace App\Http\Controllers;

use App\BundleProduct;
use App\Product;
use Illuminate\Http\Request;

class BundleApiController extends Controller
{
    public function bundleById($id){
        $bundleProducts = BundleProduct::where("bundle_id", $id)->get();

        $bundleProductData = [];
        foreach($bundleProducts as $bundleProduct){
            $p = Product::where('id', $bundleProduct->product_id)->first();
            $p['quantity'] = $bundleProduct->quantity;
            $bundleProductData[] = $p;
        }

        return $bundleProductData;

    }
}
