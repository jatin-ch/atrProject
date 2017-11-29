<?php

namespace App\Http\Controllers\Admin\EDC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Education;
use Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'degree' => 'required',
        'college' => 'required',
        'year' => 'required'
      ]);

      $education = new Education;
      $education->degree = $request->degree;
      $education->college = $request->college;
      $education->year = $request->year;
      $education->user_id = Auth::user()->id;
      $education->save();
      return redirect()->route('expertDetails.index');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'degree' => 'required',
        'college' => 'required',
        'year' => 'required'
      ]);

      $education = Education::find($id);
      $education->degree = $request->degree;
      $education->college = $request->college;
      $education->year = $request->year;
      $education->save();
      return redirect()->route('expertDetails.index');
    }

    public function destroy($id)
    {
      $education = Education::find($id);
      $education->delete();
      return redirect()->route('expertDetails.index');
    }
}
