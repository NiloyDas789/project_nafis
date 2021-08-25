<?php

use App\Http\Controllers\CustomerController;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('customers', 'CustomerController');
    Route::get('customers/{customer}/delete', 'CustomerController@delete')->name('customers.delete');

    Route::resource('products', 'ProductController');
    Route::get('products/{product}/delete', 'ProductController@delete')->name('products.delete');

    Route::resource('bundles', 'BundleController');
    Route::get('bundles/{bundle}/delete', 'BundleController@delete')->name('bundles.delete');

    Route::get('stocks/{product}/add', 'StockController@create')->name('stocks.add');
    Route::post('stocks/{product}/add', 'StockController@store')->name('stocks.store');

    Route::resource('pos', 'PosController');

    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices/{orderId}/print', 'InvoiceController@printInvoice')->name('invoice.print');

    Route::get('receipts/create/{orderId}', 'ReceiptController@create')->name('receiptCreate');
    Route::resource('receipts', 'ReceiptController');
    Route::get('receipts/{orderId}/print', 'ReceiptController@printReceipt')->name('receipt.print');
    // Route::get('receipts/{orderId}/print', 'ReceiptController@printReceipt')->name('receipt.print');

    Route::resource('orders', 'OrderController');
    Route::get('orders/{order}/delete', 'OrderController@delete')->name('orders.delete');
    Route::get('orders/{order}/return', 'OrderController@return')->name('orders.return'); // Order return route

    Route::resource('accounts', 'AccountController');
    Route::post('accounts', 'AccountController@filter')->name("account.filter");

    //stock
    //pos
    //receipt
    Route::get('settings', 'SettingController@edit')->name('settings.edit');
    Route::post('settings', 'SettingController@update')->name('settings.update');

});

Auth::routes();
Route::get('/custom-logout', 'MyController@logout')->name('my.logout');

Route::get('/home', function(){
    return redirect()->route('dashboard');
});
Route::get('/new', function(){
    return view('frontend.home');
});
Route::get('/catagory', function(){
    return view('frontend.catagory');
});

Route::resource('web', 'FrontendController');


// require_once 'SimpleXLSX.php';
// Route::get('import', function() {
//     $file_destination = 'file.xlsx';

//     if ( $xlsx = SimpleXLSX::parse($file_destination) ) {
//         $names = array();
//         $writers = array();
//         $categories = array();
//         $publishers = array();
//         $dates = array();
//         $prices = array();

//         // dd($xlsx);

//         $prev_writer = '';
//         $prev_pub = '';
//         $prev_cat = '';
//         $prev_date = '';

//         foreach ( $xlsx->rows() as $r => $row ) {
//             if ($r == 0)
//                 continue;
//             if ($r >= 47)
//                 break;
//             // dd($row);
//             // dd($row[1]);
//             // echo '<br>';
//             $art_no = $row[1];
//             $stock = (integer)$row[2];
//             $title = $row[3];
//             $unit_price = (float)$row[4];

//             $p = new Product();
//             $p->art_no = $art_no;
//             $p->stock = $stock;
//             $p->title = $title;
//             $p->unit_price = $unit_price;
//             $p->image_path = 'public/uploads/default.png';
//             $p->save();
//         }
//     } else {
//         echo SimpleXLSX::parseError();
//     }
// });
