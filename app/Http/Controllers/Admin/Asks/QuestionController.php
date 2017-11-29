<?php

namespace App\Http\Controllers\Admin\Asks;

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
      $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function questions()
    {
      $asks = Ask::all();
      return view('admin.asks.questions')->withAsks($asks);
    }

    public function show($id)
    {
      $ask = Ask::find($id);
      $answer = $ask->answers->where('user_id',Auth::user()->id)->first();
      return view('admin.asks.show')->withAsk($ask)->withAnswer($answer);
    }
    
    public function search()
    {
      $asks = Ask::all();
      $q = Input::get ('q');
    	if($q != ""){
    	$ask = Ask::where('question', 'LIKE', '%' . $q . '%' )->get();
    	if (count ( $ask ) > 0)
    		return view('admin.asks.questions')->withQuery($q)->withAsks($ask);
    	}
    		return view('admin.asks.questions')->withMessage('No Results found. Try to search again !')->withAsks($ask);
   }
}
