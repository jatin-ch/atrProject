<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\Commission;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;

class CommissionController extends Controller
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
      $categories = Category::all();
      $commissions = Commission::orderBy('id', 'desc')->paginate(7);
      return view('admin.commissions.index')->withCategories($categories)->withCommissions($commissions);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $categories = Category::all();
        $advisers = User::where('level','adviser')->get();
        return view('admin.commissions.create')->withCategories($categories)->withAdvisers($advisers);
    }
    
    public function sort()
    {
      $categories = Category::all();
      $advisers = User::where('level','adviser')->get();
        
      $catId = Input::get ('catId');
      $subcatId = Input::get('subcatId');
      $cat = Category::find($catId)->name;
      $subcat = SubCategory::find($subcatId)->name;
    	if($cat != ""){
    	$experts = ExpertDetail::where('major_cat', '=', $cat)->get();
    	if($subcat != ""){
    	    $experts = ExpertDetail::where('major_cat','=',$cat)->where('major_subcat','=',$subcat)->get();
    	}
    	
    	$advisers = [];
    	foreach($experts as $expert){
    	    $advisers[] = User::find($expert->user_id);
    	}
    	
    	if (count ( $advisers ) > 0)
    		return view('admin.commissions.create')->withCategories($categories)->withAdvisers($advisers)->withCatid($catId);
    	}
    		return view('admin.commissions.create')->withCategories($categories)->withAdvisers($advisers)->withMessage('No adviser found!');
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
        'price' => 'required',
      ));
      
      if(count($request->adviser) > 0){
            foreach($request->adviser as $key => $v){
              if(!empty($request->adviser [$key])){
                $commission = new Commission;
                $commission->price = $request->price;
                $commission->user_id = $request->adviser [$key];
                $commission->save();
              }
            }
          }

      Session::flash('success','Commission Added Successfully!!');
      return redirect()->route('commissions.index');
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
      $commission = Commission::find($id);

      $this->validate($request, array(
        'price' => 'required'
      ));

      $commission->price = $request->price;
      $commission->save();

      Session::flash('success','Commission was saved!');
      return redirect()->route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $commission = Commission::find($id);
      $commission->delete();

      Session::flash('success','Commission was deleted!');
      return redirect()->route('commissions.index');
    }
}