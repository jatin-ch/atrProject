@extends('layouts.app')
@section('content')

<!-- <div class="container">
    <div class="row"> -->
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Adviser's Expert Details
                </div>

                <div class="panel-body">
                  {!! Form::open(['route' => ['expertDetails.store'], 'method' => 'POST', 'id' => 'sf123']) !!}
                  <div class="form-group">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('type', 'Type of expert') }}
                            <select name="type" class="form-control">
                              <option value="individual" selected>Individual</option>
                              <option value="professional">Professional</option>
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
                              <option value="{{ $category->name }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('major_subcat', 'Major: Sub-category') }}
                            <select name="major_subcat" class="form-control">
                              @foreach($sub_categories as $subcategory)
                              <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td style="border:none">
                            {{ Form::label('other_cat', 'Other: Category') }}
                            <select name="other_cat" class="form-control">
                              @foreach($categories as $category)
                              <option value="{{ $category->name }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td style="border:none">
                            {{ Form::label('other_subcat', 'Other: Sub-categroy') }}
                            <select name="other_subcat" class="form-control">
                              @foreach($sub_categories as $subcategory)
                              <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
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


                    <div class="panel panel-default">
                        <div class="panel-heading">
                          EDUCATIONS <button class="add_field_button1 btn btn-success btn-xs pull-right">Add More Fields</button>
                        </div>

                        <div class="panel-body">
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Degree</th>
                              <th>College</th>
                              <th>Year</th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap1">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="degree[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="college[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="year[]" class="form-control">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                          WORK EXPERIENCE<button class="add_field_button2 btn btn-success btn-xs pull-right">Add More Fields</button>
                        </div>

                        <div class="panel-body">
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Profile</th>
                              <th>Office</th>
                              <th>From</th>
                              <th>To</th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap2">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="profile[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="office[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="from_year[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="to_year[]" class="form-control">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                          SPECIALIZATION<button class="add_field_button3 btn btn-success btn-xs pull-right">Add More Fields</button>
                        </div>

                        <div class="panel-body">
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Specialization</th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap3">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="name[]" class="form-control">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                          MEMBERSHIP<button class="add_field_button4 btn btn-success btn-xs pull-right">Add More Fields</button>
                        </div>

                        <div class="panel-body">
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Institution Name</th>
                              <th>Location</th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap4">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="institution_name[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="institution_location[]" class="form-control">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                          AWARDS<button class="add_field_button5 btn btn-success btn-xs pull-right">Add More Fields</button>
                        </div>

                        <div class="panel-body">
                          <table class="table">
                          <thead>
                            <tr>
                              <th>Award Name</th>
                              <th>Awarded by</th>
                              <th>Year</th>
                            </tr>
                          <thead>
                          <tbody class="input_fields_wrap5">
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" name="award_name[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="award_by[]" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="award_year[]" class="form-control">
                              </td>
                              </tr>
                            </tbody>
                        </tbody>
                      </table>
                        </div>
                    </div>

                    {{ Form::label('qualification', 'Qualifications') }}
                    <select class="form-control" name="qualification">
                      <option value="">--Select--</option>
                      @foreach($qualifications as $qualification)
                      <option value="{{$qualification->name}}"> {{$qualification->name}}</option>
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

                    <button class="btn btn-primary pull-right" onclick="document.getElementById(sf123).submit();">Save & Next</button>

                 {!! Form::close() !!}
                </div>
            </div>
        </div>
    <!-- </div>
</div> -->

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
            $(wrapper1).append('<tr><td><input type="text" name="degree[]" class="form-control"></td><td><input type="text" name="college[]" class="form-control"></td><td><input type="text" name="year[]" class="form-control"></td><a href="#" class="remove_field">Remove</a></tr>');
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
            $(wrapper2).append('<tr><td><input type="text" name="profile[]" class="form-control"></td><td><input type="text" name="office[]" class="form-control"></td><td><input type="text" name="from_year[]" class="form-control"></td><td><input type="text" name="to_year[]" class="form-control"></td><a href="#" class="remove_field">Remove</a></tr>');
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
            $(wrapper3).append('<tr><td><input type="text" name="name[]" class="form-control"></td><td><a href="#" class="remove_field3">Remove</a></td></tr>');
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
            $(wrapper4).append('<tr><td><input type="text" name="institution_name[]" class="form-control"></td><td><input type="text" name="institution_location[]" class="form-control"></td><a href="#" class="remove_field">Remove</a></tr>');
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
            $(wrapper5).append('<tr><td><input type="text" name="award_name[]" class="form-control"></td><td><input type="text" name="award_by[]" class="form-control"></td><td><input type="text" name="award_year[]" class="form-control"></td><a href="#" class="remove_field">Remove</a></tr>');
        }
    });

    $(wrapper5).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('tr').remove(); x5--;
    });

});
</script>
