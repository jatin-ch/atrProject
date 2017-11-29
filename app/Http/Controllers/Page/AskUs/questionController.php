<?php

namespace App\Http\Controllers\Page\AskUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Page\Asks\Ask;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;

class questionController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $true = Auth::user()->basicDetail;
      if($true)
      {
        $categories = Category::all();
        return view('pages.asks.index')->withCategories($categories);
      }
      else
      {
          Session::flash('warning','please complete you basic profile!');
          return redirect()->back();
      }
      
    }

    public function store(request $request)
    {
      $this->validate($request, ['question' => 'required|string|min:5|max:200']);

      $ask = new Ask;
      $ask->user_id = Auth::user()->id;

      $ask->category_id = $request->category;
      $ask->sub_category_id = $request->sub_category;
      $ask->question = $request->question;
      if($request->detail){
        $ask->detail = $request->detail;
      }

      $ask->only_expert = $request->only_expert;
      $ask->show_name = $request->show_name;
      $ask->save();
      //return redirect()->route('asks.index');
      return redirect()->back();
    }

    public function questions()
    {
      $true = Auth::user()->basicDetail;
      if($true)
      {
        $asks = Ask::all();
        $categories = Category::all();
        return view('pages.asks.questions')->withAsks($asks)->withCategories($categories);
      }
      else
      {
          Session::flash('warning','please complete you basic profile!');
          return redirect()->back();
      }
    }

    public function show($id)
    {
      $true = Auth::user()->basicDetail;
      if($true)
      {
        $ask = Ask::find($id);
        return view('pages.asks.show')->withAsk($ask);
      }
      else
      {
          Session::flash('warning','please complete you basic profile!');
          return redirect()->back();
      }
    }
    

    public function search()
    {
        $output = "";
        $query = Input::get('query');
        $questions = Ask::where('question','LIKE', '%'.$query.'%')->get();
        
        foreach($questions as $question){
          $output .= "<p style='padding:10px;font-size:18px;color:#999;'> <i class='fa fa-question-circle'></i> ";    
          $output .= "<a href='http://testserver.adviceli.com/public/ask-us/questions/".$question->id."'>".$question->question."</a>";
          $output .= "</p>";
        }
        return Response($output);
    }

}
