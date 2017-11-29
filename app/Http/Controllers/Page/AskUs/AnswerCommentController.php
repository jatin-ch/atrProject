<?php

namespace App\Http\Controllers\Page\AskUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Page\Asks\AnswerComment;
use App\Models\Page\Asks\Answer;
use App\User;
use Session;
// use App\Models\Page\CommentLike;

class AnswerCommentController extends Controller
{
    public function __construct()
   {
     $this->middleware('auth');
   }

   public function store(Request $request)
    {
        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000'
            ));

        $id =$request->answer_id;
        $answer = Answer::find($id);
        $ask_id = $answer->ask_id;

        $comment = new AnswerComment;
        $comment->user_id = Auth::user()->id;
        $comment->answer_id = $id;
        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Your comment was added!');
        // return redirect()->route('asks.questions.show',$ask_id);
        return redirect()->back();
    }
}
