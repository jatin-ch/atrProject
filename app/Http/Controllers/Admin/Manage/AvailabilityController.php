<?php

namespace App\Http\Controllers\Admin\Manage;

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
        $this->middleware('role:superadministrator|administrator|superadviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $availabilities = User::find($request->user_id)->availabilities;
        foreach($availabilities as $availability){
          if($availability->consultation_mode == $request->consultation_mode){
           Session::flash('danger','You can not overwrite a consultation mode');
            return redirect()->route('availability.show', $request->user_id);
          }
        }

        $this->validate($request, [
          'consultation_mode' => 'required'
        ]);
        
        $user = User::find($request->user_id);

        $availability = new Availability;
        $availability->consultation_mode = $request->consultation_mode;
        $availability->time_slot = $request->time_slot;
        $availability->consultation_question = $request->consultation_question;
        if(isset($request->free_consultation)){
          $availability->consultation_fee = 0;
          $availability->consultation_commision = 0;
          $availability->consultation_payout = 0;
          $availability->free_consultation = true;
        }
        else{
          $availability->consultation_fee = $request->consultation_fee;
          $availability->consultation_commision = $user->commission->price;
          $availability->consultation_payout = ($request->consultation_fee - $user->commission->price);
          $availability->free_consultation = false;
        }
        $availability->user_id = $user->id;
        $availability->save();

        if($availability->save()){
          if(count($request->day) > 0){
            foreach($request->day as $key => $v){
              if(!empty($request->day [$key])){
                $firstshift = new FirstShift;
                $firstshift->day = $request->day [$key];
                $firstshift->time_from = $request->time_from [$key];
                $firstshift->time_to = $request->time_to [$key];
                $firstshift->location_id = $request->location [$key];
                $firstshift->availability_id = $availability->id;
                $firstshift->user_id = $request->user_id;
                $firstshift->save();

              }

            }
          }
        }

        return redirect()->route('availability.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $consultations = Consultation::all();
        return view("admin.manage.availability.show")->withUser($user)->withConsultations($consultations);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::find($request->user_id);
        $availability = Availability::find($id);
        $availability->time_slot = $request->time_slot;
        $availability->consultation_question = $request->consultation_question;
        if(isset($request->free_consultation)){
          $availability->consultation_fee = 0;
          $availability->consultation_commision = 0;
          $availability->consultation_payout = 0;
          $availability->free_consultation = true;
        }
        else{
          $availability->consultation_fee = $request->consultation_fee;
          $availability->consultation_payout = ($request->consultation_fee - $user->commission->price);
          $availability->free_consultation = false;
        }
        $availability->save();

        Session::flash('success','Updated Successful!');
        return redirect()->route('availability.show', $request->user_id);
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
        $user_id = $availability->user_id;
        $firstshifts = FirstShift::where('availability_id', '=', $availability->id)->get();
        foreach($firstshifts as $firstshift)
        {
          $firstshift->delete();
        }
        $availability->delete();
        return redirect()->route('availability.show', $user_id);
    }

}
