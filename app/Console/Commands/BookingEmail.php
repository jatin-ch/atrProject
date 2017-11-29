<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page\Booking;
use Carbon\Carbon;
use App\User;

class BookingEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Booking Emails';

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
          $date = Carbon::parse($booking->date);
          $now = Carbon::now();
          $mins = $date->diffInMinutes($now);

          if($mins <= 60)
          {
            $uname = 'Adviseli';
            $pwd = 'adviseli@123';
            $client = User::find($booking->client_id);
            $mail = 'Hii';
            $uri = 'http://www.clickinsms.com/SendEmail.aspx?Uname='.$uname.'&Pwd='.$pwd.'&ToMailID='.$client->email.'&CCMailID=&BccMailID=&Subject=Hellooo&htmlString='.$mail.'';

            $curl = curl_init($uri);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($curl);
            curl_close($curl);
            //print_r($response);
          }
        }

        $this->info('All upcoming booking emails are sent!');
    }
}
