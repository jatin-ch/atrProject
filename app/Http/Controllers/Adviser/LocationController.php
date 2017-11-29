<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Location;
use Auth;
use App\User;
use Session;

class LocationController extends Controller
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
      $locations = User::find(Auth::user()->id)->locations;

      $pw = 0;
      if(Auth::user()->basicDetail->image){
        $pw += 20;
      }
      if(Auth::user()->expertDetail){
        $pw += 20;
      }
      if(Auth::user()->verification){
        $pw += 10;
      }
      if(Auth::user()->availabilities->count() > 0){
        $pw += 20;
      }
      if(Auth::user()->locations->count() > 0){
        $pw += 10;
      }
      if(Auth::user()->galleries->count() > 0){
        $pw += 20;
      }

      return view('adviser.locations.index')->withLocations($locations)->withPw($pw);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, array(
        'address' => 'required|max:100',
        'locality'=> 'required',
        'country'=> 'required',
        'state'=> 'required',
        'city'=> 'required',
        'pin'=> 'required|integer',
        'mobile'=> 'required|integer|max:10|min:10',
        'address_type'=> 'required'
      ));

      $location = new Location;
      $location->address = $request->address;
      $location->locality = $request->locality;
      $location->country = $request->country;
      $location->state = $request->state;
      $location->city = $request->city;
      $location->pin = $request->pin;
      $location->mobile = $request->mobile;
      $location->address_type = $request->address_type;
      if(isset($request->default_address)){
        $location->default_address = $request->default_address;
      }
      else {
        $location->default_address = false;
      }
      $location->user_id = Auth::user()->id;
      $location->save();
      Session::flash('success','Location Added Successfully!!');
      return redirect()->route('adviser.locations.index');
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
      $location = Location::find($id);

      $this->validate($request, array(
        'address' => 'required|max:100',
        'locality'=> 'required',
        'country'=> 'required',
        'state'=> 'required',
        'city'=> 'required',
        'pin'=> 'required|integer',
        'mobile'=> 'required|integer|min:10|max:10',
        'address_type'=> 'required'
      ));

      $location->address = $request->address;
      $location->locality = $request->locality;
      $location->country = $request->country;
      $location->state = $request->state;
      $location->city = $request->city;
      $location->pin = $request->pin;
      $location->mobile = $request->mobile;
      $location->address_type = $request->address_type;
      if(isset($request->default_address)){
        $location->default_address = $request->default_address;
      }
      else {
        $location->default_address = false;
      }
      $location->save();

      Session::flash('success','Location Updated Successfully!!');
      return redirect()->route('adviser.locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $location = Location::find($id);
      $location->delete();

      Session::flash('info','Location deleted Successfully!!');
      return redirect()->route('adviser.locations.index');

    }
}
