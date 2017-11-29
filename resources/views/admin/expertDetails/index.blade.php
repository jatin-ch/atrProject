@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">


            <div class="panel panel-default">
                <div class="panel-heading">
                  Expert Profile of <strong>{{Auth::user()->name}}</strong>
                  <button class="btn btn-primary btn-sm pull-right" data-target="#addpop1" data-toggle="modal">Edit</button>
                  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop1" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit</h4>
                  </div>
                  <div class="modal-body">
                  {!! Form::model($expertdetail, ['route' => ['expertDetails.update', $expertdetail->id], 'method' => 'PUT', 'id' => 'addnew']) !!}
                  <div class="form-group">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('type', 'Type of expert') }}
                            <select name="type" class="form-control">
                              <option value="individual" {{$expertdetail->type=='individual' ? 'selected' : ''}}>Individual</option>
                              <option value="professional" {{$expertdetail->type=='professional' ? 'selected' : ''}}>Professional</option>
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('experience', 'Total Experience') }}
                            {{ Form::text('experience', null, ['class' => 'form-control']) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('mjaor_cat', 'Major: Category') }}
                            <select name="major_cat" class="form-control">
                              @foreach($categories as $category)
                              <option value="{{ $category->name }}" {{$expertdetail->major_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('major_subcat', 'Major: Sub-category') }}
                            <select name="major_subcat" class="form-control">
                              @foreach($sub_categories as $subcategory)
                              <option value="{{ $subcategory->name }}" {{$expertdetail->major_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('other_cat', 'Other: Category') }}
                            <select name="other_cat" class="form-control">
                              @foreach($categories as $category)
                              <option value="{{ $category->name }}" {{$expertdetail->other_cat==$category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('other_subcat', 'Other: Sub-categroy') }}
                            <select name="other_subcat" class="form-control">
                              @foreach($sub_categories as $subcategory)
                              <option value="{{ $subcategory->name }}" {{$expertdetail->other_subcat==$subcategory->name ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('cp', 'Current Profile') }}
                            {{ Form::text('cp', null, ['class' => 'form-control']) }}
                          </td>
                          <td style="border:none">
                            {{ Form::label('coc', 'Current Organization/Company') }}
                            {{ Form::text('coc', null, ['class' => 'form-control']) }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>

                    {{ Form::label('qualification', 'Qualifications') }}
                    <select class="form-control" name="qualification">
                      <option value="">--Select--</option>
                      @foreach($qualifications as $qualification)
                      <option value="{{$qualification->name}}" {{$expertdetail->qualification == $qualification->name ? 'selected' : ''}}>{{$qualification->name}}</option>
                      @endforeach
                    </select>

                    @foreach($qualifications as $qualification)
                    <input type="checkbox" name="qualifications[]" value="{{$qualification->id}}"> {{$qualification->name}}
                    @endforeach
                    <br>

                    {{ Form::label('also_for', 'I can also help for', ['style' => 'margin-top:20px']) }}
                    {{ Form::textarea('also_for', null, ['class' => 'form-control', 'rows' => '3']) }}

                    {{ Form::label('about', 'About Me', ['style' => 'margin-top:20px']) }}
                    {{ Form::textarea('about', null, ['class' => 'form-control', 'rows' => '3']) }}
                    <br>

                  <div class="form-group">
                  <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(addnew).submit();">Submit</button>
                   <br>
                  </div>
                  {!! Form::close() !!}
                  </div>
                  </div>
                  </div>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      @if(isset(Auth::user()->basicDetail->image))
                      <img src="{{ asset('images/' .Auth::user()->basicDetail->image) }}" style="width:150px">
                      @else
                       @if(Auth::user()->basicDetail->gender == 'M')
                         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRXflGToQBiuslDfqpbRGQYbXOKS_ukUzAeoMImyCtGdpQ8Ra" style="width:130px">
                       @else
                         <img src="https://cdn2.hercampus.com/jane%20doe.jpg" style="width:150px">
                       @endif
                      @endif
                    </div>
                    <div class="col-md-3">
                      <small>Adviser Type</small>
                      <p><strong>{{ $expertdetail->type }}</strong></p>
                      <small>Years of Experience</small>
                      <p><strong>{{ $expertdetail->experience }} yrs</strong></p>
                    </div>
                    <div class="col-md-3">
                      <small>Major Category</small>
                      <p><strong>{{ $expertdetail->major_cat }}</strong></p>
                      <small>Other Category</small>
                      <p><strong>{{ $expertdetail->other_cat }}</strong></p>
                    </div>
                    <div class="col-md-3">
                      <small>Major Sub-category</small>
                      <p><strong>{{ $expertdetail->major_subcat }}</strong></p>
                      <small>Other Sub-category</small>
                      <p><strong>{{ $expertdetail->other_subcat }}</strong></p>
                    </div>
                  </div>
                  <div class="row" style="margin-top:50px">
                  <div class="col-md-12">
                    <strong>Qualification</strong>
                    <p>{{ $expertdetail->qualification }}</p>
                    <strong>can also Help for</strong>
                    <p>{{ $expertdetail->also_for }}</p>
                    <strong>About Me</strong>
                    <p>{{ $expertdetail->about }}</p>
                  </div>
                </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>EDUCATIONS</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#pfe" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfe" tabindex="-1">
                 <div class="modal-dialog modal-md">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">New Education</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['education.store'], 'method' => 'POST', 'id' => 'pfef']) !!}
                  <div class="form-group">
                    {{ Form::label('degree', 'Degree') }}
                    {{ Form::text('degree', null, ['class' => 'form-control']) }}
                    {{ Form::label('college', 'College Name', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('college', null, ['class' => 'form-control']) }}
                    {{ Form::label('year', 'Year', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('year', null, ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(pfef).submit();">Save</button>
                    <br>
                    </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      @foreach(Auth::user()->educations as $education)
                      <tr>
                        <td style="border:none">{{$education->degree}} - {{$education->college}} - {{$education->year}}</td>
                        <td style="border:none">
                         <button class="btn btn-default btn-sm" data-target="#pfe{{$education->id}}" data-toggle="modal">Edit</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfe{{$education->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Education</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::model($education, ['route' => ['education.update', $education->id], 'method' => 'PUT', 'id' => 'sf1'.$education->id]) !!}
                         <div class="form-group">
                           {{ Form::label('degree', 'Degree') }}
                           {{ Form::text('degree', null, ['class' => 'form-control']) }}
                           {{ Form::label('college', 'College Name', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('college', null, ['class' => 'form-control']) }}
                           {{ Form::label('year', 'Year', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('year', null, ['class' => 'form-control']) }}
                           <br>
                           <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $education->id }}).submit();">Save</button>
                           <br>
                           </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>
                        </td>
                        <td style="border:none">
                           {!! Form::open(['route' => ['education.destroy', $education->id], 'method' => 'DELETE', 'id' => 'dl'.$education->id]) !!}
                           {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>WORK EXPERIENCE</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#pfwe" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfwe" tabindex="-1">
                 <div class="modal-dialog modal-md">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">New Work Experience</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['workexp.store'], 'method' => 'POST', 'id' => 'pfwef']) !!}
                  <div class="form-group">
                    {{ Form::label('profile', 'Profile') }}
                    {{ Form::text('profile', null, ['class' => 'form-control']) }}
                    {{ Form::label('office', 'Office', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('office', null, ['class' => 'form-control']) }}
                    {{ Form::label('from_year', 'From', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('from_year', null, ['class' => 'form-control']) }}
                    {{ Form::label('to_year', 'To', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('to_year', null, ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(pfwef).submit();">Save</button>
                    <br>
                    </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>

                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      @foreach(Auth::user()->WorkExperiences as $workexp)
                      <tr>
                        <td style="border:none">{{$workexp->profile}} at {{$workexp->office}} - {{$workexp->from_year}}-{{$workexp->to_year}}</td>
                        <td style="border:none">
                         <button class="btn btn-default btn-sm" data-target="#pfwe{{$workexp->id}}" data-toggle="modal">Edit</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfwe{{$workexp->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Work Experience</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::model($workexp, ['route' => ['workexp.update', $workexp->id], 'method' => 'PUT', 'id' => 'sf1'.$workexp->id]) !!}
                         <div class="form-group">
                           {{ Form::label('profile', 'Profile') }}
                           {{ Form::text('profile', null, ['class' => 'form-control']) }}
                           {{ Form::label('office', 'Office', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('office', null, ['class' => 'form-control']) }}
                           {{ Form::label('from_year', 'From', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('from_year', null, ['class' => 'form-control']) }}
                           {{ Form::label('to_year', 'To', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('to_year', null, ['class' => 'form-control']) }}
                           <br>
                           <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $workexp->id }}).submit();">Save</button>
                           <br>
                           </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>
                        </td>
                        <td style="border:none">
                           {!! Form::open(['route' => ['workexp.destroy', $workexp->id], 'method' => 'DELETE', 'id' => 'dl'.$workexp->id]) !!}
                           {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>SPECIALIZATIONS</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#pfs" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfs" tabindex="-1">
                 <div class="modal-dialog modal-md">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">New Specialization</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['specialization.store'], 'method' => 'POST', 'id' => 'pfsf']) !!}
                  <div class="form-group">
                    {{ Form::label('name', 'Specialization') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(pfsf).submit();">Save</button>
                    <br>
                    </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>

                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      @foreach(Auth::user()->specializations as $specialization)
                      <tr>
                        <td style="border:none">{{$specialization->name}}</td>
                        <td style="border:none">
                         <button class="btn btn-default btn-sm" data-target="#pfs{{$specialization->id}}" data-toggle="modal">Edit</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfs{{$specialization->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Specialization</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::model($specialization, ['route' => ['specialization.update', $specialization->id], 'method' => 'PUT', 'id' => 'sf1'.$specialization->id]) !!}
                         <div class="form-group">
                           {{ Form::label('name', 'Specialization') }}
                           {{ Form::text('name', null, ['class' => 'form-control']) }}
                           <br>
                           <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $specialization->id }}).submit();">Save</button>
                           <br>
                           </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>
                        </td>
                        <td style="border:none">
                           {!! Form::open(['route' => ['specialization.destroy', $specialization->id], 'method' => 'DELETE', 'id' => 'dl'.$specialization->id]) !!}
                           {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>MEMBERSHIPS</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#pfm" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfm" tabindex="-1">
                 <div class="modal-dialog modal-md">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">New Membership</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['membership.store'], 'method' => 'POST', 'id' => 'pfmf']) !!}
                  <div class="form-group">
                    {{ Form::label('institution_name', 'Institution Name') }}
                    {{ Form::text('institution_name', null, ['class' => 'form-control']) }}
                    {{ Form::label('institution_location', 'Location', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('institution_location', null, ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(pfmf).submit();">Save</button>
                    <br>
                    </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      @foreach(Auth::user()->memberships as $membership)
                      <tr>
                        <td style="border:none">{{$membership->institution_name}}, {{$membership->institution_location}}</td>
                        <td style="border:none">
                         <button class="btn btn-default btn-sm" data-target="#pfm{{$membership->id}}" data-toggle="modal">Edit</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfm{{$membership->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Membership</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::model($membership, ['route' => ['membership.update', $membership->id], 'method' => 'PUT', 'id' => 'sf1'.$membership->id]) !!}
                         <div class="form-group">
                           {{ Form::label('institution_name', 'Institution Name') }}
                           {{ Form::text('institution_name', null, ['class' => 'form-control']) }}
                           {{ Form::label('institution_location', 'Location', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('institution_location', null, ['class' => 'form-control']) }}
                           <br>
                           <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $membership->id }}).submit();">Save</button>
                           <br>
                           </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>
                        </td>
                        <td style="border:none">
                           {!! Form::open(['route' => ['membership.destroy', $membership->id], 'method' => 'DELETE', 'id' => 'dl'.$membership->id]) !!}
                           {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>AWARDS</strong>
                  <button class="btn btn-success btn-sm pull-right" data-target="#pfa" data-toggle="modal">Add New</button>
                 <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfa" tabindex="-1">
                 <div class="modal-dialog modal-md">
                 <div class="modal-content">
                 <div class="modal-header">
                 <button class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">New Award</h4>
                 </div>
                 <div class="modal-body">
                  {!! Form::open(['route' => ['award.store'], 'method' => 'POST', 'id' => 'pfaf']) !!}
                  <div class="form-group">
                    {{ Form::label('award_name', 'Award Name') }}
                    {{ Form::text('award_name', null, ['class' => 'form-control']) }}
                    {{ Form::label('award_by', 'Awarded By', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('award_by', null, ['class' => 'form-control']) }}
                    {{ Form::label('award_year', 'Year', ['style' => 'margin-top:20px']) }}
                    {{ Form::text('award_year', null, ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(pfaf).submit();">Save</button>
                    <br>
                    </div>
                 {!! Form::close() !!}
                 </div>
                 </div>
                 </div>
                 </div>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      @foreach(Auth::user()->awards as $award)
                      <tr>
                        <td style="border:none">{{$award->award_name}} BY {{$award->award_by}} - ({{$award->award_year}})</td>
                        <td style="border:none">
                         <button class="btn btn-default btn-sm" data-target="#pfa{{$award->id}}" data-toggle="modal">Edit</button>
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="pfa{{$award->id}}" tabindex="-1">
                        <div class="modal-dialog modal-md">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Award</h4>
                        </div>
                        <div class="modal-body">
                         {!! Form::model($award, ['route' => ['award.update', $award->id], 'method' => 'PUT', 'id' => 'sf1'.$award->id]) !!}
                         <div class="form-group">
                           {{ Form::label('award_name', 'Award Name') }}
                           {{ Form::text('award_name', null, ['class' => 'form-control']) }}
                           {{ Form::label('award_by', 'Awarded By', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('award_by', null, ['class' => 'form-control']) }}
                           {{ Form::label('award_year', 'Year', ['style' => 'margin-top:20px']) }}
                           {{ Form::text('award_year', null, ['class' => 'form-control']) }}
                           <br>
                           <button class="btn btn-primary btn-sm pull-right" onclick="document.getElementById(sf1{{ $award->id }}).submit();">Save</button>
                           <br>
                           </div>
                        {!! Form::close() !!}
                        </div>
                        </div>
                        </div>
                        </div>
                        </td>
                        <td style="border:none">
                           {!! Form::open(['route' => ['award.destroy', $award->id], 'method' => 'DELETE', 'id' => 'dl'.$award->id]) !!}
                           {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm', 'style' => 'color:#a00;cursor:pointer']) }}
                           {!! Form::close() !!}
                         </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>


        </div>
    <!-- </div>
</div> -->

@endsection
