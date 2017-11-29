<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use App\User;
use Auth;
use Session;
use Purifier;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.sub-categories.index')->withCategories($categories)->withSubcategories($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
         'name' => 'required|max:80',
         'category_id' => 'required|integer'
       ]);

       $subcategory = new SubCategory;
       $subcategory->name = $request->name;
       $subcategory->description = Purifier::clean($request->description);
       $subcategory->category_id = $request->category_id;
       $subcategory->save();

       Session::flash('success','Sub-category added successfully!!');
       return redirect()->route('sub-categories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $subcategory = SubCategory::find($id);

      $this->validate($request, [
        'name' => 'required|max:80',
        'category_id' => 'required|integer'
      ]);

      $subcategory->name = $request->name;
      $subcategory->description = Purifier::clean($request->description);
      $subcategory->category_id = $request->category_id;
      $subcategory->save();

      Session::flash('success','Sub-category was saved!');
      return redirect()->route('sub-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        Session::flash('success','Sub-category was deleted!');
        return redirect()->route('sub-categories.index');
    }
}
