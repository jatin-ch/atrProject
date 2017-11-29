@extends('layouts.admin')
@section('title') | Sub-categories @endsection
@section('content')

<section class="content-header">
      <h1>
        Sub Categories
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Sub-Categories</a></li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
         <label> Manage All Sub-categories</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
         <div class="modal-dialog ">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add New Sub-category</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['sub-categories.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
          <div class="row">
          <div class="col-md-12">
             <div class="form-group">
             {{ Form::label('category_id', 'Choose Category') }}
                    <select name="category_id" class="form-control">
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
          </div>
          <div class="form-group">

                    {{ Form::label('name', 'Sub-category Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}

            </div>
            <div class="form-group">
                {{ Form::label('description', 'Sub-category description') }}
                <textarea name="description" id="editor1" rows="5" cols="78"></textarea>
            </div>
        <div class="form-group">
         <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Save</button>
       </div>
          </div>
          </div>
         {!! Form::close() !!}
         </div>
         </div>
         </div>
         </div>
        </div>

        <div class="panel-body">
          <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Sub Category Name</th>
                          <th>Category Associated</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach ($subcategories as $subcategory)
                          <tr>
                            <th>{{ $subcategory->id }}</th>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->category->name }}</td>
                            <td>
                             <button class="btn btn-default btn-sm" data-target="#sl1{{$subcategory->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>
                            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$subcategory->id}}" tabindex="-1">
                            <div class="modal-dialog">
                            <div class="modal-content" style="top:-125px;">
                            <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Sub-category</h4>
                            </div>
                            <div class="modal-body">
                             {!! Form::model($subcategory, ['route' => ['sub-categories.update', $subcategory->id], 'method' => 'PUT', 'id' => 'sf1'.$subcategory->id]) !!}
                                 <div class="form-group">
                                     {{ Form::label('category_id', 'Choose Category') }}
                                     <select name="category_id" class="form-control">
                                     @foreach($categories as $category)
                                     <option value="{{$category->id}}" {{$subcategory->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                     @endforeach
                                     </select>
                                 </div>
                                 <div class="form-group">
                                    {{ Form::label('name', 'Sub-category Name') }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                 </div>
                                 <div class="form-group">
                                    {{ Form::label('description', 'Sub-category description') }}
                                    {{ Form::textarea('description', null, ['id'=>'editor1', 'rows'=>'5', 'cols'=>'78']) }}
                                 </div>
                                 <div class="form-group text-center">
                                     <button class="btn btn-success" onclick="document.getElementById(sf1{{ $subcategory->id }}).submit();">Save</button>
                                 </div>
                            {!! Form::close() !!}
                            </div>
                            </div>
                            </div>
                            </div>
                            </td>
                            <td>
                               {!! Form::open(['route' => ['sub-categories.destroy', $subcategory->id], 'method' => 'DELETE', 'id' => $subcategory->id]) !!}
                               {!! Form::close() !!}
                               <a onclick="
                                  if(confirm('Are you sure, You Want to delete this?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById({{ $subcategory->id }}).submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" href="" class="btn btn-default btn-sm" style='cursor:pointer;color:#dd4b39'>
                                    <i class="fa fa-trash"></i>
                               </a>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="text-center">
                    {!! $subcategories->links() !!}
                    <p>{{ $subcategories->count() }} items</p>
                    </div>
        </div>
    </div>
</div>
</div>
</div>
</section>

<script type='text/javascript'>
$(document).ready(function() {
   CKEDITOR.replace('editor1');
});
</script>

@endsection
