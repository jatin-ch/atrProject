<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use Auth;
use App\User;
use Session;

class GalleryController extends Controller
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
        $galleries = User::find(Auth::user()->id)->galleries;

        $pw = 0;
        if(Auth::user()->basicDetail->image){
          $pw += 20;
        }
        if(Auth::user()->expertDetail){
          $pw += 20;
        }
        if(Auth::user()->verification){
          $pw += 10;
        }
        if(Auth::user()->availabilities->count() > 0){
          $pw += 20;
        }
        if(Auth::user()->locations->count() > 0){
          $pw += 10;
        }
        if(Auth::user()->galleries->count() > 0){
          $pw += 20;
        }

        return view('adviser.galleries.index')->withGalleries($galleries)->withPw($pw);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->image_video)){
          $this->validate($request, ['image_video'  => 'mimes:mp4,jpeg,png']);
        }
        if(isset($request->video_url)){
          $this->validate($request, ['video_url' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/']);
        }
        if(!$request){
          Session::flash('danger','At least one field is required!');
          return redirect()->route('adviser.galleries.index');
        }

       $gallery = new Gallery;
       $gallery->image_video = $request->image_video;
       if($request->hasFile('image_video')){
           $image_video = $request->file('image_video');
           $filename = time() . $image_video->getClientOriginalName() . '.' . $image_video->getClientOriginalExtension();
           $image_video->move(base_path() . '/public/uploads/', $filename);
           $gallery->image_video = $filename;
         }
       $gallery->video_url = $request->video_url;
       $gallery->user_id = Auth::user()->id;
       $gallery->save();
       Session::flash('success','Your files added to gallery!!');
       return redirect()->route('adviser.galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
