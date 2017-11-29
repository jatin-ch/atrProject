@extends('layouts.admin')
@section('title') | Blog-posts | Create @endsection
@section('content')



<section class="content-header">
      <h1>
        Write a Blog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-dashboard"></i> Blogs</a></li>
        <li class="active">Create</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-default">
                      {!! Form::open(['route' => ['admin.posts.store'], 'method' => 'POST', 'files' => 'true']) !!}
                        <div class="box-header with-border heading">
                            <div class="col-md-3">
                            {{ Form::label('user_id', 'Select Adviser') }}
                            <select name="user_id" class="form-control">
                                @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-lg-4">
                               <div class="form-group">
                                {{ Form::label('category_id', 'Choose Category') }}
                                <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                  {{ Form::label('sub_category_id', 'Choose Sub-Category') }}
                                  <select name="sub_category_id" class="form-control">
                                  @foreach($categories as $category)
                                  @foreach($category->subcategories as $subcategory)
                                  <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                  @endforeach
                                  @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
                        <div class="box-body">
                          <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'required'=>'']) }}
                          </div>

                        <textarea name="body" id="editor1" rows="10" cols="80" required> </textarea>

                        <div class="col-lg-12 mt20">
                          {{ Form::label('featured_image', 'Featured Image') }}
                          {{ Form::file('featured_image', ['class' => 'form-control']) }}
                        </div>
                        <div class="col-lg-12 text-center mt20">
                         <input type="radio" name="approved" value="1">Publish
                         <input type="radio" name="approved" value="0" checked>Save
                        <button type="submit" class="btn btn-success">SUBMIT</button>
                        </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    </section>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
   CKEDITOR.replace('editor1');
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

});
</script>
