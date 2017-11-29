<?php

namespace App\Http\Controllers\Admin\EDC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Award;
use Auth;

class AwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'award_name' => 'required',
        'award_by' => 'required',
        'award_year' => 'required'
      ]);

      $award = new Award;
      $award->award_name = $request->award_name;
      $award->award_by = $request->award_by;
      $award->award_year = $request->award_year;
      $award->user_id = Auth::user()->id;
      $award->save();
      return redirect()->route('expertDetails.index');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'award_name' => 'required',
        'award_by' => 'required',
        'award_year' => 'required'
      ]);

      $award = Award::find($id);
      $award->award_name = $request->award_name;
      $award->award_by = $request->award_by;
      $award->award_year = $request->award_year;
      $award->save();
      return redirect()->route('expertDetails.index');
    }

    public function destroy($id)
    {
      $award = Award::find($id);
      $award->delete();
      return redirect()->route('expertDetails.index');
    }
}
