<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\User;
use Auth;
use Session;

class CategoryController extends Controller
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
      $categories = Category::orderBy('id', 'desc')->paginate(7);
      return view('admin.categories.index')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, array(
        'name' => 'required|max:60',
        'slug' => 'required|max:60|unique:categories'
      ));

      $category = new Category;
      $category->name = $request->name;
      $category->slug = $request->slug;
      $category->save();
      Session::flash('success','Category Added Successfully!!');
      return redirect()->route('categories.index');
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
      $category = Category::find($id);

      $this->validate($request, array(
        'name' => 'required|max:60'
      ));

      $category->name = $request->name;
      $category->save();

      Session::flash('success','Category was saved!');
      return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);
      $category->delete();

      Session::flash('success','Category was deleted!');
      return redirect()->route('categories.index');
    }
}
