<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\UserRating;
use App\User;
use Auth;
use Session;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $this->validate($request, ['star'=>'required']);
      $adviser_id = $request['adviserId'];
      $star = $request['star'];
      $review = $request['review'];
      $user = Auth::user();
      $rating = $user->ratings()->where('adviser_id', $adviser_id)->first();
      $rating = new UserRating;
      $rating->user_id = $user->id;
      $rating->adviser_id = $adviser_id;
      $rating->rating = $star; //round($total,1,PHP_ROUND_HALF_UP);
      $rating->review = $review;
      $rating->save();
      Session::flash('success', 'Thank You so much. Your review has been added.');
      return redirect()->route('advisers-category.show', $adviser_id);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, ['star'=>'required']);
      $star = $request['star'];
      $review = $request['review'];
      $rating = UserRating::find($id);
      $rating->rating = $star;
      $rating->review = $review;
      $rating->save();
      Session::flash('success', 'Thank You so much. Your review has been saved.');
      return redirect()->route('advisers-category.show', $rating->adviser_id);
    }
}
