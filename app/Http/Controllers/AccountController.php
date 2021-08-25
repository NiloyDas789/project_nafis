<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $accounts = Account::where('is_deleted', 0)->latest()->get();
        $totalTransaction = Account::sum("amount");
        // dd($accounts);
        return view('account.index', ['accounts' => $accounts, 'totalTransaction' => $totalTransaction ]);
    }

    public function filter(Request $request) {
        $request->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
        ]);
        // $accounts = Account::where('is_deleted', 0)->latest()->get();
        $accounts = Account::where('is_deleted', 0)
                    ->where('created_at', '>', $request->fromDate)
                    ->where('created_at', '<', $request->toDate)
                    ->latest()
                    ->get();

        $totalTransaction =  Account::where('is_deleted', 0)
                    ->where('created_at', '>', $request->fromDate)
                    ->where('created_at', '<', $request->toDate)
                    ->latest()
                    ->sum("amount");
        // dd($accounts);
        return view('account.index', ['accounts' => $accounts, 'totalTransaction' => $totalTransaction]);
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
