<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Page\PostComment;
use App\Models\Page\CommentReply;
use App\Models\Page\ReplyLike;
use App\User;
use Session;

class ReplyController extends Controller
{
   public function __construct()
   {
     $this->middleware('auth');
   }

    public function store(Request $request, $comment_id)
    {
        $this->validate($request, array(
            'reply' => 'required|min:2|max:1000'
            ));

        $comment = PostComment::find($comment_id);

        $reply = new CommentReply;
        $reply->user_id = Auth::user()->id;
        $reply->post_comment_id = $comment->id;
        $reply->reply = $request->reply;
        $reply->save();
        Session::flash('success','You replied to a comment!');
        // return redirect()->route('blog-posts.show',$comment->post->id);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $reply = CommentReply::find($id);
        $this->validate($request, array('reply' => 'required|min:2|max:1000'));
        $reply->reply = $request->reply;
        Session::flash('success','Your reply was updated!');
        $reply->save();

        //return redirect()->route('blog-posts.show', $reply->comment->post->id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $reply = CommentReply::find($id);
        //$post_id =  $reply->comment->post->id;
        $likes = $reply->rlikes;
        foreach($likes as $like){
            $like->delete();
        }
        $reply->delete();

        //return redirect()->route('blog-posts.show', $post_id);
        Session::flash('success','Your reply was deleted!');
        return redirect()->back();
    }



    public function postLikeReply(Request $request)
    {
      $reply_id = $request['replyId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $reply = CommentReply::find($reply_id);
      if(!$reply) {
        return null;
      }
      $user = Auth::user();
      $like = $user->rlikes()->where('comment_reply_id', $reply->id)->first();
      if($like) {
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like) {
          $like->delete();
          //return null;
          return redirect()->back();
        }
      } else {
        $like = new ReplyLike;
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->comment_reply_id = $reply->id;
      if($update) {
        $like->update();
      }  else {
        $like->save();
      }
    //  return null;
      return redirect()->back();
    }
}
