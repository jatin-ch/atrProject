<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Verification;
use App\User;
use Auth;
use Image;
use Session;

class VerificationController extends Controller
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
      $verification = User::find(Auth::user()->id)->verification;

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

      if($verification) {
        return view('adviser.verifications.index')->withPw($pw);
      } else {
        return view('adviser.verifications.create')->withPw($pw);
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
         $this->validate($request, [
          'qualification' => 'required|mimes:pdf',
          'degree' => 'required',
          'govt_auth_letter' => 'required',
          //'exp_letter' => 'mimes:pdf|max:10000',
          //'award_certi' => 'mimes:pdf|max:10000',
          'id_proof' => 'required|mimes:jpeg',
          'aadhar_card' => 'required|mimes:jpeg'
         ]);

         $verification = new Verification;
         if($request->hasFile('qualification')){
             $qualification = $request->file('qualification');
             $filename = time() . $qualification->getClientOriginalName() . '.' . $qualification->getClientOriginalExtension();
             $qualification->move(base_path() . '/public/uploads/', $filename);
             $verification->qualification = $filename;
           }
           if($request->hasFile('degree')){
               $degree = $request->file('degree');
               $filename = time() . $degree->getClientOriginalName() . '.' . $degree->getClientOriginalExtension();
               $degree->move(base_path() . '/public/uploads/', $filename);
               $verification->degree = $filename;
             }
             if($request->hasFile('govt_auth_letter')){
                 $govt_auth_letter = $request->file('govt_auth_letter');
                 $filename = time() . $govt_auth_letter->getClientOriginalName() . '.' . $govt_auth_letter->getClientOriginalExtension();
                 $govt_auth_letter->move(base_path() . '/public/uploads/', $filename);
                 $verification->govt_auth_letter = $filename;
               }
               if($request->hasFile('exp_letter')){
                   $exp_letter = $request->file('exp_letter');
                   $filename = time() . $exp_letter->getClientOriginalName() . '.' . $exp_letter->getClientOriginalExtension();
                   $exp_letter->move(base_path() . '/public/uploads/', $filename);
                   $verification->exp_letter = $filename;
                 }
                 if($request->hasFile('award_certi')){
                     $award_certi = $request->file('award_certi');
                     $filename = time() . $award_certi->getClientOriginalName() . '.' . $award_certi->getClientOriginalExtension();
                     $award_certi->move(base_path() . '/public/uploads/', $filename);
                     $verification->award_certi = $filename;
                   }
               if($request->hasFile('id_proof')){
                   $id_proof = $request->file('id_proof');
                   $filename = time() . $id_proof->getClientOriginalName() . '.' . $id_proof->getClientOriginalExtension();
                   $location = public_path('uploads/' . $filename);
                   Image::make($id_proof)->resize(300,300)->save($location);
                   $verification->id_proof = $filename;
                 }
                 if($request->hasFile('aadhar_card')){
                     $aadhar_card = $request->file('aadhar_card');
                     $filename = time() . $aadhar_card->getClientOriginalName() . '.' . $aadhar_card->getClientOriginalExtension();
                     $location = public_path('uploads/' . $filename);
                     Image::make($aadhar_card)->resize(400,300)->save($location);
                     $verification->aadhar_card = $filename;
                   }

          $verification->user_id = Auth::user()->id;
          $verification->save();

          Session::flash('success','Your verification details uploaded successfully!');
          return redirect()->route('adviser.verifications.index');
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
        //
    }
}
