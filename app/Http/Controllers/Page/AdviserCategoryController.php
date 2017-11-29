<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\BasicDetail;
use App\User;
use Illuminate\Support\Facades\Input;

class AdviserCategoryController extends Controller
{
    public function index($slug)
    {
      $category = Category::where('slug', '=', $slug)->get()->first();
      $advisers = ExpertDetail::where('major_cat', '=', $category->name)->paginate('6');
      $brands = Input::has('brands') ? Input::get('brands') : [];
      $types = Input::has('types') ? Input::get('types') : [];
      $qfs = Input::has('qfs') ? Input::get('qfs') : [];
      $exps = Input::has('exps') ? Input::get('exps') : [];
      return view('pages.advisers-category.index')->withCategory($category)->withAdvisers($advisers)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
    }

    public function subcategory($name)
    {
      $subcategory = SubCategory::where('name', '=', $name)->get()->first();
      $advisers = ExpertDetail::where('major_subcat', '=', $subcategory->name)->get();
      return view('pages.advisers-category.subcat')->withSubcategory($subcategory)->withAdvisers($advisers);
    }


    public function filter($slug)
    {
        $category = Category::where('slug', '=', $slug)->get()->first();
        $advisers = ExpertDetail::where(function($query){
        $brands = Input::has('brands') ? Input::get('brands') : null;
        $types = Input::has('types') ? Input::get('types') : null;
        $qfs = Input::has('qfs') ? Input::get('qfs') : null;
        $exps = Input::has('exps') ? Input::get('exps') : [];
    			if(isset($brands)){
    				foreach ($brands as $brand) {
    					$query->orwhere( 'major_subcat', 'LIKE', '%' . $brand . '%' );
    				}
    			}
          if(isset($types)) {
            foreach ($types as $type) {
    					$query->orwhere( 'type', $type);
    				}
          }
          if(isset($qfs)) {
            foreach ($qfs as $qf) {
    					$query->orwhere('qualification', $qf);
    				}
          }
          if(isset($exps)) {
            foreach ($exps as $exp) {
    					$query->orwhere('experience','>=',$exp);
    				}
          }
      	})->where('major_cat', '=', $category->name)->paginate(6);
        $brands = Input::has('brands') ? Input::get('brands') : [];
        $types = Input::has('types') ? Input::get('types') : [];
        $qfs = Input::has('qfs') ? Input::get('qfs') : [];
        $exps = Input::has('exps') ? Input::get('exps') : [];
        if (count($advisers) > 0)
        {
          return view('pages.advisers-category.index')->withAdvisers($advisers)->withCategory($category)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
        }
        else {
          return view('pages.advisers-category.index')->withMessage('No Adviser found. Try another one !')->withAdvisers($advisers)->withCategory($category)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
        }

    }
    
    
     public function search()
    {
      $slug = Input::get('slug');    
      $category = Category::where('slug', '=', $slug)->get()->first();
      $advisers = ExpertDetail::where('major_cat', '=', $category->name)->paginate('6');
      $brands = Input::has('brands') ? Input::get('brands') : [];
      $types = Input::has('types') ? Input::get('types') : [];
      $qfs = Input::has('qfs') ? Input::get('qfs') : [];
      $exps = Input::has('exps') ? Input::get('exps') : [];
      
      $name = Input::get('name');
      if($name != ""){
        $user = BasicDetail::where('firstname', 'LIKE', '%' . $name . '%' )->orWhere ( 'lastname', 'LIKE', '%' . $name . '%' )->first(); 
    	$adviser = ExpertDetail::where('user_id', '=', $user->id)->paginate('6');
    	$pagination = $adviser->appends ( array (
    				'name' => Input::get ( 'name' )
    		) );
    	if (count ( $adviser ) > 0)
    		return view('pages.advisers-category.index')->withCategory($category)->withAdvisers($adviser)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
    	}
    		return view('pages.advisers-category.index')->withMessage('No Details found. Try to search again !')->withCategory($category)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
      
      //return view('pages.advisers-category.index')->withCategory($category)->withAdvisers($advisers)->withBrands($brands)->withTypes($types)->withQfs($qfs)->withExps($exps);
    }


}
