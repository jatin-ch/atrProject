<?php

namespace App\Http\Controllers\Admin\EDC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\WorkExperience;
use Auth;

class WorkExpController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'profile' => 'required',
        'office' => 'required',
        'from_year' => 'required',
        'to_year' => 'required'
      ]);

      $workexp = new WorkExperience;
      $workexp->profile = $request->profile;
      $workexp->office = $request->office;
      $workexp->from_year = $request->from_year;
      $workexp->to_year = $request->to_year;
      $workexp->user_id = Auth::user()->id;
      $workexp->save();
      return redirect()->route('expertDetails.index');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'profile' => 'required',
        'office' => 'required',
        'from_year' => 'required',
        'to_year' => 'required'
      ]);

      $workexp = WorkExperience::find($id);
      $workexp->profile = $request->profile;
      $workexp->office = $request->office;
      $workexp->from_year = $request->from_year;
      $workexp->to_year = $request->to_year;
      $workexp->save();
      return redirect()->route('expertDetails.index');
    }

    public function destroy($id)
    {
      $workexp = WorkExperience::find($id);
      $workexp->delete();
      return redirect()->route('expertDetails.index');
    }
}
