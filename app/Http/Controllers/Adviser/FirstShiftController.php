<?php

namespace App\Http\Controllers\Adviser;

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
        $this->middleware('role:adviser');
    }

    public function store(Request $request)
    {
      $firstshift = new FirstShift;
      $this->validate($request, ['day' => 'required|string']);
      $firstshift->day = $request->day;
      $firstshift->time_from = $request->time_from;
      $firstshift->time_to = $request->time_to;
      if(!empty($request->location)){
        $firstshift->location_id = $request->location;
      }

      $availability = Availability::find($request->availability_id);
      $firstshift->availability_id = $availability->id;
      $firstshift->user_id = Auth::user()->id;
      $firstshift->save();
      return redirect()->back();
    }

    public function update(Request $request, $id)
    {
      $firstshift = FirstShift::find($id);
      $this->validate($request, ['day' => 'required|string']);
      $firstshift->day = $request->day;
      $firstshift->time_from = $request->time_from;
      $firstshift->time_to = $request->time_to;
      $firstshift->location_id = $request->location;
      $firstshift->update();
      $availability = $firstshift->availability;
      return redirect()->back();
    }

    public function destroy($id)
    {
      $firstshift = FirstShift::find($id);
      $availability = $firstshift->availability;
      $firstshift->delete();
      return redirect()->back();
    }
}
