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
use Session;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }


    public function index()
    {
      $services = Booking::where('type','=','service')->get();
      $advisers = User::where('level','adviser')->where('approved','1')->get();
      
      return view('admin.bookings.service')->withServices($services)->withAdvisers($advisers);
    }

    public function confirm(Request $request, $id)
    {
       $user = User::find(Auth::user()->id)->expertDetail;

       if($user->type == 'professional'){
         $booking = Booking::find($id);
         $booking->confirm = true;
         $booking->status = 'upcoming';
         $booking->save();
       }

       else {
         $booking = Booking::find($id);

         if(isset($request->date)){
           $booking->confirm = true;
           $booking->date = $request->date;
           $booking->status = 'upcoming';
         }

         elseif (isset($request->sdate)) {
           $bookingdates = $booking->BookingDates;

           if(count($request->sdate) > 0){

           foreach($bookingdates as $bookingdate){
             $bookingdate->delete();
            }

             foreach($request->sdate as $key => $v){
               if(!empty($request->sdate [$key])){
                 $bookingdate = new BookingDate;
                 $bookingdate->date = $request->sdate [$key].' '.$request->stime [$key];
                 $bookingdate->booking_id = $id;
                 $bookingdate->suggest_by = 'adviser';
                 $bookingdate->save();
               }

             }
           }
         }
         $booking->save();
       }
        return redirect()->route('admin.services');
    }

    public function cancel(Request $request, $id)
    {
       $booking = Booking::find($id);
       $this->validate($request, ['reason' => 'required', 'booking_id' => 'unique:booking_cancels']);
       $cancel = new BookingCancel;
       $cancel->reason = $request->reason;
       $cancel->cancel_by = 'adviser';
       $cancel->booking_id = $booking->id;
       $cancel->save();
       $booking->confirm = false;
       $booking->status = 'canceled';
       $booking->save();
       $bookingdates = $booking->BookingDates;
       foreach($bookingdates as $bookingdate){
         $bookingdate->delete();
       }
       return redirect()->route('admin.services');
     }


     public function document(Request $request, $id)
     {
       $this->validate($request, ['doc' => 'required']);
       $user = Booking::find($id)->user;

       $document = new Document;
       if($request->hasFile('doc')){
           $doc = $request->file('doc');
           $filename = time() . '.' . $doc->getClientOriginalExtension();
           $doc->move(base_path() . '/public/documents/', $filename);
           $document->doc = $filename;
         }
       $document->sender = 'adviser';
       $document->user_id = $user->id;
       $document->booking_id = $id;
       $document->save();
       return redirect()->route('admin.services');
     }



}
