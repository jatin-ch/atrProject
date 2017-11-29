<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BasicDetail;
use App\Models\User\UserBasic;
use App\User;
use Auth;
use Session;

class BasicDetailController extends Controller
{
    public function __construct()
    {
      // $this->middleware('auth');
    }

    public function index()
    {
      $basicdetail = Auth::user()->basicDetail;

      if($basicdetail){
        return view('user.basicDetails.index');
      } else {
        return view('user.basicDetails.create');
      }

    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'firstname' => 'required|string|max:80',
          'lastname' => 'required|string|max:80',
          'gender' => 'required',
          'dob' => 'required',
          'mobile' => 'required|max:10|unique:basic_details',
          'email' => 'required|email|unique:basic_details',
          'address' => 'required',
          'locality' => 'required',
          'country' => 'required',
          'state' => 'required',
          'city' => 'required',
          'pin' => 'required'
        ]);

        $basicdetail = new BasicDetail;
        $basicdetail->firstname = $request->firstname;
        $basicdetail->lastname = $request->lastname;
        $basicdetail->gender = $request->gender;
        $basicdetail->dob = $request->dob;
        $basicdetail->mobile = $request->mobile;
        $basicdetail->email = $request->email;
        $basicdetail->user_id = Auth::user()->id;
        $basicdetail->save();

        if($basicdetail->save()){
          $userbasic = new UserBasic;
          $userbasic->address = $request->address;
          $userbasic->locality = $request->locality;
          $userbasic->country = $request->country;
          $userbasic->state = $request->state;
          $userbasic->city = $request->city;
          $userbasic->pin = $request->pin;
          $userbasic->basic_detail_id = $basicdetail->id;
          $userbasic->save();
        }

        Session::flash('success','Your basic profile has been created.');
        return redirect()->route('user.basicDetails.index');
    }


    public function update(Request $request, $id)
    {
      //$basicdetail = BasicDetail::find($id);
      $basicdetail = User::find($id)->basicDetail;

      $this->validate($request, [
        'firstname' => 'required|string|max:80',
        'lastname' => 'required|string|max:80',
        'gender' => 'required',
        'dob' => 'required',
        'mobile' => 'required|max:10',
        'email' => 'required|email',
        'address' => 'required',
        'locality' => 'required',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'pin' => 'required'
      ]);

      $basicdetail->firstname = $request->firstname;
      $basicdetail->lastname = $request->lastname;
      $basicdetail->gender = $request->gender;
      $basicdetail->dob = $request->dob;
      $basicdetail->mobile = $request->mobile;
      $basicdetail->email = $request->email;
      $basicdetail->save();

      if($basicdetail->save()){
        $userbasic = $basicdetail->userBasic;
        $userbasic->address = $request->address;
        $userbasic->locality = $request->locality;
        $userbasic->country = $request->country;
        $userbasic->state = $request->state;
        $userbasic->city = $request->city;
        $userbasic->pin = $request->pin;
        $userbasic->save();
      }

      Session::flash('success','Your basic profile has been saved.');
      return redirect()->route('user.basicDetails.index');
    }
}
