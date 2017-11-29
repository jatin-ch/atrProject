<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin\BasicDetail;
use Auth;
use App\Models\Page\Booking;
use App\Models\Page\BookingDate;
use App\Models\Admin\Service;
use App\Models\Admin\Availability;
use Session;
use carbon\Carbon;

class OfflineBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }

    public function index()
    {
      return view('adviser.bookings.recieved.index');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'mobile' => 'required|max:10|unique:users',
        'availability_id' => 'required',
        'date' => 'required',
        'time' => 'required'
      ]);

      $client = new User;
      $client->name = $request->name;
      $client->email = $request->email;
      $client->mobile = $request->mobile;
      $client->password = bcrypt('123456');
      $client->save();

      if($client->save())
      {
        $basicdetail = new BasicDetail;
        $basicdetail->firstname = $request->name;
        $basicdetail->lastname = $request->name;
        $basicdetail->gender = 'NA';
        $basicdetail->dob = new Carbon();
        $basicdetail->mobile = $request->mobile;
        $basicdetail->email = $request->email;
        $basicdetail->user_id = $client->id;
        $basicdetail->save();
      }
      //$link = url('password/reset', $client->token).'?email='.urlencode($client->getEmailForPasswordReset());

      if($client->save())
      {
        $booking = new Booking;
        $booking->online = false;
        $booking->type = $request->type;
        $booking->user_id = Auth::user()->id;
        $booking->client_id = $client->id;
        $booking->availability_id = $request->availability_id;
        if(isset($request->location_id)){
          $booking->location_id = $request->location_id;
        }

        $booking->date = $request->date.' '.$request->time;
        if(isset($request->service_id) && !empty($request->service_id))
        {
          $service = Service::find($request->service_id);
          $total_pay = $service->payout + $service->payout*.18;
          $booking->service_id = $request->service_id;
        }
        else {
          $availability = Availability::find($request->availability_id);
          $total_pay = $availability->consultation_payout + $availability->consultation_payout*.18;
        }
        $booking->total_pay = $total_pay;
        $booking->confirm = true;
        $booking->status = 'upcoming';
        $booking->save();

        if($booking->save()) {
          $post_data = array(
           'From'   => 'SAMPLE',
           'To'    => '8368316054',
           'Body'  => 'Hi ajay, Mr. Abhishek Arora has been allocated and confirmed for your Order ID: 12234 with Bill Amount 500. For further assistance please call 8447645580',
         );

       $exotel_sid = "atr591";
       $exotel_token = "cf0e40da000ce1e08f774f3ad94531238acd32a3";
       $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_VERBOSE, 1);
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_FAILONERROR, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

       $http_result = curl_exec($ch);
       $error = curl_error($ch);
       $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

       curl_close($ch);
         //print "Response = ".print_r($http_result);

        }
      }

    }

    public function consultation()
    {
      $consultations = Booking::where('client_id',Auth::user()->id)->where('type','=','consultation')->get();
      return view('user.bookings.consultation.index')->withConsultations($consultations);
    }

    public function service()
    {
      $services = Booking::where('client_id',Auth::user()->id)->where('type','=','service')->get();
      return view('user.bookings.service.index')->withServices($services);
    }

}
