<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BasicDetail;
use App\User;
use Auth;
use Image;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function index()
    {
      $basicdetail = Auth::user()->basicDetail;

      if($basicdetail){
        return view('admin.profile.index');
      } else {
        return view('admin.profile.create');
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
          'email' => 'required|email|unique:basic_details'
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

        Session::flash('success','Your basic profile has been created.');
        return redirect()->route('admin.profile.index');
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
        'email' => 'required|email'
      ]);

      $basicdetail->firstname = $request->firstname;
      $basicdetail->lastname = $request->lastname;
      $basicdetail->gender = $request->gender;
      $basicdetail->dob = $request->dob;
      $basicdetail->mobile = $request->mobile;
      $basicdetail->email = $request->email;
      $basicdetail->save();

      Session::flash('success','Your basic profile has been saved.');
      return redirect()->route('admin.profile.index');
    }
}
