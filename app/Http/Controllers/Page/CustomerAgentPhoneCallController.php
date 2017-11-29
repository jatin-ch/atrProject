<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Booking;
use Carbon\Carbon;

class CustomerAgentPhoneCallController extends Controller
{
    public function CustomerAgentConnect()
    {
      $bookings = Booking::where('confirm',1)->where('status','upcoming');

      foreach($bookings as $booking)
      {
        $date = Carbon::parse($booking->date);
        $now = Carbon::now();
        if($date == $now)
        {
          $post_data = array(
              'From' => "08447645580",
              'To' => "917042487277",
              'CallerId' => "01133138117",
              'TimeLimit' => "30",
              'TimeOut' => "<time-in-seconds (optional)>",
              'CallType' => "trans" //Can be "trans" for transactional and "promo" for promotional content
          );

          $exotel_sid = "atr591"; // Your Exotel SID - Get it from here: http://my.exotel.in/settings/site#api-settings
          $exotel_token = "cf0e40da000ce1e08f774f3ad94531238acd32a3"; // Your exotel token - Get it from here: http://my.exotel.in/settings/site#api-settings

          $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Calls/connect";

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

          print "Response = ".print_r($http_result);
        }
      }
    }

    public function customerAgentPhoneCall()
    {
      $post_data = array(
          'From' => "08447645580",
          'To' => "917042487277",
          'CallerId' => "01133138117",
          'TimeLimit' => "30",
          'TimeOut' => "<time-in-seconds (optional)>",
          'CallType' => "trans" //Can be "trans" for transactional and "promo" for promotional content
      );

      $exotel_sid = "atr591"; // Your Exotel SID - Get it from here: http://my.exotel.in/settings/site#api-settings
      $exotel_token = "cf0e40da000ce1e08f774f3ad94531238acd32a3"; // Your exotel token - Get it from here: http://my.exotel.in/settings/site#api-settings

      $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Calls/connect";

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

      print "Response = ".print_r($http_result);
    }
}
