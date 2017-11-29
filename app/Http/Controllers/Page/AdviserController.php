<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\User;
use Illuminate\Support\Facades\Input;

class AdviserController extends Controller
{
    public function index()
    {
      $categories = Category::all();
    //   $users = User::where('level','adviser')->where('approved', '1')->paginate(6);
    //         $advisers = array();
    //   foreach($users as $user)
    //   {
    //       $advisers[] = $user->expertDetail;
    //   }
      $advisers = ExpertDetail::orderBy('id','asec')->paginate('6');
      
      $cats = Input::has('cats') ? Input::get('cats') : [];
      $types = Input::has('types') ? Input::get('types') : [];
      $exps = Input::has('exps') ? Input::get('exps') : [];
      return view('pages.advisers.index')->withCategories($categories)->withAdvisers($advisers)->withCats($cats)->withTypes($types)->withExps($exps);
    }


    public function cat()
    {
      $categories = Category::all();
       $advisers = ExpertDetail::where(function($query){
    		$cats = Input::has('cats') ? Input::get('cats') : null;
        $types = Input::has('types') ? Input::get('types') : null;
        $exps = Input::has('exps') ? Input::get('exps') : null;
    			if(isset($cats)){
    				foreach ($cats as $cat) {
    					$query->orwhere( 'major_cat', 'LIKE', '%' . $cat . '%' );
    				}
    			}
          if(isset($types)) {
            foreach ($types as $type) {
    					$query->orwhere( 'type', $type);
    				}
          }
          if(isset($exps)) {
            foreach ($exps as $exp) {
    					$query->orwhere('experience','>=',$exp);
    				}
          }
      	})->paginate(6);
        $cats = Input::has('cats') ? Input::get('cats') : [];
        $types = Input::has('types') ? Input::get('types') : [];
        $exps = Input::has('exps') ? Input::get('exps') : [];
        if (count($advisers) > 0)
        {
          return view('pages.advisers.index')->withAdvisers($advisers)->withCategories($categories)->withCats($cats)->withTypes($types)->withExps($exps);
        }
        else {
          return view('pages.advisers.index')->withMessage('No Adviser found. Try another one !')->withAdvisers($advisers)->withCategories($categories)->withCats($cats)->withTypes($types)->withExps($exps);
        }

    }



    // public function filter($slug)
    // {
    //     $category = Category::where('slug', '=', $slug)->get()->first();
    //     $q = Input::get ('q');
    //     if($q != ""){
    //     $adviser = ExpertDetail::where('major_cat', '=', $category->name)->where( 'major_subcat', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );//->orWhere( 'other_subcat', 'LIKE', '%' . $q . '%' )
    //     $pagination = $adviser->appends ( array (
    //           'q' => Input::get ( 'q' )
    //       ) );
    //       $count = $adviser->count();
    //     if (count ( $adviser ) > 0)
    //       return view('pages.advisers-category.index')->withDetails($adviser)->withQuery($q)->withAdvisers($adviser)->withCategory($category)->withCount($count);
    //     }
    //       return view('pages.advisers-category.index')->withMessage('No Adviser found. Try another one !')->withAdvisers($adviser)->withCategory($category)->withCount($count);
    // }

}
