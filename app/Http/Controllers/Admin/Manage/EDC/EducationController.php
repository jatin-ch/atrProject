<?php

namespace App\Http\Controllers\Admin\Manage\EDC;

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
      $education->user_id = $request->user_id;
      $education->save();
      return redirect()->route('expertProfile.show', $request->user_id);
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
      return redirect()->route('expertProfile.show', $education->user_id);
    }

    public function destroy($id)
    {
      $education = Education::find($id);
      $user_id = $education->user_id;
      $education->delete();
      return redirect()->route('expertProfile.show', $user_id);
    }
}
