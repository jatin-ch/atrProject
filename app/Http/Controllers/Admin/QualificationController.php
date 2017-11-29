<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Qualification;
use App\User;
use Auth;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator');
    }

    public function index()
    {
      $categories = Category::all();
      $qualifications = Qualification::orderBy('id', 'desc')->paginate(10);
      return view('admin.qualifications.index')->withQualifications($qualifications)->withCategories($categories);
    }

    public function store(Request $request)
    {
      $this->validate($request, ['name' => 'required|string']);
      $qualification = new Qualification;
      $qualification->category_id = $request->category_id;
      $qualification->name = $request->name;
      $qualification->save();
      return redirect()->route('qualifications.index');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, ['name' => 'required|string']);
      $qualification = Qualification::find($id);
      $qualification->category_id = $request->category_id;
      $qualification->name = $request->name;
      $qualification->save();
      return redirect()->route('qualifications.index');
    }

    public function destroy($id)
    {
      $qualification = Qualification::find($id);
      $qualification->delete();
      return redirect()->route('qualifications.index');
    }
}
