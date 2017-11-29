<?php

namespace App\Http\Controllers\Page\AskUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Page\Asks\AnswerComment;
use App\Models\Page\Asks\AnswerReply;
// use App\Models\Page\Asks\ReplyLike;
use App\User;
use Session;

class AnswerReplyController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

     public function store(Request $request)
     {
         $this->validate($request, array(
             'reply' => 'required|min:2|max:1000'
             ));

         $comment = AnswerComment::find($request->comment_id);
         $ask = $comment->answer->ask;

         $reply = new AnswerReply;
         $reply->user_id = Auth::user()->id;
         $reply->answer_comment_id = $comment->id;
         $reply->reply = $request->reply;
         $reply->save();
         Session::flash('success','You replied to a comment!');
        //  return redirect()->route('asks.questions.show',$ask->id);
        return redirect()->back();
     }
}
