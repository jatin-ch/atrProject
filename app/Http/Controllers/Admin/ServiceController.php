<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
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
      $consultations = Consultation::all();
      $services = Service::orderBy('id', 'desc')->paginate('4');
      return view('admin.services.index')->withServices($services)->withConsultations($consultations);
    }
    
     public function search()
    {
      $services = Service::orderBy('id', 'desc')->paginate('4');
      $q = Input::get ('q');
    	if($q != ""){
    	$service = Service::where('name', 'LIKE', '%' . $q . '%' )->paginate('4');
    	if (count ( $service ) > 0)
    		return view('admin.services.index')->withServices($service)->withQuery($q);
    	}
    		return view('admin.services.index')->withMessage('No Service found. Try to search again !')->withServices($service);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users = User::where('level','adviser')->get();
      $consultations = Consultation::all();
      return view('admin.services.create')->withUsers($users)->withConsultations($consultations);
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
      $service->user_id = $request->userId;
      $service->save();

      if($service->save()){
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
      return redirect()->route('admin.services.index');
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
      return view('admin.services.show')->withService($service);
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

      $consultations = Consultation::all();
      $consultations2 = array();
      foreach($consultations as $consultation)
      {
        $consultations2[$consultation->id] = $consultation->mode;
      }

      return view('admin.services.edit')->withService($service)->withConsultations($consultations2);

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
      return redirect()->route('admin.services.index');
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
      $service->offers()->detach();

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
      return redirect()->route('admin.services.index');
    }
}
