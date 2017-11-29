@extends('layouts.admin')
@section('content')
<section class="content-header">
      <h1>
         Expert Profile({{$user->name}})
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Expert Profile</a></li>
        <li class="active">Adviser</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
         <label> Expert Profile :-</label> <strong>{{$user->name}}</strong>
          <button class="btn btn-warning btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>


     <div class="modal fade" id="addpop1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Expert Profile</h4>Update Your Expert Profile
                </div>

                <div class="modal-body">
                 {!! Form::model($expertdetail, ['route' => ['expertProfile.update', $expertdetail->id], 'method' => 'PUT', 'id' => 'addnew']) !!}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                 {{ Form::label('type', 'Type of expert') }}
                    <select name="type" class="form-control">
                      <option value="individual" {{$expertdetail->type=='individual' ? 'selected' : ''}}>Individual</option>
                      <option value="professional" {{$expertdetail->type=='professional' ? 'selected' : ''}}>Professional</option>
                    </select>
                              </div>
                            </div>

                             <div class="col-md-6">
                              <div class="form-group">
                                 {{ Form::label('experience', 'Total Experience') }}
                               {{ Form::text('experience', null, ['class' => 'form-control']) }}
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                {{ Form::label('mjaor_cat', 'Major: Category') }}
                    <select name="major_cat" class="form-control">
                      @foreach($categories as $category)
                      <option value="{{ $category->name }}" {{$expertdetail->major_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                 {{ Form::label('major_subcat', 'Major: Sub-category') }}
                    <select name="major_subcat" class="form-control">
                      @foreach($subcategories as $subcategory)
                      <option value="{{ $subcategory->name }}" {{$expertdetail->major_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                      @endforeach
                    </select>
                              </div>
                            </div>

                             <div class="col-md-6">
                              <div class="form-group">
                                  {{ Form::label('other_cat', 'Other: Category') }}
                    <select name="other_cat" class="form-control">
                      @foreach($categories as $category)
                      <option value="{{ $category->name }}" {{$expertdetail->other_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                   {{ Form::label('other_subcat', 'Other: Sub-categroy') }}
                    <select name="other_subcat" class="form-control">
                      @foreach($subcategories as $subcategory)
                      <option value="{{ $subcategory->name }}" {{$expertdetail->other_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                      @endforeach
                    </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                   {{ Form::label('cp', 'Current Profile') }}
                    {{ Form::text('cp', null, ['class' => 'form-control']) }}
                              </div>
                            </div>

                             <div class="col-md-6">
                              <div class="form-group">
                                    {{ Form::label('coc', 'Current Organization/Company') }}
                    {{ Form::text('coc', null, ['class' => 'form-control']) }}
                              </div>
                            </div>
                             <div class="col-md-12">
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

                            <div class="col-md-12">
                              <div class="form-group">
                                   @foreach($qualifications as $qualification)
            <input type="checkbox" name="qualifications[]" value="{{$qualification->id}}"> {{$qualification->name}}
            @endforeach
                              </div>
                              
                            </div>

                            <div class="col-md-12">
                              <div class="form-group">
                                    {{ Form::label('also_for', 'I can also help for', ['style' => '']) }}
            {{ Form::textarea('also_for', null, ['class' => 'form-control', 'rows' => '3']) }}
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group">
                                     {{ Form::label('about', 'About Me', ['style' => '']) }}
            {{ Form::textarea('about', null, ['class' => 'form-control', 'rows' => '3']) }}
                              </div>
                            </div>
                            <div class="col-md-12">
                               <div class="form-group">
          <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Update</button>
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
                  <p> <strong>{{ $expertdetail->also_for }}</strong></p>
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                  <span>About Me:</span>
                  <p><strong>{{ $expertdetail->about }}</strong></p>
                </div>
              </div>
            </div>
            </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
          <label>EDUCATIONS</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#pfe" data-toggle="modal">Add New</button>


         <div class="modal fade" id="pfe" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Education</h4>Add New Education
                </div>
         <div class="modal-body">
           {!! Form::open(['route' => ['manage.education.store'], 'method' => 'POST', 'id' => 'pfef']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('degree', 'Degree') }}
            {{ Form::text('degree', null, ['class' => 'form-control']) }}
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
             {{ Form::label('college', 'College Name', ['style' => '']) }}
            {{ Form::text('college', null, ['class' => 'form-control']) }}
            </div>
          </div>
           <div class="col-md-12">
          <div class="form-group">
            {{ Form::label('year', 'Year', ['style' => '']) }}
            {{ Form::text('year', null, ['class' => 'form-control']) }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <button class="btn btn-success pull-right" onclick="document.getElementById(pfef).submit();">Save</button>
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
          
              @foreach($user->educations as $education)
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Education Degree</label>
                    <p>{{$education->degree}}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Education College</label>
                    <p>{{$education->college}}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Education Year</label>
                    <p>{{$education->year}}</p>
                  </div>
                </div>
                 <div class="col-md-1">
                  <div class="form-group">
                    <button class="btn btn-warning btn-sm" data-target="#pfe{{$education->id}}" data-toggle="modal">Edit</button>

                    <div class="modal fade" id="pfe{{$education->id}}" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Education</h4>Edit Education Details
                </div>
                <div class="modal-body">
                 {!! Form::model($education, ['route' => ['manage.education.update', $education->id], 'method' => 'PUT', 'id' => 'sf1'.$education->id]) !!}
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       {{ Form::label('degree', 'Degree') }}
                   {{ Form::text('degree', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                   <div class="col-md-12">
                     <div class="form-group">
                      {{ Form::label('college', 'College Name', ['style' => '']) }}
                   {{ Form::text('college', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                   <div class="col-md-12">
                     <div class="form-group">
                      {{ Form::label('year', 'Year', ['style' => '']) }}
                   {{ Form::text('year', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                
                 <div class="col-md-3">
                   <div class="form-group">
                   <button class="btn btn-success pull-right" onclick="document.getElementById(sf1{{ $education->id }}).submit();">Save</button>
                   </div>
                   
                 </div>
                  </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    {!! Form::open(['route' => ['manage.education.destroy', $education->id], 'method' => 'DELETE', 'id' => 'dl'.$education->id]) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                   {!! Form::close() !!}
                  </div>
                </div>
                   </div>
              @endforeach
            
        </div>
    </div>

<div class="panel panel-default">
        <div class="panel-heading">
          <label>WORK EXPERIENCE</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#pfe" data-toggle="modal">Add New</button>


         <div class="modal fade" id="pfe" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Work Experience</h4>Add New Work Experience
                </div>
         <div class="modal-body">
           {!! Form::open(['route' => ['manage.workexp.store'], 'method' => 'POST', 'id' => 'pfwef']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('profile', 'Profile') }}
            {{ Form::text('profile', null, ['class' => 'form-control']) }}
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('office', 'Office', ['style' => 'margin-top:20px']) }}
            {{ Form::text('office', null, ['class' => 'form-control']) }}
            
            </div>
          </div>
           <div class="col-md-12">
          <div class="form-group">
             {{ Form::label('from_year', 'From', ['style' => 'margin-top:20px']) }}
            {{ Form::text('from_year', null, ['class' => 'form-control']) }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {{ Form::label('to_year', 'To', ['style' => 'margin-top:20px']) }}
            {{ Form::text('to_year', null, ['class' => 'form-control']) }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <button class="btn btn-success pull-right" onclick="document.getElementById(pfef).submit();">Save</button>
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
          
              @foreach($user->WorkExperiences as $workexp)
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Profile</label>
                    <p>{{$workexp->profile}}</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Office</label>
                    <p>{{$workexp->office}}</p>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>From</label>
                    <p>{{$workexp->from_year}}</p>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>To</label>
                    <p>{{$workexp->to_year}}</p>
                  </div>
                </div>
                 <div class="col-md-1">
                  <div class="form-group">
                    <button class="btn btn-warning btn-sm" data-target="#pfe{{$workexp->id}}" data-toggle="modal">Edit</button>

                    <div class="modal fade" id="pfe{{$workexp->id}}" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="top:-110px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Experience</h4>Edit Work Experience
                </div>
                <div class="modal-body">
                  {!! Form::model($workexp, ['route' => ['manage.workexp.update', $workexp->id], 'method' => 'PUT', 'id' => 'sf1'.$workexp->id]) !!}
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                     {{ Form::label('profile', 'Profile') }}
                   {{ Form::text('profile', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                   <div class="col-md-12">
                     <div class="form-group">
                     {{ Form::label('office', 'Office', ['style' => '']) }}
                   {{ Form::text('office', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                   <div class="col-md-12">
                     <div class="form-group">
                      {{ Form::label('from_year', 'From', ['style' => '']) }}
                   {{ Form::text('from_year', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                 <div class="col-md-12">
                     <div class="form-group">
                      {{ Form::label('to_year', 'To', ['style' => '']) }}
                   {{ Form::text('to_year', null, ['class' => 'form-control']) }}
                     </div>
                   </div>
                 <div class="col-md-12">
                   <div class="form-group">
                   <button class="btn btn-success pull-right" onclick="document.getElementById(sf1{{ $education->id }}).submit();">Save</button>
                   </div>
                   
                 </div>
                  </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    {!! Form::open(['route' => ['manage.workexp.destroy', $workexp->id], 'method' => 'DELETE', 'id' => 'dl'.$workexp->id]) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                   {!! Form::close() !!}
                  </div>
                </div>
                   </div>
              @endforeach
            
        </div>
    </div>




    <div class="panel panel-default">
        <div class="panel-heading">
          <label>SPECIALIZATIONS</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#pfs" data-toggle="modal">Add New</button>
         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfs" tabindex="-1">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Specialization</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['manage.specialization.store'], 'method' => 'POST', 'id' => 'pfsf']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="form-group">
            {{ Form::label('name', 'Specialization') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            <br>
            <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(pfsf).submit();">Save</button>
            <br>
            </div>
         {!! Form::close() !!}
         </div>
         </div>
         </div>
         </div>
        </div>

        <div class="panel-body">
          
              @foreach($user->specializations as $specialization)
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Specialization:</label>
                    <p>{{$specialization->name}}</p>
                  </div>
                </div>
               <div class="col-md-1">
                 <div class="form-group">
                    <button class="btn btn-warning btn-sm" data-target="#pfs{{$specialization->id}}" data-toggle="modal">Edit</button>
                     <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfs{{$specialization->id}}" tabindex="-1">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Specialization</h4>
                </div>
                <div class="modal-body">
                 {!! Form::model($specialization, ['route' => ['manage.specialization.update', $specialization->id], 'method' => 'PUT', 'id' => 'sf1'.$specialization->id]) !!}
                 <div class="form-group">
                   {{ Form::label('name', 'Specialization') }}
                   {{ Form::text('name', null, ['class' => 'form-control']) }}
                   <br>
                   <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $specialization->id }}).submit();">Save</button>
                   <br>
                   </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                 </div>
               </div>
                
                <div class="col-md-1">
                  <div class="form-group">
                    {!! Form::open(['route' => ['manage.specialization.destroy', $specialization->id], 'method' => 'DELETE', 'id' => 'dl'.$specialization->id]) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                   {!! Form::close() !!}
                  </div>
                </div>
              </div>
              @endforeach
           
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
          <label>MEMBERSHIPS</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#pfm" data-toggle="modal">Add New</button>

         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfm" tabindex="-1">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Membership</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['manage.membership.store'], 'method' => 'POST', 'id' => 'pfmf']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                {{ Form::label('institution_name', 'Institution Name') }}
            {{ Form::text('institution_name', null, ['class' => 'form-control']) }}
               </div>
            </div>
             <div class="col-md-12">
               <div class="form-group">
               {{ Form::label('institution_location', 'Location', ['style' => 'margin-top:20px']) }}
            {{ Form::text('institution_location', null, ['class' => 'form-control']) }}
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
              <button class="btn btn-success pull-right" onclick="document.getElementById(pfmf).submit();">Save</button>
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
              @foreach($user->memberships as $membership)
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Institution</label>
                   <p>{{$membership->institution_name}}</p> 
                  </div>
                </div>
                 <div class="col-md-7">
                  <div class="form-group">
                    <label>Location</label>
                   <p>{{$membership->institution_location}}</p> 
                  </div>
                </div>
                 <div class="col-md-1">
                  <div class="form-group">
                   <button class="btn btn-warning btn-sm" data-target="#pfm{{$membership->id}}" data-toggle="modal">Edit</button>
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfm{{$membership->id}}" tabindex="-1">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Membership</h4>
                </div>
                <div class="modal-body">
                 {!! Form::model($membership, ['route' => ['manage.membership.update', $membership->id], 'method' => 'PUT', 'id' => 'sf1'.$membership->id]) !!}
                 <div class="form-group">
                   {{ Form::label('institution_name', 'Institution Name') }}
                   {{ Form::text('institution_name', null, ['class' => 'form-control']) }}
                   {{ Form::label('institution_location', 'Location', ['style' => 'margin-top:20px']) }}
                   {{ Form::text('institution_location', null, ['class' => 'form-control']) }}
                   <br>
                   <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $membership->id }}).submit();">Save</button>
                   <br>
                   </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                  </div>
                </div>
               <div class="col-md-1">
                 <div class="form-group">
                   {!! Form::open(['route' => ['manage.membership.destroy', $membership->id], 'method' => 'DELETE', 'id' => 'dl'.$membership->id]) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                   {!! Form::close() !!}
                 </div>
               </div>
              </div>
              @endforeach
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
          <label>AWARDS</label>
          <button class="btn btn-success btn-sm pull-right" data-target="#pfa" data-toggle="modal">Add New</button>
         <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfa" tabindex="-1">
         <div class="modal-dialog">
         <div class="modal-content">
         <div class="modal-header">
         <button class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Award</h4>
         </div>
         <div class="modal-body">
          {!! Form::open(['route' => ['manage.award.store'], 'method' => 'POST', 'id' => 'pfaf']) !!}
          {{ Form::hidden('user_id', $user->id) }}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('award_name', 'Award Name') }}
            {{ Form::text('award_name', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                 {{ Form::label('award_by', 'Awarded By', ['style' => '']) }}
            {{ Form::text('award_by', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                 {{ Form::label('award_year', 'Year', ['style' => 'margin-top:20px']) }}
            {{ Form::text('award_year', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                  <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(pfaf).submit();">Save</button>
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
          
              @foreach($user->awards as $award)
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Award</label>
                    <p>{{$award->award_name}}</p>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Award By</label>
                    <p>{{$award->award_by}}</p>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Award Year</label>
                    <p>{{$award->award_year}}</p>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <button class="btn btn-warning btn-sm" data-target="#pfa{{$award->id}}" data-toggle="modal">Edit</button>
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfa{{$award->id}}" tabindex="-1">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Award</h4>
                </div>
                <div class="modal-body">
                 {!! Form::model($award, ['route' => ['manage.award.update', $award->id], 'method' => 'PUT', 'id' => 'sf1'.$award->id]) !!}
                 <div class="form-group">
                   {{ Form::label('award_name', 'Award Name') }}
                   {{ Form::text('award_name', null, ['class' => 'form-control']) }}
                   {{ Form::label('award_by', 'Awarded By', ['style' => 'margin-top:20px']) }}
                   {{ Form::text('award_by', null, ['class' => 'form-control']) }}
                   {{ Form::label('award_year', 'Year', ['style' => 'margin-top:20px']) }}
                   {{ Form::text('award_year', null, ['class' => 'form-control']) }}
                   <br>
                   <button class="btn btn-success btn-sm pull-right" onclick="document.getElementById(sf1{{ $award->id }}).submit();">Save</button>
                   <br>
                   </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                    {!! Form::open(['route' => ['manage.award.destroy', $award->id], 'method' => 'DELETE', 'id' => 'dl'.$award->id]) !!}
                   {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'style' => 'cursor:pointer']) }}
                   {!! Form::close() !!}
                  </div>
                </div>
              </div>
              @endforeach
            
        </div>
    </div>


</div>
    </div>
</div>
</section>

@endsection
