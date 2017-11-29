<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Offer;
use App\Models\Admin\Service;
use App\Models\Admin\Consultation;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;

class OfferController extends Controller
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
      $offers = Offer::orderBy('id','desc')->paginate('4');
      return view('admin.offers.index')->withOffers($offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $consultations = Consultation::All();
      $services = Service::all();
      $users = User::where('level','adviser')->get();
      return view('admin.offers.create')->withServices($services)->withConsultations($consultations)->withUsers($users);
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
        'title' => 'required|max:60',
        'offer_for' => 'required',
        'discount_type' => 'required',
        'more' => 'required|max:190'
      ));

      $offer = new Offer;
      $offer->title = $request->title;
      $offer->offer_for = $request->offer_for;
      $offer->discount_type = $request->discount_type;
      $offer->percent_discount = $request->percent_discount;
      $offer->discount_limit = $request->discount_limit;
      $offer->flat_discount = $request->flat_discount;
      $offer->valid_from = $request->valid_from;
      $offer->valid_to = $request->valid_to;
      $offer->more = $request->more;
      $offer->user_id = $request->userId;
      $offer->save();

      $offer->services()->sync($request->services, false);
      $offer->consultations()->sync($request->consultations, false);

      Session::flash('success','Offer created Successfully!');
      return redirect()->route('admin.offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $offer = Offer::find($id);
      return view('admin.offers.show')->withOffer($offer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $offer = Offer::find($id);
      $services = Service::all();

      $services2 = array();
      foreach($services as $service)
      {
        $services2[$service->id] = $service->name;
      }

      $consultations = Consultation::all();
      $consultations2 = array();
      foreach($consultations as $consultation)
      {
        $consultations2[$consultation->id] = $consultation->mode;
      }

      return view('admin.offers.edit')->withOffer($offer)->withServices($services2)->withConsultations($consultations2);

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
      $offer = Offer::find($id);

      $this->validate($request, array(
        'title' => 'required|max:60',
        'offer_for' => 'required',
        'discount_type' => 'required',
        'more' => 'required|max:190'
      ));

      $offer->title = $request->title;
      $offer->offer_for = $request->offer_for;
      $offer->discount_type = $request->discount_type;
      $offer->percent_discount = $request->percent_discount;
      $offer->discount_limit = $request->discount_limit;
      $offer->flat_discount = $request->flat_discount;
      $offer->valid_from = $request->valid_from;
      $offer->valid_to = $request->valid_to;
      $offer->more = $request->more;
      $offer->save();

      if(isset($request->services))
      {
          $offer->services()->sync($request->services);
      }
      else
      {
          $offer->services()->sync(array());
      }

      if(isset($request->consultations))
      {
          $offer->consultations()->sync($request->consultations);
      }
      else
      {
          $offer->consultations()->sync(array());
      }

      Session::flash('success','Offer Updated Successfully!!');
      return redirect()->route('admin.offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $offer = Offer::find($id);
      $offer->services()->detach();
      $offer->consultations()->detach();
      $offer->delete();

      Session::flash('success','Offer was deleted!');
      return redirect()->route('admin.offers.index');
    }
    
    
    public function filter()
    {
      $offers = Offer::all();
      $q = Input::get ('q');
      $q2 = Input::get('q2');
    	if($q != ""){
    	$offer = Offer::where('offer_for', $q)->orWhere('discount_type',$q2)->get();
    	if (count ( $offer ) > 0)
    		return view('admin.offers.index')->withQuery($q)->withOffers($offer);
    	}
    		return view('admin.offers.index')->withMessage('No Details found. Try to search again !')->withOffers($offer);
   }
}
