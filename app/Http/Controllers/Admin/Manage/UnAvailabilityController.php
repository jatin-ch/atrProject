<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\UnAvailability;
use App\Models\Admin\Consultation;
use App\User;
use Auth;
use Carbon\Carbon;

class UnAvailabilityController extends Controller
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
    public function index()
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
        if($days==0);{
          $days = date('l', strtotime($request->from_date));
        }
        $unavailability->days = $days;

        if(isset($request->off_all)){
          $unavailability->off_all = $request->off_all;
        } else{
            $unavailability->service = $request->service;
            $unavailability->off_all = false;
        }
        $unavailability->user_id = $request->user_id;
        $unavailability->save();

        $unavailability->consultations()->sync($request->consultations, false);

        // if($request->service == 'consultation'){
        //   $unavailability->consultations()->sync($request->consultations, false);
        // }
        return redirect()->route('un-availability.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainuser = User::find(Auth::user()->id);
        $user = User::find($id);
        $consultations = Consultation::all();

        if($mainuser->level == 'superadministrator'){
           return view("admin.manage.un-availability.show")->withUser($user)->withConsultations($consultations);
        } elseif ($mainuser->level == 'administrator') {
          if($user->level == 'superadviser' || $user->level == 'adviser'){
            return view("admin.manage.un-availability.show")->withUser($user)->withConsultations($consultations);
          } else {
            return redirect()->route('admin.dashboard');
          }

        } elseif ($mainuser->level == 'superadviser') {
          if($user->level == 'adviser'){
            return view("admin.manage.un-availability.show")->withUser($user)->withConsultations($consultations);
          } else {
            return redirect()->route('admin.dashboard');
          }

        } else {
          return redirect()->route('admin.dashboard');
        }
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

        return redirect()->route('un-availability.show', $unavailability->user_id);
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
        $user_id = $unavailability->user_id;
        $unavailability->consultations()->detach();
        $unavailability->delete();
        return redirect()->route('un-availability.show', $user_id);
    }
}
