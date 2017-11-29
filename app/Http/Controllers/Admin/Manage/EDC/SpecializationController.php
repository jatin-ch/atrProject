<?php

namespace App\Http\Controllers\Admin\Manage\EDC;

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
      $specialization->user_id =$request->user_id;
      $specialization->save();
      return redirect()->route('expertProfile.show', $request->user_id);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, ['name' => 'required']);

      $specialization = Specialization::find($id);
      $specialization->name = $request->name;
      $specialization->save();
      return redirect()->route('expertProfile.show', $specialization->user_id);
    }

    public function destroy($id)
    {
      $specialization = Specialization::find($id);
      $user_id = $specialization->user_id;
      $specialization->delete();
      return redirect()->route('expertProfile.show', $user_id);
    }
}
