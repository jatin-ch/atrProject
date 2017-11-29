<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin\Consultation;
use App\Models\Admin\Post;
use App\Models\Page\Booking;
use App\Models\Page\UserRating;
use App\Models\Page\AuthorLike;
use App\Models\Page\AuthorFollow;
use Auth;
use Session;

class AuthorController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function show($id)
    {
      $author = User::find($id);
      $type = $author->expertDetail->type;
      $availabilities =   User::find($id)->availabilities;
      $pc = User::find($id)->availabilities->where('consultation_mode','phone_call')->first();
      $vc = User::find($id)->availabilities->where('consultation_mode','video_call')->first();
      $pm = User::find($id)->availabilities->where('consultation_mode','personal_meeting')->first();
      $chat = User::find($id)->availabilities->where('consultation_mode','chat')->first();
      $consultations = Consultation::all();
      $blogs = Post::all();
      
      $rcount = Booking::where('user_id','=',$id)->where('client_id','=',Auth::user()->id)->count();
      $ratings = UserRating::where('adviser_id','=',$id)->get();
      
      
      if($author->approved == true){
        if($type == "professional"){
            return view('pages.authors.professional')->withAuthor($author)->withConsultations($consultations)->withPc($pc)->withVc($vc)->withPm($pm)->withChat($chat)->withBlogs($blogs)->withRcount($rcount)->withRatings($ratings);
        } else {
            return view('pages.authors.individual')->withAuthor($author)->withConsultations($consultations)->withPc($pc)->withVc($vc)->withPm($pm)->withChat($chat)->withBlogs($blogs)->withRcount($rcount)->withRatings($ratings);
        }
      }
      return redirect()->back();
      
    }
    
    
    public function authorLike(Request $request)
    {
      $author_id = $request['authorId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $author = User::find($author_id);
      if(!$author) {
        return null;
      }
      $user = Auth::user();
      $like = $user->authorLikes()->where('author_id', $author_id)->first();
      if($like) {
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like) {
          $like->delete();
          Session::flash('success','You unliked a adviser');
          return redirect()->back();
        }
      } else {
        $like = new AuthorLike;
      }
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->author_id = $author->id;
      if($update) {
        $like->update();
      }  else {
        $like->save();
      }
    //  return null;
     Session::flash('success','You liked a adviser');
      return redirect()->back();
    }
    
    
    public function authorFollow(Request $request)
    {
      $author_id = $request['authorId'];
      $is_follow = $request['isFollow'] === 'true';
      $update = false;
      $author = User::find($author_id);
      if(!$author) {
        return null;
      }
      $user = Auth::user();
      $follow = $user->authorFollows()->where('author_id', $author_id)->first();
      if($follow) {
        $already_follow = $follow->follow;
        $update = true;
        if($already_follow == $is_follow) {
          $follow->delete();
          Session::flash('success','Un-followed');
          return redirect()->back();
        }
      } else {
        $follow = new AuthorFollow;
      }
      $follow->follow = $is_follow;
      $follow->user_id = $user->id;
      $follow->author_id = $author->id;
      if($update) {
        $follow->update();
      }  else {
        $follow->save();
      }
     Session::flash('success','followed');
      return redirect()->back();
    }
}
