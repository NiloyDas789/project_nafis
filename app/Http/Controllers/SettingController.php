<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
    public function edit() {
        $settings = Setting::findOrFail(1);
        return view('settings.edit', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        if ($request->hasFile('customFile')) {
            $image           = $request->file('customFile');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/logo');
            $file_path       = 'public/uploads/logo/'.$name;
            $image->move($destinationPath, $name);
        }


        $settings = Setting::findOrFail(1);
        $settings->company_name = $request->company_name;
        $settings->company_address = $request->company_address;
        $settings->company_city = $request->company_city;
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->invoice_prefix = $request->invoice_prefix;
        $settings->tos = $request->tos;

        if (isset($file_path)) {
            $settings->image_path  = $file_path;
        } else {
            $settings->image_path  = 'public/uploads/logo/default_logo.png';
        }


        if ($settings->save()) {
            \Session::flash('settings_update_message', 'Settings Update Successfully!');
        } else {
            \Session::flash('settings_update_message', 'Settings Updating Failed!');
            \Session::flash('alert-class', 'alert-danger');
        }
        // return back();
        return view('settings.edit', ['settings' => $settings]);
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
