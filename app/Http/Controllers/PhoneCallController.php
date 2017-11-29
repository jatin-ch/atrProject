<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class PhoneCallController extends Controller
{
     public function sendSms()
     {
       $post_data = array(
        // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
        // For promotional, this will be ignored by the SMS gateway
        'From'   => 'SAMPLE',
        'To'    => '8447645580',
        'Body'  => 'Hi moolchand, your number 8368316054 is now turned ready.', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
    );

    $exotel_sid = "atr591"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
    $exotel_token = "cf0e40da000ce1e08f774f3ad94531238acd32a3"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings

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

    print "Response = ".print_r($http_result);

    }




    public function customerPhoneCall()
    {
         $post_data = array(
       'From' => "8447645580", //customer No
       'To' => "01133138117", // Exotel Landline Number
       'CallerId' => "01133138117",
       'Url' => "http://my.exotel.in/exoml/start/<flow_id>",
       'TimeLimit' => "60", //This is optional
       'TimeOut' => "<time-in-seconds>", //This is also optional
       'CallType' => "trans",
       'StatusCallback' => "<http//: your company URL>" //This is also also optional
        );

       $exotel_sid = "atr591"; // Your Exotel SID - Get it here: http://my.exotel.in/Exotel/settings/site#exotel-settings
       $exotel_token = "cf0e40da000ce1e08f774f3ad94531238acd32a3"; // Your exotel token - Get it here: http://my.exotel.in/Exotel/settings/site#exotel-settings

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





    public function send()
    {
      Mail::send(['text' => 'test-mail'], ['name', 'Moolchand'],function($message){
        $message->to('moolchandjatjiit@gmail.com', 'To Moolchand')->subject('Test Email');
        $message->from('atr.moolchand@gmail.com', 'Atr Moolchand');
      });
    }
}
