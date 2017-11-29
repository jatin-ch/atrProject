<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Admin\Offer;
use App\Models\Admin\Service;
use App\Models\Admin\Consultation;

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
        $offer->user_id = $request->user_id;

        $offer->save();

        $offer->services()->sync($request->services, false);
        $offer->consultations()->sync($request->consultations, false);

        return redirect()->route('offer.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainuser = User::find(Auth::user()->id);
        $user = User::find($id);
        $consultations = Consultation::all();
        $services = Service::all();

        if($mainuser->level == 'superadministrator'){
           return view("admin.manage.offer.show")->withUser($user)->withConsultations($consultations)->withServices($services);
        } elseif ($mainuser->level == 'administrator') {
          if($user->level == 'superadviser' || $user->level == 'adviser'){
            return view("admin.manage.offer.show")->withUser($user)->withConsultations($consultations)->withServices($services);
          } else {
            return redirect()->route('admin.dashboard');
          }

        } elseif ($mainuser->level == 'superadviser') {
          if($user->level == 'adviser'){
            return view("admin.manage.offer.show")->withUser($user)->withConsultations($consultations)->withServices($services);
          } else {
            return redirect()->route('admin.dashboard');
          }

        } else {
          return redirect()->route('admin.dashboard');
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
        $this->validate($request, array(
          'title' => 'required|max:60',
          'offer_for' => 'required',
          'discount_type' => 'required',
          'more' => 'required|max:190'
        ));

        $offer = Offer::find($id);
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

        return redirect()->route('offer.show', $offer->user_id);
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
        $user_id = $offer->user_id;
        $offer->services()->detach();
        $offer->consultations()->detach();
        $offer->delete();

        return redirect()->route('offer.show', $user_id);
    }
}
