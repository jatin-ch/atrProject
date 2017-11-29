<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BasicDetail;
use App\Models\Admin\AdviserBasic;
use App\User;
use Auth;
use Image;
use Session;

class BasicProfileController extends Controller
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
        'firstname' => 'required|string|max:80',
        'lastname' => 'required|string|max:80',
        'gender' => 'required',
        'dob' => 'required',
        'mobile' => 'required|max:10|unique:basic_details',
        'email' => 'required|email|unique:basic_details',
        'language' => 'required|string',
        'linkedin' => 'required'
      ]);

      $basicdetail = new BasicDetail;
      $basicdetail->firstname = $request->firstname;
      $basicdetail->lastname = $request->lastname;
      $basicdetail->gender = $request->gender;
      $basicdetail->dob = $request->dob;
      $basicdetail->mobile = $request->mobile;
      $basicdetail->email = $request->email;
      if($request->hasFile('image')){
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(150,150)->save($location);
          $basicdetail->image = $filename;
        }

      $basicdetail->user_id = $request->user_id;
      $basicdetail->save();

      if($basicdetail->save()){
        $adviserbasic = new AdviserBasic;
        $adviserbasic->landline = $request->landline;
        $adviserbasic->language = $request->language;
        $adviserbasic->website = $request->website;
        $adviserbasic->facebook = $request->facebook;
        $adviserbasic->linkedin = $request->linkedin;
        $adviserbasic->basic_detail_id = $basicdetail->id;
        $adviserbasic->save();
      }

      Session::flash('success','basic profile has been created.');
      return redirect()->back();
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
      $basicDetail = $user->basicDetail;
      if($basicDetail){
        return view("admin.manage.basicProfile.show")->withUser($user);
      } else {
        return view("admin.manage.basicProfile.create")->withUser($user);
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
        'firstname' => 'required|string|max:80',
        'lastname' => 'required|string|max:80',
        'gender' => 'required',
        'dob' => 'required',
        'language' => 'required|string',
        'linkedin' => 'required'
      ]);

      $user = user::find($id);
      $basicdetail = $user->basicDetail;
      $basicdetail->firstname = $request->firstname;
      $basicdetail->lastname = $request->lastname;
      $basicdetail->gender = $request->gender;
      $basicdetail->dob = $request->dob;
      $basicdetail->save();

      if($basicdetail->save()){
        $adviserbasic = $basicdetail->adviserbasic;
        $adviserbasic->landline = $request->landline;
        $adviserbasic->language = $request->language;
        $adviserbasic->website = $request->website;
        $adviserbasic->facebook = $request->facebook;
        $adviserbasic->linkedin = $request->linkedin;
        $adviserbasic->save();
      }

      Session::flash('success','profile was saved!');
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
        //
    }
}
