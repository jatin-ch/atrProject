<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Page\Booking;
use App\Models\Page\BookingCancel;
use App\Models\Page\Document;
use App\Models\Client\Dispute;
use Session;

class BookingRecievedController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }

    public function showConsultation()
    {
      $consultations = Booking::where('client_id',Auth::user()->id)->where('type','=','consultation')->get();
      return view('adviser.bookings.recieved.consultation')->withConsultations($consultations);
    }

    public function confirmConsultation(Request $request, $id)
    {
         $booking = Booking::find($id);
         if(isset($request->date)){
           $booking->confirm = true;
           $booking->date = $request->date.' '.$request->time;
           $booking->status = 'upcoming';
       }
       $booking->save();
       return redirect()->route('bookings.recieved.consultation');
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
       $booking->status = 'canceled';
       $booking->save();
       return redirect()->route('bookings.recieved.consultation');

    }







    public function showService()
    {
      $services = Booking::where('client_id',Auth::user()->id)->where('type','=','service')->get();
      return view('adviser.bookings.recieved.service')->withServices($services);
    }

    public function confirmService(Request $request, $id)
    {
         $booking = Booking::find($id);
         if(isset($request->date)){
           $booking->confirm = true;
           $booking->date = $request->date.' '.$request->time;
           $booking->status = 'upcoming';
       }
       $booking->save();
       $bookingdates = $booking->ServiceBookingDates;
       foreach($bookingdates as $bookingdate){
         $bookingdate->delete();
       }
       return redirect()->route('bookings.recieved.service');
    }

    public function cancelService(Request $request, $id)
    {
       $booking = Booking::find($id);
       $this->validate($request, ['reason' => 'required', 'booking_id' => 'unique:booking_cancels']);
       $cancel = new BookingCancel;
       $cancel->reason = $request->reason;
       $cancel->cancel_by = 'user';
       $cancel->booking_id = $booking->id;
       $cancel->save();
       $booking->status = 'canceled';
       $booking->save();
       $bookingdates = $booking->BookingDates;
       foreach($bookingdates as $bookingdate){
         $bookingdate->delete();
       }
       return redirect()->route('bookings.recieved.service');

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
      $document->sender = 'user';
      $document->user_id = $user->id;
      $document->booking_id = $id;
      $document->save();
      return redirect()->route('bookings.recieved.consultation');
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
      $document->sender = 'user';
      $document->user_id = $user->id;
      $document->booking_id = $id;
      $document->save();
      return redirect()->route('bookings.recieved.service');
    }




    public function raiseDispute(Request $request, $id)
    {
      $this->validate($request, ['reason' => 'required', 'booking_id' => 'unique:disputes']);
      $booking = Booking::find($id);
      $booking->status = 'dispute';
      $booking->save();
      $dispute = new Dispute;
      $dispute->reason = $request->reason;
      $dispute->booking_id = $booking->id;
      $dispute->save();
      return redirect()->route('bookings.recieved.service');
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
        $reschedule->reschedule_by = 'user';
        $reschedule->user_id = Auth::user()->id;
        $reschedule->booking_id = $id;
        $reschedule->save();
      }

      return redirect()->back();
    }



}
