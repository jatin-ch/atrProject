<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Razorpay;
use App\Card;

class RazorpayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function payWithRazorpay()
    {
        return view('payWithRazorpay');
    }


    public function payment()
    {
        //Input items of form
        $input = Input::all();
        //get API Configuration
        $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                //return dd($response);
                $razorpay = new Razorpay;
                $razorpay->id = $response->id;
                $razorpay->entity = $response->entity;
                $razorpay->amount = $response->amount;
                $razorpay->currency = $response->currency;
                $razorpay->status = $response->status;
                $razorpay->order_id = $response->order_id;
                $razorpay->invoice_id = $response->invoice_id;
                $razorpay->international = $response->international;
                $razorpay->method = $response->method;
                $razorpay->amount_refunded = $response->amount_refunded;
                $razorpay->refund_status = $response->refund_status;
                $razorpay->captured = $response->captured;
                $razorpay->description = $response->description;
                $razorpay->card_id = $response->card_id;
                
                $card = new Card;
                $card->id = $response->card->id;
                $card->entity = $response->card->entity;
                $card->name = $response->card->name;
                $card->last4 = $response->card->last4;
                $card->network = $response->card->network;
                $card->type = $response->card->type;
                $card->issuer = $response->card->issuer;
                $card->international = $response->card->international;
                $card->emi = $response->card->emi;
                $card->save();
                
                $razorpay->bank = $response->bank;
                $razorpay->wallet = $response->wallet;
                $razorpay->vpa = $response->vpa;
                $razorpay->email = $response->email;
                $razorpay->contact = $response->contact;
                $razorpay->fee = $response->fee;
                $razorpay->tax = $response->tax;
                $razorpay->error_code = $response->error_code;
                $razorpay->error_description = $response->error_description;
                $razorpay->save();

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

            // Do something here for store payment details in database...
        }

        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}
