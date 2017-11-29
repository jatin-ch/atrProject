<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Page\PostComment;
use App\Models\Admin\Post;
use App\User;
use Session;
use App\Models\Page\CommentLike;

class CommentController extends Controller
{
    public function __construct()
   {
     $this->middleware('auth');
     //$this->middleware('auth', ['except' => 'store']);
   }

   public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'comment' => 'required|min:10|max:2000'
            ));

        $post = Post::find($post_id);

        $comment = new PostComment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->save();

        Session::flash('success', 'Your comment was added!');
        // return redirect()->route('blog-posts.show',$post_id);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $comment = PostComment::find($id);
        $this->validate($request, array('comment' => 'required|min:10|max:2000'));
        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success','Your comment was updated!');
        // return redirect()->route('blog-posts.show', $comment->post->id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = PostComment::find($id);
        //$post_id = $comment->post->id;
        
        foreach($comment->clikes as $like){
            $like->delete();
        }

        foreach($comment->replies as $reply){
            foreach($reply->rlikes as $like){
                $like->delete();
            }
          $reply->delete();
        }

        $comment->delete();

        Session::flash('success','Your Comment was deleted!');
        // return redirect()->route('blog-posts.show', $post_id);
        return redirect()->back();
    }


    public function postLikeComment(Request $request)
    {
      $comment_id = $request['commentId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $comment = PostComment::find($comment_id);
      if(!$comment) {
        return null;
      }
      $user = Auth::user();
      $like = $user->clikes()->where('post_comment_id', $comment->id)->first();
      if($like) {
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like) {
          $like->delete();
          //return null;
          return redirect()->back();
        }
      } else {
        $like = new CommentLike;
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->post_comment_id = $comment->id;
      if($update) {
        $like->update();
      }  else {
        $like->save();
      }
    //  return null;
      return redirect()->back();
    }
}
