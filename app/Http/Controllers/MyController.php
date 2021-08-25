<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function logout(){
        \Auth::logout();
        return redirect()->route('login');
    }
}
