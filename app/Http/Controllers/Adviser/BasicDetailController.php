<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BasicDetail;
use App\Models\Admin\AdviserBasic;
use App\User;
use Auth;
use Image;
use Session;

class BasicDetailController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:adviser');
    }

    public function index()
    {
      $basicdetail = Auth::user()->basicDetail;

      $pw = 0;
      if(isset(Auth::user()->basicDetail))
      {
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
      }


      if($basicdetail){
        return view('adviser.basicDetails.index')->withPw($pw);
      } else {
        return view('adviser.basicDetails.create')->withpw($pw);
      }

    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'firstname' => 'required|string|max:80',
          'lastname' => 'required|string|max:80',
          'gender' => 'required',
          'dob' => 'required',
          'mobile' => 'required|integer|min:10|max:10|unique:basic_details',
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
            $image->move(base_path() . '/public/uploads/', $filename);
            $basicdetail->image = $filename;
          }

        $basicdetail->user_id = Auth::user()->id;
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

        Session::flash('success','Your basic profile has been created.');
        return redirect()->route('adviser.basicDetails.index');
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
        'mobile' => 'required|integer|max:10',
        'email' => 'required|email',
        'language' => 'required|string',
        'linkedin' => 'required'
      ]);

      $basicdetail->firstname = $request->firstname;
      $basicdetail->lastname = $request->lastname;
      $basicdetail->gender = $request->gender;
      $basicdetail->dob = $request->dob;
      $basicdetail->mobile = $request->mobile;
      $basicdetail->email = $request->email;
      $basicdetail->save();

      if($basicdetail->save()){
        $adviserbasic = $basicdetail->adviserBasic;
        $adviserbasic->landline = $request->landline;
        $adviserbasic->language = $request->language;
        $adviserbasic->website = $request->website;
        $adviserbasic->facebook = $request->facebook;
        $adviserbasic->linkedin = $request->linkedin;
        $adviserbasic->save();
      }

      Session::flash('success','Your basic profile has been saved.');
      return redirect()->route('adviser.basicDetails.index');
    }
}
