<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page\Booking;
use Carbon\Carbon;

class SmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Booking sms';

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
        // echo 'My task scheduling is working...';
        $bookings = Booking::where('status','upcoming')->get();

        foreach($bookings as $booking)
        {
          $date = Carbon::parse($booking->date);
          $now = Carbon::now();
          $mins = $date->diffInMinutes($now);

          if($mins == 60)
          {
            $uname = 'Adviseli';
            $pwd = 'adviseli@123';
            $sender = 'ADVCLI';
            $channel = 'trans';
            $mobile = '8447645580';
            $message = 'hiiii';
            $uri = 'http://www.clickinsms.com/Sendsms.aspx?Uname='.$uname.'&Pwd='.$pwd.'&sender='.$sender.'&channel='.$channel.'&DCS=0&flashsms=0&MobileNO='.$mobile.'&Message='.$message.'&route=15&messageType=Single&msgcount=1&GroupID=0';
            
            $curl = curl_init($uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($curl);
            curl_close($curl);
            //return $response;
          }
        }

        $this->info('All upcoming booking sms are sent!');
    }
}
