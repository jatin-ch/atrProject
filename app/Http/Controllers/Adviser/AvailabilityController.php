<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Availability;
use App\Models\Admin\Consultation;
use App\Models\Admin\Location;
use App\Models\Admin\FirstShift;
use App\User;
use Auth;
use Session;

class AvailabilityController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:adviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function phoneCall()
    {
      $availability = Availability::where('user_id',Auth::user()->id)->where('consultation_mode','phone_call')->first();
      if($availability){
        return view('adviser.availabilities.phone_call.index')->withAvailability($availability);
      } else {
        $consultations = Consultation::all();
        return view('adviser.availabilities.phone_call.create');
      }
    }

    public function videoCall()
    {
      $availability = Availability::where('user_id',Auth::user()->id)->where('consultation_mode','video_call')->first();
      if($availability){
        return view('adviser.availabilities.video_call.index')->withAvailability($availability);
      } else {
        $consultations = Consultation::all();
        return view('adviser.availabilities.video_call.create');
      }
    }

    public function personalMeeting()
    {
      $availability = Availability::where('user_id',Auth::user()->id)->where('consultation_mode','personal_meeting')->first();
      if($availability){
        return view('adviser.availabilities.personal_meeting.index')->withAvailability($availability);
      } else {
        $consultations = Consultation::all();
        return view('adviser.availabilities.personal_meeting.create');
      }
    }

    public function chat()
    {
      $availability = Availability::where('user_id',Auth::user()->id)->where('consultation_mode','chat')->first();
      if($availability){
        return view('adviser.availabilities.chat.index')->withAvailability($availability);
      } else {
        $consultations = Consultation::all();
        return view('adviser.availabilities.chat.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $availability = new Availability;
        $consultation_mode = $request->consultation_mode;
        $availability->consultation_mode = $consultation_mode;
        if(isset($request->time_slot)){
          $availability->time_slot = $request->time_slot;
        } else {
          $availability->consultation_question = $request->consultation_question;
        }

        if(isset($request->consultation_fee)){
          $availability->consultation_fee = $request->consultation_fee;
          $availability->consultation_commision = Auth::user()->commission->price;
          $availability->consultation_payout = ($request->consultation_fee - Auth::user()->commission->price);
          $availability->free_consultation = false;
        }
        else{
          $availability->consultation_fee = 0;
          $availability->consultation_commision = 0;
          $availability->consultation_payout = 0;
          $availability->free_consultation = true;
        }
        $availability->user_id = Auth::user()->id;
        $availability->save();

        if($availability->save()){
          if(count($request->day) > 0){
            foreach($request->day as $key => $v){
              if(!empty($request->day [$key])){
                $firstshift = new FirstShift;
                $firstshift->day = $request->day [$key];
                $firstshift->time_from = $request->time_from [$key];
                $firstshift->time_to = $request->time_to [$key];
                if(!empty($request->location [$key])){
                  $firstshift->location_id = $request->location [$key];
                }

                $firstshift->availability_id = $availability->id;
                $firstshift->user_id = Auth::user()->id;
                $firstshift->save();

              }

            }
          }
        }

        Session::flash('success','Availability added Successfully!!');
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $availability = Availability::find($id);
       $firstshifts = FirstShift::where('availability_id', '=', $availability->id)->get();
       $consultations = Consultation::all();
       $locations = Location::where('user_id', '=', Auth::user()->id)->get();
       $Locations2 = array();
       foreach($locations as $location){
         $locations2[$location->id] = $location->address;
       }
       return view('adviser.availabilities.edit')->withAvailability($availability)->withFirstshifts($firstshifts)->withConsultations($consultations)->withLocations($locations2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $availability = Availability::find($id);
      if(isset($request->time_slot)){
        $availability->time_slot = $request->time_slot;
      } else {
        $availability->consultation_question = $request->consultation_question;
      }

      if(isset($request->free_consultation)){
        $availability->consultation_fee = 0;
        $availability->consultation_commision = 0;
        $availability->consultation_payout = 0;
        $availability->free_consultation = true;
      }
      else{
        $availability->consultation_fee = $request->consultation_fee;
        $availability->consultation_payout = ($request->consultation_fee - Auth::user()->commission->price);
        $availability->free_consultation = false;
      }
      $availability->save();

      Session::flash('success','Availability was saved!');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $availability = Availability::find($id);
        $firstshifts = FirstShift::where('availability_id', '=', $availability->id)->get();
        foreach($firstshifts as $firstshift)
        {
          $firstshift->delete();
        }
        $availability->delete();
        return redirect()->back();
    }
}
