@extends('layouts.adviser')
@section('title') | Expert-details @endsection
@section('content')


<style type="text/css">
  .panel-info {
    border-color: #00a65a!important;
}

.panel-info>.panel-heading {
    color: #ffffff;
    background-color: #00a65a;
    border-color: #00a65a;
}
</style>
<section class="content-header">
      <h1>
        Profile {{$pw}}% complete
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Expert Details</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-info">
          <div class="panel-heading">
          {{Auth::user()->basicDetail->firstname}} {{Auth::user()->basicDetail->lastname}}

            <a href="" style="margin-top: -5px;" data-toggle="modal" data-target="#addpop1" type="button" class="btn btn-sm btn-warning pull-right"><i class="glyphicon glyphicon-edit"></i></a>

                 <!-- Edit Modal -->

      <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Your Expert Profile</h4>
                </div>

                <div class="modal-body">
                   {!! Form::model($expertdetail, ['route' => ['adviser.expertDetails.update', $expertdetail->id], 'method' => 'PUT']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('type', 'Type of expert') }}
                      <select name="type" class="form-control">
                        <option value="individual" {{$expertdetail->type=='individual' ? 'selected' : ''}}>Individual</option>
                        <option value="professional" {{$expertdetail->type=='professional' ? 'selected' : ''}}>Professional</option>
                      </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('experience', 'Total Experience') }}
                      {{ Form::number('experience', null, ['class' => 'form-control', 'min'=>'0','max'=>'70']) }}
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('mjaor_cat', 'Major: Category') }}
                                  <select name="major_cat" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->name }}" {{$expertdetail->major_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('major_subcat', 'Major: Sub-category') }}
                                <select name="major_subcat" class="form-control">
                                  @foreach($sub_categories as $subcategory)
                                  <option value="{{ $subcategory->name }}" {{$expertdetail->major_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                                  @endforeach
                                </select>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                 {{ Form::label('other_cat', 'Other: Category') }}
                      <select name="other_cat" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->name }}" {{$expertdetail->other_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                   {{ Form::label('other_subcat', 'Other: Sub-categroy') }}
                      <select name="other_subcat" class="form-control">
                        @foreach($sub_categories as $subcategory)
                        <option value="{{ $subcategory->name }}" {{$expertdetail->other_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                        @endforeach
                      </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                   {{ Form::label('cp', 'Current Profile') }}
                      {{ Form::text('cp', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                               <div class="col-lg-6">
                                <div class="form-group">
                                  <label>Website</label>
                                      {{ Form::label('coc', 'Current Organization/Company') }}
                      {{ Form::text('coc', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                  {{ Form::label('qualification', 'Qualifications') }}
              <select class="form-control" name="qualification">
                <option value="">--Select--</option>
                @foreach($qualifications as $qualification)
                <option value="{{$qualification->name}}" {{$expertdetail->qualification == $qualification->name ? 'selected' : ''}}>{{$qualification->name}}</option>
                @endforeach
              </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                   {{ Form::label('also_for', 'I can also help for', ['style' => 'margin-top:20px']) }}
              {{ Form::textarea('also_for', null, ['class' => 'form-control', 'rows' => '3']) }}
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="form-group">
                                  {{ Form::label('about', 'About Me', ['style' => 'margin-top:20px']) }}
              {{ Form::textarea('about', null, ['class' => 'form-control', 'rows' => '3']) }}
                                </div>
                            </div>
                            <!--  <div class="col-lg-6">
                                <div class="form-group">
                                  @foreach($qualifications as $qualification)
              <input type="checkbox" name="qualifications[]" value="{{$qualification->id}}"> {{$qualification->name}}
              @endforeach
                                </div>
                            </div> -->
                              <div class="col-lg-12">
                                <div class="text-center">
                                   {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

               <!-- Edit Modal -->


          </div>
          <div class="panel-body">
            <div class="row">

              <div class="col-md-3">
                 <div class="form-group">
                  <span>Expertise Type:</span>
                   <p><strong>{{ $expertdetail->type }}</strong></p>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                  <span>Years of Experience:</span>
                 <p><strong>{{ $expertdetail->experience }} yrs</strong></p>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                  <span>Major Category:</span>
                   <p><strong>{{ $expertdetail->major_subcat }}</strong></p>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                  <span>Major Expertise:</span>
                 <p><strong>{{ $expertdetail->major_cat }}</strong></p>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="form-group">
                  <span>Category:</span>
                 <p><strong>{{ $expertdetail->other_cat }}</strong></p>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <span>Expertise:</span>
                  <p><strong>{{ $expertdetail->other_subcat }}</strong></p>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <span>Qualification:</span>
                  <p><strong>{{ $expertdetail->qualification }}</strong></p>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <span>Can also help for:</span>
                  <p><strong>{{ $expertdetail->about }}</strong></p>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
