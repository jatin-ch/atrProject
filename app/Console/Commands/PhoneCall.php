<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page\Booking;
use Carbon\Carbon;

class PhoneCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phone:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Booking Phone Call';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bookings = Booking::where('status','upcoming')->get();

        foreach($bookings as $booking)
        {
          if($booking->availability->consultation_mode == 'phone_call')
          {
            $date = Carbon::parse($booking->date);
            $now = Carbon::now();
            $mins = $date->diffInMinutes($now);

            if($mins <= 60)
            {
              $post_data = array(
                  'From' => "918449416061",
                  'To' => "918447645580",
                  'CallerId' => "08030695865",
                  'TimeLimit' => "30",
                  'TimeOut' => "<time-in-seconds (optional)>",
                  'CallType' => "trans" //Can be "trans" for transactional and "promo" for promotional content
              );

              $exotel_sid = "teknikforce"; // Your Exotel SID - Get it from here: http://my.exotel.in/settings/site#api-settings
              $exotel_token = "26cbbf7081715814ca6f8bc5b160d3e0c76c1504"; // Your exotel token - Get it from here: http://my.exotel.in/settings/site#api-settings

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
         $this->info('All upcoming booking phone calls are done!');
    }
}
