<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Client\ConsultationBooking;
use App\Models\Admin\ConsultationInvoice;
use App\Models\Admin\ConsultationInvoiceDetail;

class ConsultationInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
      $invoices = ConsultationInvoice::all();
      return view('admin.invoice.consultation.index')->withInvoices($invoices);
    }


    public function create()
    {
      $bookings = ConsultationBooking::all();
      return view('admin.invoice.consultation.create')->withBookings($bookings);
    }

    public function store(Request $request)
    {
      $invoice = new ConsultationInvoice;
      $invoice->booking = count($request->consultation_booking_id);
      $invoice->status = $request->status;
      $consulting_fee = 0;
      foreach($request->consultation_booking_id as $id){
        $booking = ConsultationBooking::find($id);
        $consulting_fee += $booking->availability->consultation_fee;
      }
      $invoice->consulting_fee = $consulting_fee;
      $invoice->user_id = Auth::user()->id;
      $invoice->save();
      if($invoice->save()){
        if($invoice->booking > 0){
          foreach($request->consultation_booking_id as $id){
            $booking = ConsultationBooking::find($id);
            $invoice_detail = new ConsultationInvoiceDetail;
            $invoice_detail->consultation_booking_id = $id;
            $experties = $booking->user->expertDetail->major_cat;
            $invoice_detail->experties = $experties;
            $invoice_detail->consultation_mode = $booking->availability->consultation_mode;
            $invoice_detail->consulting_fee = $booking->availability->consultation_fee;
            $invoice_detail->adviceli_commision = $booking->availability->consultation_commision;
            $invoice_detail->consultation_invoice_id = $invoice->id;
            $invoice_detail->save();
          }
        }
      }

      //return view('admin.invoice.consultation.create')->withBookings($bookings);
    }
}
