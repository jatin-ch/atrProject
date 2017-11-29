@extends('layouts.admin')
@section('title') | Blog-post | {{$post->title}} @endsection
@section('content')

<section class="content-header">
      <h1>
        Edit a Blog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.posts.index')}}"><i class="fa fa-dashboard"></i> Blogs</a></li>
        <li class="active">Update</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-default">
                        {!! Form::model($post, ['route' => ['admin.posts.update', $post->id], 'method' => 'PUT', 'files' => 'true']) !!}
                        <div class="box-header with-border heading">
                            <div class="col-lg-6">
                               <div class="form-group">
                                {{ Form::label('category_id', 'Choose Category') }}
                                <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{$post->category['name']==$category->name?'selected':''}}>{{ $category->name }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('sub_category_id', 'Choose Sub-Category') }}
                                  <select name="sub_category_id" class="form-control">
                                  @foreach($categories as $category)
                                  @foreach($category->subcategories as $subcategory)
                                  <option value="{{ $subcategory->id }}" {{$post->subcategory['name']==$subcategory->name?'selected':''}}>{{ $subcategory->name }}</option>
                                  @endforeach
                                  @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
                        <div class="box-body">
                            	<div class="form-group">
                                {{ Form::label('title', 'Title') }}
                                {{ Form::text('title', null, ['class' => 'form-control']) }}
                              </div>

                              {{ Form::textarea('body', null, ['id'=>'editor1', 'rows'=>'10', 'cols'=>'80', 'required'=>'']) }}



                            {{ Form::label('featured_image', 'Featured Image', ['style' => 'margin-top:20px']) }}
                            {{ Form::file('featured_image', ['class' => 'form-control']) }}

                            <div class="col-lg-12 text-center mt20">
                              <input type="radio" name="approved" value="1">Publish
                              <input type="radio" name="approved" value="0" checked>Save
                             <button type="submit" class="btn btn-lg btn-success">SUBMIT</button>
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
