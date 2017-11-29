@extends('layouts.admin')
@section('title') | Categories @endsection
@section('content')
<section class="content-header">
      <h1>
        Categories
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Categories</a></li>
        <li class="active">All</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
         <label> Manage All Categories</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Add New</button>
         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
         <div class="modal-dialog modal-md">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add New Category</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['categories.store'], 'method' => 'POST', 'id' => 'addnew']) !!}
          <div class="form-group">
            <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td style="border:none">
                    {{ Form::label('name', 'Category Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                  </td>
                </tr>
                <tr>
                  <td style="border:none">
                    {{ Form::label('slug', 'Slug') }}
                    {{ Form::text('slug', null, ['class' => 'form-control']) }}
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 text-center">
              <div class="form-group">
                <button class="btn btn-success " onclick="document.getElementById(addnew).submit();">Save</button>
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
                          <th>Name</th>
                          <th>Slug</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                             <button class="btn btn-warning btn-sm" data-target="#sl1{{$category->id}}" data-toggle="modal">Edit</button>
                            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="sl1{{$category->id}}" tabindex="-1">
                            <div class="modal-dialog modal-md">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Category</h4>
                            </div>
                            <div class="modal-body">
                             {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT', 'id' => 'sf1'.$category->id]) !!}
                             <div class="form-group">
                               <table class="table">
                                 <tbody>
                                   <tr>
                                     <td style="border:none">
                                       {{ Form::label('name', 'Category Name') }}
                                       {{ Form::text('name', null, ['class' => 'form-control']) }}
                                     </td>
                                   </tr>
                                   <tr>
                                     <td style="border:none">
                                       {{ Form::label('slug', 'Slug') }}
                                       {{ Form::text('slug', null, ['class' => 'form-control', 'readonly' => '']) }}
                                     </td>
                                   </tr>
                                 </tbody>
                               </table>
                               <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $category->id }}).submit();">Save</button>
                               <br>
                               </div>
                            {!! Form::close() !!}
                            </div>
                            </div>
                            </div>
                            </div>
                            </td>
                            <td>
                               {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE', 'id' => $category->id]) !!}
                               {!! Form::close() !!}
                               <a onclick="
                                  if(confirm('Are you sure, You Want to delete this?'))
                                      {
                                        event.preventDefault();
                                        document.getElementById({{ $category->id }}).submit();
                                      }
                                      else{
                                        event.preventDefault();
                                      }" href="" class="btn btn-danger btn-sm" style='cursor:pointer'>
                                    Delete
                               </a>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    <div class="text-center">
                    {!! $categories->links() !!}
                    <p>{{ $categories->count() }} items</p>
                    </div>
        </div>
    </div>
</div>
</div>
</div>
</section>

@endsection
