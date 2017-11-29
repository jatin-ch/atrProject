<?php

namespace App\Http\Controllers\Adviser;

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

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }

    public function showConsultation()
    {
      $consultations = Booking::where('user_id',Auth::user()->id)->where('type', '=', 'consultation')->get();
      return view('adviser.bookings.consultation.index')->withConsultations($consultations);
    }

    public function confirmConsultation(Request $request, $id)
    {
       $user = User::find(Auth::user()->id)->expertDetail;

       if($user->type == 'professional'){
         $booking = Booking::find($id);
         $booking->confirm = true;
         $booking->status = 'upcoming';
         $booking->save();
         return redirect()->route('adviser.bookings.consultation');
       }


        else {
         $booking = Booking::find($id);

         if(isset($request->date)){
          $this->validate($request, ['date' => 'required']);
           $booking->confirm = true;
           $booking->date = $request->date;
           $booking->status = 'upcoming';
         }

         elseif (isset($request->sdate) && !empty($request->sdate)) {

             $this->validate($request, ['sdate' => 'required', 'stime' => 'required']);

             if(count($request->sdate) > 0){

               $bookingdates = $booking->BookingDates;
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
         return redirect()->route('adviser.bookings.consultation');
       }
    }

    public function cancelConsultation(Request $request, $id)
    {
       $booking = Booking::find($id);
       $this->validate($request, ['reason' => 'required', 'booking_id' => 'unique:booking_cancels']);
       $cancel = new BookingCancel;
       $cancel->reason = $request->reason;
       $cancel->cancel_by = 'user';
       $cancel->booking_id = $booking->id;
       $cancel->save();
       $booking->confirm = false;
       $booking->status = 'canceled';
       $booking->save();
       return redirect()->route('adviser.bookings.consultation');
    }





    public function showService()
    {
      $services = Booking::where('user_id',Auth::user()->id)->where('type','=','service')->get();
      return view('adviser.bookings.service.index')->withServices($services);
    }

    public function confirmService(Request $request, $id)
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
        return redirect()->route('adviser.bookings.service');
    }

    public function cancelService(Request $request, $id)
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
       return redirect()->route('adviser.bookings.service');
     }








     public function sendConsultationDocument(Request $request, $id)
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
       return redirect()->route('adviser.bookings.consultation');
     }

     public function sendServiceDocument(Request $request, $id)
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
       return redirect()->route('adviser.bookings.service');
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
         $reschedule->user_id = Auth::user()->id;
         $reschedule->booking_id = $id;
         $reschedule->save();
       }

       return redirect()->back();
     }

}
