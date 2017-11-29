<?php

namespace App\Http\Controllers\Admin\Asks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Asks\Answer;
use App\Models\Page\Asks\AnswerLike;
use App\Models\Page\Asks\AnswerComment;
use App\Models\Page\Asks\AnswerReply;
use App\Models\Page\Asks\Ask;
use Auth;
use Session;

class DeleteController extends Controller
{
    public function __construct()
    {
      $this->middleware('role:superadministrator|administrator|superadviser');
    }
    
    public function reply($id)
    {
       $reply =  AnswerReply::find($id);
       $reply->delete();
       Session::flash('success','reply deleted!');
       return redirect()->back();
    }
    
    public function comment($id)
    {
       $comment =  AnswerComment::find($id);
       foreach($comment->replies as $reply)
       {
           $reply->delete();
       }
       $comment->delete();
       Session::flash('success','comment deleted!');
       return redirect()->back();
    }
    
    public function answer($id)
    {  
       $answer = Answer::find($id);
       foreach($answer->likes as $like){
         $like->delete();
       }
       
       foreach($answer->comments as $comment) {
        foreach($comment->replies as $reply){
            $reply->delete();
           }
         $comment->delete();
       }
       $answer->delete();
       
       Session::flash('success','answer deleted!');
       return redirect()->back();
    }

}
