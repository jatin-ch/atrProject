<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();    
      $categories = Category::all();
      return view('admin.posts.index')->withPosts($posts)->withCategories($categories);
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
       return view('admin.posts.create')->withCategories($categories)->withUsers($users);
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

        $post->user_id = $request->user_id;

        if($request->approved == '1'){
          $post->approved = true;
        } else {
          $post->approved = false;
        }

       $post->save();

       Session::flash('success', 'The blog post was successfully save!');
       return redirect()->route('admin.posts.index');
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
      return view('admin.posts.show')->with('post', $post);
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
       $categories = Category::all();
       return view('admin.posts.edit')->with('post', $post)->withCategories($categories);
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

        Session::flash('success', 'The blog post was saved!');
        return redirect()->route('admin.posts.index');
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
        
        foreach($post->likes as $like){
            $like->delete();
        }
        
        foreach($post->comments as $comment){
            
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
        }
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
    
    
    public function search()
    {
      $posts = Post::all();
      $categories = Category::all();
      
      $q = Input::get ('q');
      $user = User::where('name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->first();
    	if($q != ""){
    	$post = Post::where('user_id', $user->id)->get();
    	if (count ( $post ) > 0)
    		return view('admin.posts.index')->withDetails($user)->withQuery($q)->withPosts($post)->withCategories($categories);
    	}
    		return view('admin.posts.index')->withMessage('No Blog Post found. Try to search again !')->withPosts($post)->withCategories($categories);
   }
   
   
   public function sort()
    {
       $categories = Category::all();
       $posts = Post::all();
       
       $category = Input::get ('category');
       $subcategory = Input::get('subcategory');
       
    	if($category != ""){
    	$post = Post::where('category_id',$category)->get();
    	if (count($post) > 0)
    		return view('admin.posts.index')->withPosts($post)->withCategories($categories);
    	}
    	else if($category != "" && $subcategory != ""){
    	$post = Post::where('category_id',$category)->where('sub_category_id',$subcategory)->get();
    	if (count($post) > 0)
    		return view('admin.posts.index')->withPosts($post)->withCategories($categories);
    	}
    		return view('admin.posts.index')->withMessage('No Blog post found. Try to search again !')->withPosts($posts)->withCategories($categories);

    }
}
