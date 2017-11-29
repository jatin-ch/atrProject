<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UnAvailability;
use App\Models\Admin\Consultation;
use App\User;
use Auth;
use Session;
use Carbon\Carbon;

class UnAvailabilityController extends Controller
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
    public function index()
    {
        $unavailabilities = User::find(Auth::user()->id)->unavailabilities;
        $consultations = Consultation::All();
        return view('adviser.un-availabilities.index')->withConsultations($consultations)->withUnavailabilities($unavailabilities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'from_date' => 'required',
          'from_time' => 'required',
          'to_date' => 'required',
          'to_time' => 'required'
        ]);

        $unavailability = new UnAvailability;
        $unavailability->from_date = $request->from_date;
        $unavailability->from_time = $request->from_time;
        $unavailability->to_date = $request->to_date;
        $unavailability->to_time = $request->to_time;

        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);
        $days = $end->diffInDays($start);
        if($days == 0){
          $days = date('l', strtotime($request->from_date));
        }
        $unavailability->days = $days;

        if(isset($request->off_all)){
          $unavailability->off_all = $request->off_all;
        } else{
            $unavailability->service = $request->service;
            $unavailability->off_all = false;
        }
        $unavailability->user_id = Auth::user()->id;
        $unavailability->save();

        if($request->service == 'consultation'){
          $unavailability->consultations()->sync($request->consultations, false);
        }

        Session::flash('success','Un-availability create successfully!!');
        return redirect()->route('un-availabilities.index');
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
        $this->validate($request, [
          'from_date' => 'required',
          'from_time' => 'required',
          'to_date' => 'required',
          'to_time' => 'required'
        ]);

        $unavailability = UnAvailability::find($id);
        $unavailability->from_date = $request->from_date;
        $unavailability->from_time = $request->from_time;
        $unavailability->to_date = $request->to_date;
        $unavailability->to_time = $request->to_time;

        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);
        $days = $end->diffInDays($start);
        if($days == 0){
          $days = date('l', strtotime($request->from_date));
        }
        $unavailability->days = $days;

        if(isset($request->off_all)){
          $unavailability->off_all = $request->off_all;
        } else{
            $unavailability->service = $request->service;
            $unavailability->off_all = false;
        }
        $unavailability->save();

        if(isset($request->consultations))
        {
            $unavailability->consultations()->sync($request->consultations);
        }
        else
        {
            $unavailability->consultations()->sync(array());
        }

        Session::flash('success','Un-availability updated successfully!!');
        return redirect()->route('un-availabilities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unavailability = UnAvailability::find($id);
        $unavailability->consultations()->detach();
        $unavailability->delete();
        Session::flash('success','Un-availability deleted successfully!!');
        return redirect()->route('un-availabilities.index');
    }
}
