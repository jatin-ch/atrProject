<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Admin\Location;

class AddressController extends Controller
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
        $this->validate($request, array(
          'address' => 'required|max:100',
          'locality'=> 'required',
          'country'=> 'required',
          'state'=> 'required',
          'city'=> 'required',
          'pin'=> 'required',
          'mobile'=> 'required|max:10',
          'address_type'=> 'required',
          'user_id' => 'required'
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
        $location->user_id = $request->user_id;
        $location->save();
        return redirect()->route('address.show', $request->user_id);
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
       return view("admin.manage.address.show")->withUser($user);
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
        $this->validate($request, array(
          'address' => 'required|max:100',
          'locality'=> 'required',
          'country'=> 'required',
          'state'=> 'required',
          'city'=> 'required',
          'pin'=> 'required',
          'mobile'=> 'required|max:10',
          'address_type'=> 'required'
        ));

        $location = Location::find($id);
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

        return redirect()->route('address.show', $request->user_id);
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
        return redirect()->back();
    }
}
