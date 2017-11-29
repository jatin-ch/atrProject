<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Tag;
use App\User;
use Auth;
use Session;
use Purifier;
use Image;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:adviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();
      return view('adviser.posts.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::all();
       $users = User::where('level', 'adviser')->get();
       return view('adviser.posts.create')->withCategories($categories)->withUsers($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, array(
           'category_id' => 'required|integer',
           'sub_category_id' => 'required|integer',
           'title' => 'required|max:250',
           'body' => 'required',
          // 'featured_image' => 'required|mimes:jpeg,png'
           ));

       $post = new Post;
       $post->category_id= $request->category_id;
       $post->sub_category_id= $request->sub_category_id;
       $post->title = $request->title;
       $post->body = Purifier::clean($request->body);

       if($request->hasFile('featured_image')){

           $featured_image = $request->file('featured_image');
           $filename = time() . '.' . $featured_image->getClientOriginalExtension();
           $location = public_path('posts/' . $filename);
           Image::make($featured_image)->resize(800,400)->save($location);

           $post->featured_image = $filename;
        }

        if(isset($request->user_id) && !empty($request->user_id)){
          $post->user_id = $request->user_id;
        } else {
          $post->user_id = Auth::user()->id;
        }

        if($request->approved == '1'){
          $post->approved = true;
        } else {
          $post->approved = false;
        }

       $post->save();

       foreach($request->tags as $key => $v)
        {
         $tag = new Tag;
         $tag->name = $request->tags [$key];
         $tag->post_id = $post->id;
         $tag->save();
        }

      // $post->tags()->sync($request->tags, false);

       Session::flash('success', 'The blog post was successfully save!');
       return redirect()->route('adviser.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      $user = $post->user;
      $mainuser = Auth::user();

      if($mainuser == $user) {
        return view('adviser.posts.show')->with('post', $post);
      } else {
       Session::flash('warning', 'You are not allowed for this!');
       return redirect()->back();
     }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post = Post::find($id);
       $mainuser = Auth::user();
       $user = $post->user;
       $categories = Category::all();

       if($mainuser == $user) {
         return view('adviser.posts.edit')->with('post', $post)->withCategories($categories);
       } else {
        Session::flash('warning', 'You are not allowed for this!');
        return redirect()->back();
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $post = Post::find($id);

       if(isset($request->featured_image))
       {
         $this->validate($request, array(
           'category_id' => 'required|integer',
           'sub_category_id' => 'required|integer',
           'title' => 'required|max:250',
           'body' => 'required',
           'featured_image' => 'required|mimes:jpeg,png'
           ));
       }
       else
       {
         $this->validate($request, array(
           'category_id' => 'required|integer',
           'sub_category_id' => 'required|integer',
           'title' => 'required|max:250',
           'body' => 'required'
           ));
       }

        $post->category_id= $request->category_id;
        $post->sub_category_id= $request->sub_category_id;
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);

        if($request->hasFile('featured_image')){

            $featured_image = $request->file('featured_image');
            $filename = time() . '.' . $featured_image->getClientOriginalExtension();
            $location = public_path('posts/' . $filename);
            Image::make($featured_image)->resize(800,400)->save($location);

            $post->featured_image = $filename;
         }

         if($request->approved == '1'){
           $post->approved = true;
         } else {
           $post->approved = false;
         }

        $post->save();

        if(isset($request->tags))
        {
           foreach($request->tags as $key => $v){
             $tag = Tag::where('name',$request->tags [$key])->where('post_id',$id)->first();
             if($tag){
               $tag->name = $request->tags [$key];
               $tag->save();
             } else {
                $tag = new Tag;
                $tag->name =  $request->tags [$key];
                $tag->post_id = $id;
                $tag->save();
             }

           }
        }

        Session::flash('success', 'The blog post was saved!');
        return redirect()->route('adviser.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      foreach($post->tags as $tag){
        $tag->delete();
      }
      $post->delete();

      Session::flash('success', 'The blog post was deleted!');
      return redirect()->route('adviser.posts.index');
    }
}
