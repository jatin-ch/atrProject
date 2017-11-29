<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Consultation;
use App\User;
use Auth;
use Session;

class ConsultationController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $consultations = Consultation::all();
      return view('admin.consultations.index')->withConsultations($consultations);
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
          'mode' => 'required|string',
          'slug' => 'required|unique:consultations'
        ));
        $consultation = new Consultation;
        $consultation->mode = $request->mode;
        $consultation->slug = $request->slug;
        $consultation->save();
        Session::flash('success','Consultation Added Successfully!!');
        return redirect()->route('consultations.index');
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
