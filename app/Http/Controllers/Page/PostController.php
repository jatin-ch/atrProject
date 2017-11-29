<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Admin\Post;
use App\Models\Page\PostLike;
use Session;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    public function index()
    {
      $posts = Post::orderBy('id','desc')->paginate(4);
      $categories = Category::all();
      return view('pages.posts.index')->withPosts($posts)->withCategories($categories);
    }

    public function sort()
    {
       $categories = Category::all();
       $posts = Post::orderBy('id','desc')->paginate(4);
       
       $category = Input::get ('category');
       $subcategory = Input::get('subcategory');
       
    	if($category != ""){
    	$posts = Post::where('category_id',$category)->paginate(4);
    	if (count($posts) > 0)
    		return view('pages.posts.index')->withPosts($posts)->withCategories($categories);
    	}
    	else if($category != "" && $subcategory != ""){
    	$posts = Post::where('category_id',$category)->where('sub_category_id',$subcategory)->paginate(4);
    	if (count($posts) > 0)
    		return view('pages.posts.index')->withPosts($posts)->withCategories($categories);
    	}
    		return view('pages.posts.index')->withMessage('No Results found. Try to search again !')->withPosts($posts)->withCategories($categories);

    }

    public function show($id)
    {
      $post = Post::find($id);
      return view('pages.posts.show')->withPost($post);
    }

    public function postLikePost(Request $request)
    {
      $post_id = $request['postId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $post = Post::find($post_id);
      if(!$post) {
        return null;
      }
      $user = Auth::user();
      $like = $user->likes()->where('post_id', $post_id)->first();
      if($like) {
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like) {
          $like->delete();
          //return null;
          return redirect()->back();
        }
      } else {
        $like = new PostLike;
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->post_id = $post->id;
      if($update) {
        $like->update();
      }  else {
        $like->save();
      }
    //  return null;
    Session::flash('success','You liked this Post');
      return redirect()->back();
    }
}
