@extends('layouts.user')
@section('title') | Blog-posts @endsection
@section('content')

<section class="content-header">
      <h1>
        Posted Blogs
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Blogs</a></li>
        <li class="active">Posted</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-default">
                        <div class="box-header with-border heading">
                            <div class="col-lg-6">
                               <div class="form-group">
                                  <label>Choose Category</label>
                                  <select class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Choose Sub-Category</label>
                                  <select class="form-control">
                                    @foreach($categories as $category)
                                    @foreach($category->subcategories as $subcategory)
                                    <option value="{{$subcategory->name}}">{{ $subcategory->name }}</option>
                                    @endforeach
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
<!-- ng-repeat start here -->

                      @foreach(Auth::user()->posts as $post)
                        <div class="box-body">
                            <div class="box box-default">
                                <div class="box-header with-border heading">
                                    <div class="col-lg-4">
                                        <strong class="pull-left lblstyleblog fntweight" style="width:80px;">Category:</strong>
                                        <label class="pull-left lblstyleblog brright">{{ $post->category->name }}</label>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong class="pull-left lblstyleblog fntweight">Sub Category:</strong>
                                        <label class="pull-left lblstyleblog brright"></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <strong class="pull-left lblstyleblog fntweight">Published On:</strong>
                                        <label class="pull-left lblstyleblog">{{ date('jS M Y', strtotime($post->created_at)) }}</label>
                                    </div>
                                </div>

                                <div class="box-body">
                                    <div class="col-lg-2">
                                        <img class="img-responsive" src="{{asset('posts/'.$post->featured_image)}}" />
                                    </div>
                                    <div class="col-lg-7">
                                        <strong>{{ $post->title }}</strong>
                                        <p class="fnt110">
                                         {!! substr(strip_tags($post->body), 0, 350) !!} {!! strlen(strip_tags($post->body)) > 350 ? "..." : "" !!}
                                        </p>
                                        <div style="width:320px">
                                            <span class="ml40">
                                                <i class="fa fa-heart fa-lg"></i>
                                                <span>{{$post->likes()->count()}}</span>
                                            </span>
                                            <span class="ml40">
                                                <i class="fa fa-comments fa-lg"></i>
                                                <span>{{ $post->comments->count() }}</span>
                                            </span>
                                            <span class="ml40">
                                                <i class="fa fa-eye fa-lg"></i>
                                                <span>1234</span>
                                            </span>

                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                      <a href="{{route('user.posts.show',$post->id)}}" id="myBtn" class="btn btn-default btnblog" >View</a>
                                       <a href="{{route('user.posts.edit',$post->id)}}" class="btn btn-default btnblog">Edit</a>

                                        {{ Form::open(['route' => ['user.posts.destroy', $post->id], 'method' => 'DELETE', 'id' => $post->id]) }}
                                        {{ Form::close() }}
                                        <a onclick="
                                           if(confirm('Are you sure, You Want to delete this?'))
                                               {
                                                 event.preventDefault();
                                                 document.getElementById({{ $post->id }}).submit();
                                               }
                                               else{
                                                 event.preventDefault();
                                               }" class="btn btn-default btnblog" >
                                           Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
    </section>

@endsection
