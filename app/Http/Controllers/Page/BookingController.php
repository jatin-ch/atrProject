<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Page\Booking;
use App\Models\Page\BookingDate;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Razorpay;
use App\Card;


class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    public function consultation(Request $request)
    {
            
      $author = User::find($request->user_id);

      if($author->expertDetail->type == 'professional')
      {
        $this->validate($request, [
          'availability_id' => 'required',
          'date' => 'required',
          'time' => 'required'
        ]);

        $booking = new Booking;
        $booking->type = 'consultation';
        $booking->user_id = $request->user_id;
        $booking->client_id = Auth::user()->id;
        $booking->availability_id = $request->availability_id;
        if(!empty($request->location_id)){
          $booking->location_id = $request->location_id;
        }

        $booking->date = $request->date.' '.$request->time;
        $booking->total_pay = $request->total_pay;
        $booking->confirm = false;
        $booking->status = 'open';
        $booking->save();

        if($booking->save()) {

         $uname = 'Adviseli';
         $pwd = 'adviseli@123';
         $sender = 'ADVCLI';
         $channel = 'trans';
         $mobile = '8447645580';
         $message = 'hiiii';
           $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
          //  $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname=Adviseli&Pwd=adviseli@123&sender=ADVCLI&channel=trans&DCS=0&flashsms=0&MobileNO=8447645580&Message=hiiii&route=15&messageType=Single&msgcount=1&GroupID=0';

           $curl = curl_init($uri);
           curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
           curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
           $response = curl_exec($curl);
           curl_close($curl);
           //return $response;

            }

        Session::flash('success', 'Thank you so much for booking with us');
        return redirect()->back();
      }
      
      
      
      
      
      else
      {
        $this->validate($request, [
          'availability_id' => 'required',
        ]);

        $booking = new Booking;
        $booking->type = 'consultation';
        $booking->user_id = $request->user_id;
        $booking->client_id = Auth::user()->id;
        $booking->availability_id = $request->availability_id;
        if(!empty($request->location_id)){
          $booking->location_id = $request->location_id;
        }

        $booking->confirm = false;
        $booking->status = 'open';
        $booking->total_pay = $request->total_pay;
        $booking->save();
        if($booking->save()){
          if(count($request->date) > 0){
            foreach($request->date as $key => $v){
              if(!empty($request->date [$key])){
                $bookingdate = new BookingDate;
                $bookingdate->date = $request->date [$key].' '.$request->time [$key];
                $bookingdate->booking_id = $booking->id; // taking last booking id from bookings
                $bookingdate->suggest_by = 'user';
                $bookingdate->save();
              }

            }
          }
        }

        if($booking->save()) {

          $uname = 'Adviseli';
          $pwd = 'adviseli@123';
          $sender = 'ADVCLI';
          $channel = 'trans';
          $mobile = '8447645580';
          $message = 'hiiii';
            $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
            // $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname=Adviseli&Pwd=adviseli@123&sender=ADVCLI&channel=trans&DCS=0&flashsms=0&MobileNO=8447645580&Message=hiiii&route=15&messageType=Single&msgcount=1&GroupID=0';

            $curl = curl_init($uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($curl);
            curl_close($curl);

        }
        
        Session::flash('success', 'Thank you so much for booking with us');
        return redirect()->back();

      }
      

    }










    public function service(Request $request)
    {
      $author = User::find($request->user_id);
      
      
        if($author->expertDetail->type == 'professional')
        {
          $this->validate($request, [
            'services' => 'required',
            'availability_id' => 'required',
            'date' => 'required',
            'time' => 'required'
          ]);

        foreach($request->services as $service_id){
          $booking = new Booking;
          $service = Service::find($service_id);
          $booking->type = 'service';
          $booking->user_id = $request->user_id;
          $booking->client_id = Auth::user()->id;
          $booking->service_id = $service_id;
          $booking->availability_id = $request->availability_id;
          if(!empty($request->location_id)){
            $booking->location_id = $request->location_id;
          }

          $booking->date = $request->date.' '.$request->time;
          $total_pay = $service->payout + $service->payout*.18;
          $booking->total_pay = $total_pay;
          $booking->confirm = false;
          $booking->status = 'open';
          $booking->save();

          if($booking->save()) {

            $uname = 'Adviseli';
            $pwd = 'adviseli@123';
            $sender = 'ADVCLI';
            $channel = 'trans';
            $mobile = '8447645580';
            $message = 'hiiii';
              $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
              // $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname=Adviseli&Pwd=adviseli@123&sender=ADVCLI&channel=trans&DCS=0&flashsms=0&MobileNO=8447645580&Message=hiiii&route=15&messageType=Single&msgcount=1&GroupID=0';

              $curl = curl_init($uri);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
              curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
              $response = curl_exec($curl);
              curl_close($curl);

          }
        }

        Session::flash('success', 'Thank you so much for booking with us');
        return redirect()->back();

        }
        
        
        
        
        
        else 
        {
          $this->validate($request, [
            'services' => 'required',
            'availability_id' => 'required',
            'location_id' => 'required'
          ]);
        // $count = 0;
          foreach($request->services as $service_id){
              //$count++;
            $booking = new Booking;
            $service = Service::find($service_id);
            $booking = new Booking;
            $service = Service::find($service_id);
            $booking->type = 'service';
            $booking->user_id = $request->user_id;
            $booking->client_id = Auth::user()->id;
            $booking->service_id = $service->id;
            $booking->availability_id = $request->availability_id;

            if(!empty($request->location_id)){
              $booking->location_id = $request->location_id;
            }

            $total_pay = $service->payout + $service->payout*.18;
            $booking->total_pay = $total_pay;
            $booking->confirm = false;
            $booking->status = 'open';
            $booking->save();

            if($booking->save()){
              if(count($request->date) > 0){
                foreach($request->date as $key => $v){
                  if(!empty($request->date [$key])){
                    $bookingdate = new BookingDate;
                    $bookingdate->date = $request->date [$key].' '.$request->time [$key];
                    $bookingdate->booking_id = $booking->id;
                    $bookingdate->suggest_by = 'user';
                    $bookingdate->save();
                  }

                }
              }
            }

            if($booking->save()) {

              $uname = 'Adviseli';
              $pwd = 'adviseli@123';
              $sender = 'ADVCLI';
              $channel = 'trans';
              $mobile = '8447645580';
              $message = 'hiiii';
                $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
                // $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname=Adviseli&Pwd=adviseli@123&sender=ADVCLI&channel=trans&DCS=0&flashsms=0&MobileNO=8447645580&Message=hiiii&route=15&messageType=Single&msgcount=1&GroupID=0';

                $curl = curl_init($uri);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                $response = curl_exec($curl);
                curl_close($curl);

            }

          }
          //return $count;
          
        Session::flash('success', 'Thank you so much for booking with us');
        return redirect()->back();
      }

    }
    
    
}
