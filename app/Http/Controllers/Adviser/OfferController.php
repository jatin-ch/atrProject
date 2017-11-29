<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Offer;
use App\Models\Admin\Service;
use App\Models\Admin\Consultation;
use App\User;
use Auth;
use Session;

class OfferController extends Controller
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
      $offers = User::find(Auth::user()->id)->offers;
      return view('adviser.offers.index')->withOffers($offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $consultations = Consultation::All();
      $services = User::find(Auth::user()->id)->services;
      return view('adviser.offers.create')->withServices($services)->withConsultations($consultations);
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
      $offer->user_id = Auth::user()->id;
      $offer->save();

      $offer->services()->sync($request->services, false);
      $offer->consultations()->sync($request->consultations, false);

      Session::flash('success','Offer created Successfully!');
      return redirect()->route('offers.index');
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
      $user = $offer->user;
      if($user == Auth::user()){
        return view('adviser.offers.show')->withOffer($offer);
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
      $offer = Offer::find($id);
      $services = User::find(Auth::user()->id)->services;

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

      $user = $offer->user;
      if($user == Auth::user()){
        return view('adviser.offers.edit')->withOffer($offer)->withServices($services2)->withConsultations($consultations2);
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
      return redirect()->route('offers.index');
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
      return redirect()->route('offers.index');
    }
}
