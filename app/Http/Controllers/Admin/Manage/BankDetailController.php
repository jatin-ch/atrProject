<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Admin\Payment;

class BankDetailController extends Controller
  {
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }
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
        $this->validate($request, [
          'pan_number' => 'required',
          'gstn_number' => 'required',
          'account_holder' => 'required|string',
          'account_number' => 'required',
          'ifsc_code' => 'required',
          'bank_name' => 'required|string'
        ]);

        $payment = new Payment;
        $payment->pan_number = $request->pan_number;
        $payment->gstn_number = $request->gstn_number;
        $payment->account_holder = $request->account_holder;
        $payment->account_number = $request->account_number;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->bank_name = $request->bank_name;
        if(isset($request->agree)){
         $payment->agree = true;
        }
        else {
          $payment->agree = false;
        }
        $payment->user_id = $request->user_id;
        $payment->save();
        return redirect()->route('bank-detail.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if($user->payment){
          return view("admin.manage.bank-detail.show")->withUser($user);
        } else {
          return view("admin.manage.bank-detail.create")->withUser($user);
        }
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
        $this->validate($request, [
          'pan_number' => 'required',
          'gstn_number' => 'required',
          'account_holder' => 'required|string',
          'account_number' => 'required',
          'ifsc_code' => 'required',
          'bank_name' => 'required|string'
        ]);

        $payment = User::find($id)->payment;
        $payment->pan_number = $request->pan_number;
        $payment->gstn_number = $request->gstn_number;
        $payment->account_holder = $request->account_holder;
        $payment->account_number = $request->account_number;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->bank_name = $request->bank_name;
        $payment->save();

        return redirect()->route('bank-detail.show', $id);
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
