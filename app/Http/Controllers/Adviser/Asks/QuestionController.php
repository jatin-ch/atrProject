<?php

namespace App\Http\Controllers\Adviser\Asks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Page\Asks\Ask;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:adviser');
    }

    public function questions()
    {
      $true = Auth::user()->basicDetail;
      if($true)
      {
        $asks = Ask::all();
        $categories = Category::all();
        return view('adviser.asks.questions')->withAsks($asks)->withCategories($categories);
      }
      else
      {
        Session::flash('warning', 'please complete your profile!'); 
        return redirect()->back();
      }
    }

    public function show($id)
    {
      $true = Auth::user()->basicDetail;
      if($true)
      {
        $ask = Ask::find($id);
        $answer = $ask->answers->where('user_id',Auth::user()->id)->first();
        return view('adviser.asks.show')->withAsk($ask)->withAnswer($answer);
      }
      else
      {
        Session::flash('warning', 'please complete your profile!'); 
        return redirect()->back();
      }
    }
    
    public function search()
    {
      $asks = Ask::where('only_expert',0)->get();
      $q = Input::get ('q');
    	if($q != ""){
    	$ask = Ask::where('question', 'LIKE', '%' . $q . '%' )->get();
    	if (count ( $ask ) > 0)
    		return view('adviser.asks.questions')->withQuery($q)->withAsks($ask);
    	}
    		return view('adviser.asks.questions')->withMessage('No Results found. Try to search again !')->withAsks($ask);
   }
}
