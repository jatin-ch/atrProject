<?php

namespace App\Http\Controllers\Admin\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Page\Booking;
use App\Models\Page\BookingDate;
use App\Models\Page\BookingCancel;
use App\Models\Page\Document;
use App\Models\Page\Reschedule;
use App\Models\Admin\Consultation;
use Session;
use Illuminate\Support\Facades\Input;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }
    
    public function index()
    {
        $bookings = Booking::all();
        
        $advisers = User::where('level','adviser')->where('approved','1')->get();
        $users = User::whereNull('level')->get();
        $consultations = Consultation::all();
        
        return view('admin.bookings.index')->withBookings($bookings)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
    }
    
    public function fetch()
    {
      $bookings = Booking::all();
      
       $advisers = User::where('level','adviser')->where('approved','1')->get();
       $users = User::whereNull('level')->get();
       $consultations = Consultation::all();
      
      $adviser = Input::get ('adviser');
      $user = Input::get ('user');
      $mode = Input::get ('mode');
      $date = Input::get ('date');
      
    	if($adviser != ""){
    	$booking = Booking::where('user_id', $adviser)->get();
    	if (count ( $booking ) > 0)
    		return view('admin.bookings.index')->withBookings($booking)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
    	}
    	else if($user != ""){
    	$booking = Booking::where('client_id', $user)->get();
    	if (count ( $booking ) > 0)
    		return view('admin.bookings.index')->withBookings($booking)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
    	}
    	else if($mode != ""){
    	$booking = Booking::where('availability_id', $aid)->get();
    	if (count ( $booking ) > 0)
    		return view('admin.bookings.index')->withBookings($booking)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
    	}
    	else if($date != ""){
    	$booking = Booking::where('date','LIKE', '%'.$date.'%')->get();
    	if (count ( $booking ) > 0)
    		return view('admin.bookings.index')->withBookings($booking)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
    	}
    		return view('admin.bookings.index')->withMessage('No Results found. Try again !')->withBookings($bookings)->withAdvisers($advisers)->withUsers($users)->withConsultations($consultations);
   }
    
    public function changeAdviser(Request $request, $id)
    {
        $this->validate($request, ['user_id' => 'required']);
        
        $booking = Booking::find($id);
        $booking->user_id = $request->user_id;
        $booking->save();
        return redirect()->back();
    }


     public function reschedule(Request $request, $id)
     {
       $this->validate($request , [
         'date' => 'required',
         'time' => 'required'
       ]);

       $booking = Booking::find($id);

       $reschedule = $booking->reschedule;
       if($reschedule){
         Session::flash('danger', 'Already rescheduled');
       } else {

         $booking->date = $request->date.' '.$request->time;
         $booking->save();

         $reschedule = new Reschedule;
         $reschedule->reschedule_by = 'adviser';
         $reschedule->user_id = $booking->user_id;
         $reschedule->booking_id = $id;
         $reschedule->save();
       }

       return redirect()->back();
     }

}
