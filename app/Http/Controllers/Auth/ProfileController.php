<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client\ClientDetail;
use App\Client;
use Auth;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $profile = Client::find(Auth::user()->id)->clientDetail;
         if($profile){
           return view('client.profile.index')->withProfile($profile);
         }
         else{
           return view('client.profile.create');
         }
     }

     public function store(Request $request)
     {
         $this->validate($request, [
           'firstname' => 'required|string|max:20',
           'lastname' => 'required|string|max:20',
           'gender' => 'required',
           'dob' => 'required|date',
           'mobile' => 'required|max:10|unique:client_details',
           'email' => 'required|email|unique:client_details',
           'address' => 'required',
           'locality' => 'required',
           'country' => 'required',
           'state' => 'required',
           'city' => 'required',
           'pin' => 'required'
         ]);

         $profile = new ClientDetail;
         $profile->firstname = $request->firstname;
         $profile->lastname = $request->lastname;
         $profile->gender = $request->gender;
         $profile->dob = $request->dob;
         $profile->mobile = $request->mobile;
         $profile->email = $request->email;
         $profile->address = $request->address;
         $profile->locality = $request->locality;
         $profile->country = $request->country;
         $profile->state = $request->state;
         $profile->city = $request->city;
         $profile->pin = $request->pin;
         $profile->client_id = Auth::user()->id;
         $profile->save();

         Session::flash('status','Profile Created Successfully.');
         return redirect()->route('profile.index');
     }

     public function edit($clientname)
     {
      $client = Client::find(Auth::user()->id)->clientDetail;
      //$profile = ClientDetail::where('id', '=', $client->id)->get()->first();
      $profile = ClientDetail::find($client->id);
       return view('client.profile.edit')->withProfile($profile);
     }

     public function update(Request $request, $clientname)
     {
         $this->validate($request, [
           'firstname' => 'required|string|max:20',
           'lastname' => 'required|string|max:20',
           'gender' => 'required',
           'dob' => 'required|date',
           //'mobile' => 'required|max:10|unique:client_details',
           //'email' => 'required|email|unique:client_details',
           'address' => 'required',
           'locality' => 'required',
           'country' => 'required',
           'state' => 'required',
           'city' => 'required',
           'pin' => 'required'
         ]);

         $client = Client::find(Auth::user()->id)->clientDetail;
         $profile = ClientDetail::find($client->id);
         //$profile = ClientDetail::where('client_id', '=', $client->id)->get()->first();
         $profile->firstname = $request->firstname;
         $profile->lastname = $request->lastname;
         $profile->gender = $request->gender;
         $profile->dob = $request->dob;
         $profile->mobile = $request->mobile;
         $profile->email = $request->email;
         $profile->address = $request->address;
         $profile->locality = $request->locality;
         $profile->country = $request->country;
         $profile->state = $request->state;
         $profile->city = $request->city;
         $profile->pin = $request->pin;
         $profile->save();

         Session::flash('status','Profile Updated Successfully.');
         return redirect()->route('profile.index');
     }


}
