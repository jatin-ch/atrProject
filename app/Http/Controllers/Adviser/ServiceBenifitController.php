<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Education;
use App\Models\Admin\WorkExperience;
use App\Models\Admin\Specialization;
use App\Models\Admin\Membership;
use App\Models\Admin\Award;
use App\Models\Admin\Benifit;
use App\Models\Admin\Package;
use Session;

class ServiceBenifitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser|superadministrator|administrator');
    }

    public function storeBenifit(Request $request)
    {
      $this->validate($request, [
        'benifit' => 'required'
      ]);

      $benifit = new Benifit;
      $benifit->benifit = $request->benifit;
      $benifit->service_id = $request->service_id;
      $benifit->save();
      return redirect()->back();
    }

    public function updateBenifit(Request $request, $id)
    {
      $this->validate($request, [
        'benifit' => 'required'
      ]);

      $benifit = Benifit::find($id);
      $benifit->benifit = $request->benifit;
      $benifit->save();
      return redirect()->back();
    }

    public function destroyBenifit($id)
    {
      $benifit = Benifit::find($id);
      $service_id = $benifit->service_id;
      $benifit->delete();
      return redirect()->back();
    }

    public function storePackage(Request $request)
    {
      $this->validate($request, [
        'include' => 'required'
      ]);

      $package = new Package;
      $package->include = $request->include;
      $package->service_id = $request->service_id;
      $package->save();
      return redirect()->back();
    }

    public function updatePackage(Request $request, $id)
    {
      $this->validate($request, [
        'include' => 'required'
      ]);

      $package = Package::find($id);
      $package->include = $request->include;
      $package->save();
      return redirect()->back();
    }

    public function destroyPackage($id)
    {
      $package = Package::find($id);
      $service_id = $package->service_id;
      $package->delete();
      return redirect()->back();
    }

}
