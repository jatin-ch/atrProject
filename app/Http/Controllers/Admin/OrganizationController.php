<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Organization;
use App\User;
use Auth;
use Image;
use Session;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
      $advisers = User::where('level','adviser')->get();
      return view('admin.organization.index')->withAdvisers($advisers);
    }

    public function store(Request $request)
    {
      $this->validate($request, ['name' => 'required', 'logo' => 'required|mimes:jpeg,png']);

      $org = new Organization;
      $org->user_id = Auth::user()->id;
      $org->name = $request->name;
      $logo = $request->file('logo');
      $filename = time() . $logo->getClientOriginalName() . '.' . $logo->getClientOriginalExtension();
      $location = public_path('images/' . $filename);
      Image::make($logo)->resize(100,100)->save($location);
      $org->logo = $filename;
      $org->save();

      return redirect()->route('myOrg.index');
    }

    public function add(Request $request)
    {
      $org = Organization::where('user_id',Auth::user()->id)->first();
      $org->users()->sync($request->users, false);

      Session::flash('info', 'Request sent successfully.');
      return redirect()->route('myOrg.index');
    }
}
