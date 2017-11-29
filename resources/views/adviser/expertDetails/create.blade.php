@extends('layouts.adviser')
@section('title') | Expert-details @endsection
@section('content')


<style>
    .height80 {
        height: 80px;
    }

    .height120 {
        height: 120px;
    }

    .padding15 {
        padding: 15px;
    }

    .widthmax {
        width: max-content;
    }

    .fontgreen {
        font: #21e621;
    }
</style>


<section class="content-header">
    <h1>
        Profile {{$pw}}% complete
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Expertization</li>
    </ol>
</section>
<hr style="border: 1px solid #00a65a;">
<section class="content">
    {!! Form::open(['route' => ['adviser.expertDetails.store'], 'method' => 'POST']) !!}
        <div class="row basicdetail">
            <div class="col-lg-12">
                <div class="col-lg-6">
                <div class="form-group ">
                    <label for="lbltoe" class="fontcolor">TYPE OF EXPERT </label>
                    <select name="type" class="form-control">
                      <option value="individual">Individual</option>
                      <option value="professional" selected>Professional</option>
                    </select>
                </div>
                </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                    {{ Form::label('experience', 'TOTAL EXPERIENCE', ['class' => 'fontcolor']) }}
                    {{ Form::number('experience', null, ['class' => 'form-control', 'min'=>'0','max'=>'70']) }}
                    </div>
                </div>

                 <div class="col-lg-6">
                    <div class="form-group ">
                    {{ Form::label('cp', 'PRACTICING AT/ CURRENT PROFILE', ['class' => 'fontcolor']) }}
                    {{ Form::text('cp', null, ['class' => 'form-control']) }}
                </div>
                </div>
                 <div class="col-lg-6">
                    <div class="form-group ">
                      {{ Form::label('coc', 'CURRENT FIRM / ORGANIZATION', ['class' => 'fontcolor']) }}
                      {{ Form::text('coc', null, ['class' => 'form-control']) }}
                   </div>
                </div>
                 <div class="col-lg-6">
                     <div class="form-group ">
                    <label for="lblcatmajor" class="mt10 fontcolor">CATEGORY : MAJOR EXPERTISE</label>
                    <div class=" padding15 box box-default">
                    <div class="form-group">
                      {{ Form::label('mjaor_cat', 'CATEGORY', ['class' => "fontcolor"]) }}
                      <select name="major_cat" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      {{ Form::label('major_subcat', 'EXPERTISE', ['class' => 'fontcolor']) }}
                      <select name="major_subcat" class="form-control">
                        @foreach($sub_categories as $subcategory)
                        <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                    </div>
                </div>
                 <div class="col-lg-6">
                     <div class="form-group">
                    <label for="lblcatexp" class="mt10 fontcolor">CATEGORY : EXPERTISE</label>
                    <div class=" padding15 box box-default">
                        <!-- <div class="box-header with-border  "> -->
                        <div class="form-group">
                          {{ Form::label('other_cat', 'CATEGORY', ['class' =>'fontcolor']) }}
                          <select name="other_cat" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          {{ Form::label('other_subcat', 'EXPERTISE', ['class' => 'fontcolor']) }}
                          <select name="other_subcat" class="form-control">
                            @foreach($sub_categories as $subcategory)
                            <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                     </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                      {{ Form::label('qualification', 'QUALIFICATION', ['class' => 'mt20   fontcolor']) }}
                      <select class="form-control" name="qualification">
                        <option value="">--Select--</option>
                        @foreach($qualifications as $qualification)
                        <option value="{{$qualification->name}}"> {{$qualification->name}}</option>
                        @endforeach
                      </select>

                      @foreach($qualifications as $qualification)
                      <input type="checkbox" name="qualifications[]" value="{{$qualification->id}}"> {{$qualification->name}}
                      @endforeach
                </div>
                </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div>
                        <label for="lbledu" class="mt20   fontcolor">EDUCATION/CERTIFICATION</label>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <table class="table">
                            <thead>
                              <tr>
                                <th><label class="fontcolor">DEGREE</label></th>
                                <th><label class="fontcolor">COLLEGE/INSTITUTE</label></th>
                                <th><label class="fontcolor">YEAR</label></th>
                              </tr>
                            <thead>
                            <tbody class="input_fields_wrap1">
                            <tbody>
                              <tr>
                                <td style="border:none">
                                  <input type="text" name="degree[]" class="form-control" placeholder="type your degree name">
                                </td>
                                <td style="border:none">
                                  <input type="text" name="college[]" class="form-control" placeholder="type your college/institute">
                                </td>
                                <td style="border:none">
                                  <input type="number" name="year[]" class="form-control" placeholder="type year" min="1950">
                                </td>
                                </tr>
                              </tbody>
                          </tbody>
                        </table>
                        <div class="row">
                          <div class="col-md-2 col-md-offset-5">
                            <a class="add_field_button1 btn btn-success btn-xs">Add More Fields</a>
                          </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>

                <div class="col-lg-12">
                <div class="form-group">
                    <div>
                        <label for="lblwrkexp" class="mt20 fontcolor">WORK EXPERIENCE</label>
                    </div>
                    <div class="box box-default">
                        <div class="box-header   ">
                          <table class="table">
                          <thead>
                            <tr>
                              <th><label class="fontcolor">PROFILE</label></th>
                              <th><label class="fontcolor">HOSPITAL/CLINIC</label></th>
                              <th><label class="fontcolor">FROM</label></th>
                              <th><label class="fontcolor">TO</label></th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap2">
                          <tbody>
                            <tr>
                              <td style="border:none">
                                <input type="text" name="profile[]" class="form-control" placeholder="Type your profile">
                              </td>
                              <td style="border:none">
                                <input type="text" name="office[]" class="form-control" placeholder="Type hospital">
                              </td>
                              <td style="border:none">
                                <input type="number" name="from_year[]" class="form-control" placeholder="From year" min="1950">
                              </td>
                              <td style="border:none">
                                <input type="number" name="to_year[]" class="form-control" placeholder="To year" min="1950">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>

                      <div class="text-center Enter mt20">
                          <a class="add_field_button2 btn btn-success btn-xs">Add More Fields</a>
                      </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div>
                        <label for="lblswift" class="mt20  fontcolor">SPECIALIZATION</label>
                    </div>
                    <div class="box box-default">
                        <div class="box-header   ">
                          <table class="table">
                          <thead>
                            <tr>
                              <th><label class="fontcolor">SPECIALIZATION</label></th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap3">
                          <tbody>
                            <tr>
                              <td style="border:none">
                                <input type="text" name="name[]" class="form-control" placeholder="type your specialization">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>

                      <div class="text-center Enter mt20">
                          <a class="add_field_button3 btn btn-success btn-xs">Add More Fields</a>
                      </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <div>
                        <label for="lblswift" class="mt20  fontcolor">MEMBERSHIP</label>
                    </div>
                    <div class="box box-default">
                        <div class="box-header   ">
                          <table class="table">
                          <thead>
                            <tr>
                              <th><label class="fontcolor">INSTITUTE NAME</label></th>
                              <th><label class="fontcolor">LOCATION</label></th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap4">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="institution_name[]" class="form-control" placeholder="Type your institute name">
                              </td>
                              <td>
                                <input type="text" name="institution_location[]" class="form-control" placeholder="Type your loction">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>

                      <div class="text-center Enter mt20">
                          <a class="add_field_button4 btn btn-success btn-xs">Add More Fields</a>
                      </div>
                        </div>

                    </div>

                </div>
            </div>

             <div class="col-lg-12">
                <div class="form-group">
                    <div>
                        <label for="lblaward" class="mt20  fontcolor">AWARD & RECOGNIZATON</label>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                          <table class="table">
                          <thead>
                            <tr>
                              <th style="border:none"><label class="fontcolor">AWARD NAME</label></th>
                              <th style="border:none"><label class="fontcolor">AWARDED BY</label></th>
                              <th style="border:none"><label class="fontcolor">YEAR</label></th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap5">
                          <tbody>
                            <tr>
                              <td style="border:none">
                                <input type="text" name="award_name[]" class="form-control" placeholder="Type Award name">
                              </td>
                              <td style="border:none">
                                <input type="text" name="award_by[]" class="form-control" placeholder="Type Awarded by">
                              </td>
                              <td style="border:none">
                                <input type="number" name="award_year[]" class="form-control" placeholder="Award year" min="1970">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>

                      <div class="text-center Enter mt20">
                          <a class="add_field_button5 btn btn-success btn-xs">Add More Fields</a>
                      </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                  <div>
                      {{ Form::label('also_for', 'I CAN ALSO HELP FOR', ['class' => 'mt20 fontcolor']) }}
                  </div>
                  <div class="form-group ">
                    {{ Form::textarea('also_for', null, ['class' => 'form-control', 'rows' => '2']) }}

                  </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                  <div>
                      {{ Form::label('about', 'ABOUT ME', ['class' => 'mt20 fontcolor']) }}
                  </div>
                  <div class="form-group ">
                    {{ Form::textarea('about', null, ['class' => 'form-control', 'rows' => '2']) }}
                  </div>
                </div>
            </div>

               <div class="col-lg-12 text-center mt20 mb10">
                 {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
                </div>

            </div>

    {{ Form::close() }}
</section>



@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
    var max_fields1      = 3;
    var wrapper1         = $(".input_fields_wrap1");
    var add_button1      = $(".add_field_button1");

    var x1 = 1;
    $(add_button1).click(function(e){
        e.preventDefault();
        if(x1 < max_fields1){
            x1++;
            $(wrapper1).append('<tr><td style="border:none"><input type="text" name="degree[]" class="form-control" placeholder="type your degree name"></td><td style="border:none"><input type="text" name="college[]" class="form-control" placeholder="type your college/Institute"></td><td style="border:none"><input type="text" name="year[]" class="form-control" placeholder="type year"></td><a href="#" class="remove_field"><i class="fa fa-close"></i></a>s</tr>');
        }
    });

    $(wrapper1).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x1--;
    });


    var max_fields2      = 3;
    var wrapper2         = $(".input_fields_wrap2");
    var add_button2      = $(".add_field_button2");

    var x2 = 1;
    $(add_button2).click(function(e){
        e.preventDefault();
        if(x2 < max_fields2){
            x2++;
            $(wrapper2).append('<tr><td style="border:none"><input type="text" name="profile[]" class="form-control" placeholder="Type your profile"></td><td style="border:none"><input type="text" name="office[]" class="form-control" placeholder="Type hospital"></td><td style="border:none"><input type="text" name="from_year[]" class="form-control" placeholder="From year"></td><td style="border:none"><input type="text" name="to_year[]" class="form-control" placeholder="To year"></td><a href="#" class="remove_field">Remove</a></tr>');
        }
    });

    $(wrapper2).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x2--;
    });



    var max_fields3      = 3;
    var wrapper3         = $(".input_fields_wrap3");
    var add_button3      = $(".add_field_button3");

    var x3 = 1;
    $(add_button3).click(function(e){
        e.preventDefault();
        if(x3 < max_fields3){
            x3++;
            $(wrapper3).append('<tr><td style="border:none"><input type="text" name="name[]" class="form-control" placeholder="type your specialization"></td><a href="#" class="remove_field3">Remove</a></tr>');
        }
    });

    $(wrapper3).on("click",".remove_field3", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x3--;
    });


    var max_fields4      = 3;
    var wrapper4         = $(".input_fields_wrap4");
    var add_button4      = $(".add_field_button4");

    var x4 = 1;
    $(add_button4).click(function(e){
        e.preventDefault();
        if(x4 < max_fields4){
            x4++;
            $(wrapper4).append('<tr><td style="border:none"><input type="text" name="institution_name[]" class="form-control" placeholder="Type your institute name"></td><td style="border:none"><input type="text" name="institution_location[]" class="form-control" placeholder="Type your loction"></td><a href="#" class="remove_field">Remove</a></tr>');
        }
    });

    $(wrapper4).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x4--;
    });


    var max_fields5      = 3;
    var wrapper5         = $(".input_fields_wrap5");
    var add_button5      = $(".add_field_button5");

    var x5 = 1;
    $(add_button5).click(function(e){
        e.preventDefault();
        if(x5 < max_fields5){
            x5++;
            $(wrapper5).append('<tr><td style="border:none"><input type="text" name="award_name[]" class="form-control" placeholder="Type Award name"></td><td style="border:none"><input type="text" name="award_by[]" class="form-control" placeholder="Type Awarded by"></td><td style="border:none"><input type="text" name="award_year[]" class="form-control" placeholder="Award year"></td><a href="#" class="remove_field">Remove</a></tr>');
        }
    });

    $(wrapper5).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x5--;
    });

});
</script
