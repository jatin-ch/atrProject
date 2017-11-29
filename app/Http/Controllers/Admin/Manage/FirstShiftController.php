<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Availability;
use App\Models\Admin\Location;
use App\Models\Admin\FirstShift;
use App\User;
use Auth;

class FirstShiftController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function store(Request $request)
    {
      $firstshift = new FirstShift;
      $this->validate($request, ['day' => 'required|string']);
      $firstshift->day = $request->day;
      $firstshift->time_from = $request->time_from;
      $firstshift->time_to = $request->time_to;
      $firstshift->location_id = $request->location;
      $availability = Availability::find($request->availability_id);
      $firstshift->availability_id = $availability->id;
      $firstshift->user_id = $availability->user_id;
      $firstshift->save();
      $user_id = $firstshift->availability->user_id;
      return redirect()->route('availability.show', $user_id);
    }

    public function update(Request $request)
    {
      $firstshift = FirstShift::find($request->firstshift_id);
      $this->validate($request, ['day' => 'required|string']);
      $firstshift->day = $request->day;
      $firstshift->time_from = $request->time_from;
      $firstshift->time_to = $request->time_to;
      $firstshift->location_id = $request->location;
      $firstshift->update();
      $user_id = $firstshift->availability->user_id;
      return redirect()->route('availability.show', $user_id);
    }

    public function destroy($id)
    {
      $firstshift = FirstShift::find($id);
      $user_id = $firstshift->availability->user_id;
      $firstshift->delete();
      return redirect()->route('availability.show', $user_id);
    }
}
