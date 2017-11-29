<?php

namespace App\Http\Controllers\Admin\Manage\EDC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Membership;
use Auth;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'institution_name' => 'required',
        'institution_location' => 'required'
      ]);

      $membership = new Membership;
      $membership->institution_name = $request->institution_name;
      $membership->institution_location = $request->institution_location;
      $membership->user_id = $request->user_id;
      $membership->save();
      return redirect()->route('expertProfile.show', $request->user_id);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'institution_name' => 'required',
        'institution_location' => 'required'
      ]);

      $membership = Membership::find($id);
      $membership->institution_name = $request->institution_name;
      $membership->institution_location = $request->institution_location;
      $membership->save();
      return redirect()->route('expertProfile.show', $membership->user_id);
    }

    public function destroy($id)
    {
      $membership = Membership::find($id);
      $user_id = $membership->user_id;
      $membership->delete();
      return redirect()->route('expertProfile.show', $user_id);
    }
}