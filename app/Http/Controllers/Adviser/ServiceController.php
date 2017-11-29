<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\Admin\Consultation;
use App\Models\Admin\Benifit;
use App\Models\Admin\Package;
use App\User;
use Auth;
use Image;
use Session;

class ServiceController extends Controller
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
      $consultations = Consultation::all();
      $services = User::find(Auth::user()->id)->services;
      return view('adviser.services.index')->withServices($services)->withConsultations($consultations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $consultations = Consultation::all();
      return view('adviser.services.create')->withConsultations($consultations);
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
        'name' => 'required|max:50',
        'duration' => 'required|integer',
        'validity' => 'required|integer',
        'frequency' => 'required|integer',
        'presence' => 'required',
        'price' => 'required',
        'payout' => 'required'
      ));

      $service = new Service;
      $service->name = $request->name;
      $service->duration = $request->duration;
      $service->validity = $request->validity;
      $service->frequency = $request->frequency;
      $service->price = $request->price;
      $service->commision = $request->commision;
      $service->payout = $request->payout;
      $service->timeline = true;
      $service->details = $request->details;
      $service->presence = $request->presence;
      $service->user_id = Auth::user()->id;
      $service->save();

      if($service->save()){

        $service = Service::where('name', '=', $request->name)->first();

        if(count($request->benifit) > 0){
          foreach($request->benifit as $key => $v){
            $data = array(
              'benifit' => $request->benifit [$key],
              'service_id' => $service->id
            );
            Benifit::insert($data);
          }
        }

        if(count($request->include) > 0){
          foreach($request->include as $key => $v){
            $data = array(
              'include' => $request->include [$key],
              'service_id' => $service->id
            );
            Package::insert($data);
          }

      }

      $service->consultations()->sync($request->consultations, false);

      Session::flash('success','Service was added!');
      return redirect()->route('services.index');
    }

  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $service = Service::find($id);
      $user = $service->user;
      $mainuser = User::find(Auth::user()->id);

      if($mainuser == $user){
        return view('adviser.services.show')->withService($service);
      } else {
        return redirect()->back();
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
      $service = Service::find($id);
      $user = $service->user;
      $mainuser = User::find(Auth::user()->id);

      $consultations = Consultation::all();
      $consultations2 = array();
      foreach($consultations as $consultation)
      {
        $consultations2[$consultation->id] = $consultation->mode;
      }

      if($mainuser == $user){
        return view('adviser.services.edit')->withService($service)->withConsultations($consultations2);
      } else {
        return redirect()->back();
      }

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
        'name' => 'required|max:50',
        'duration' => 'required|integer',
        'validity' => 'required|integer',
        'frequency' => 'required|integer',
        'presence' => 'required',
        'price' => 'required',
        'payout' => 'required'
      ));

      $service = Service::find($id);
      $service->name = $request->name;
      $service->duration = $request->duration;
      $service->validity = $request->validity;
      $service->frequency = $request->frequency;
      $service->price = $request->price;
      $service->commision = $request->commision;
      $service->payout = $request->payout;
      $service->timeline = $request->timeline;
      $service->details = $request->details;
      $service->presence = $request->presence;
      $service->save();

      if(isset($request->consultations))
      {
          $service->consultations()->sync($request->consultations);
      }
      else
      {
          $service->consultations()->sync(array());
      }

      Session::flash('success','Service was saved!');
      return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $service = Service::find($id);
    //  $service->offers()->detach();

     $benifits = Benifit::where('service_id', '=', $service->id)->get();
     foreach($benifits as $benifit){
        $benifit->delete();
     }

      $packages = Package::where('service_id', '=', $service->id)->get();
     foreach($packages as $package){
       $package->delete();
     }
      $service->consultations()->detach();
      $service->delete();

      Session::flash('success','Service deleted Successfully!!');
      return redirect()->route('services.index');
    }
}
