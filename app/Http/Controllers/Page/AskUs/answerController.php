<?php

namespace App\Http\Controllers\Page\AskUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Asks\Ask;
use App\Models\Page\Asks\Answer;
use App\Models\Page\Asks\AnswerLike;
use Purifier;
use Auth;
use Session;

class answerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function answer(Request $request)
    {
      $this->validate($request, ['answer' => 'required']);

      $answer = new Answer;
      $answer->ask_id = $request->ask_id;
      $answer->user_id = Auth::user()->id;
      $answer->answer = Purifier::clean($request->answer);
      $answer->save();

      Session::flash('success', 'Your answer has been saved!');
      // return redirect()->route('asks.questions.show', $request->ask_id);
      return redirect()->back();
    }
    
    public function update(Request $request, $id)
    {
        $answer = Answer::find($id);
        $answer->answer = Purifier::clean($request->answer);
        $answer->save();
        Session::flash('success', 'Your answer has been saved!');
        return redirect()->back();
    }

    public function like(Request $request)
    {
      $answer_id = $request['answerId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $answer = Answer::find($answer_id);
      if(!$answer) {
        return null;
      }
      $user = Auth::user();
      $like = $user->alikes()->where('answer_id', $answer_id)->first();
      if($like) {
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like) {
          $like->delete();
          return redirect()->back();
        }
      } else {
        $like = new AnswerLike;
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->answer_id = $answer->id;
      if($update) {
        $like->update();
      }  else {
        $like->save();
      }
    Session::flash('success','You liked this answer');
      return redirect()->back();
    }
}
