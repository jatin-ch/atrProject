<?php

namespace App\Http\Controllers\Admin\EDC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Specialization;
use Auth;

class SpecializationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required'
      ]);

      $specialization = new Specialization;
      $specialization->name = $request->name;
      $specialization->user_id = Auth::user()->id;
      $specialization->save();
      return redirect()->route('expertDetails.index');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, ['name' => 'required']);

      $specialization = Specialization::find($id);
      $specialization->name = $request->name;
      $specialization->save();
      return redirect()->route('expertDetails.index');
    }

    public function destroy($id)
    {
      $specialization = Specialization::find($id);
      $specialization->delete();
      return redirect()->route('expertDetails.index');
    }
}
