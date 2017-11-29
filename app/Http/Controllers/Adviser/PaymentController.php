<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Payment;
use App\User;
use Auth;
use Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $payment = User::find(Auth::user()->id)->payment;
       if($payment){
         return view('adviser.payments.index');
       } else {
         return view('adviser.payments.create');
       }
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
          'gstn_number' => 'required|integer',
          'account_holder' => 'required|string',
          'account_number' => 'required|integer',
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
        $payment->user_id = Auth::user()->id;
        $payment->save();

        Session::flash('success','Your bank details was added.');
        return redirect()->route('adviser.payments.index');
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
          'gstn_number' => 'required|integer',
          'account_holder' => 'required|string',
          'account_number' => 'required|integer',
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

        Session::flash('success','Your bank details was saved');
        return redirect()->route('adviser.payments.index');
    }

}
