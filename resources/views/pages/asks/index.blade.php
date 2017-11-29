@extends('layouts.website')
@section('content')


<div class="col-md-11">



   <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
           <div class="panel-body">
             @if(isset(Auth::user()->basicDetail->image))
             <img src="{{ asset('images/'.Auth::user()->basicDetail->image ) }}" class="img-circle" style="width:20px">
             @else
             <img src="{{ asset('images/user.png') }}" class="img-circle" style="width:20px">
             @endif
             @if(Auth::user()->basicDetail)
             {{ Auth::user()->basicDetail->firstname }} {{ Auth::user()->basicDetail->lastname }}
             @else
             {{ Auth::user()->name }}
             @endif
             <h4 data-target="#addpop2" data-toggle="modal">
               What is your question?
             </h4>
             <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addpop2" tabindex="-1">
             <div class="modal-dialog modal-lg">
             <div class="modal-content">
             <div class="modal-header">
             <button class="close" data-dismiss="modal">&times;</button>
             @if(Auth::user()->basicDetail)
             {{ Auth::user()->basicDetail->firstname }}
             @else
             {{ Auth::user()->name }}
             @endif
             </div>
             {!! Form::open(['route' => ['asks.store'], 'method' => 'POST']) !!}
             <div class="modal-body">
             <div class="form-group">
               <table class="table">
                 <tbody>
                   <tr>
                   <td style="border:none">
                     {{ Form::label('category', 'Choose Your Category') }}
                     <select class="form-control" name="category">
                       @foreach($categories as $category)
                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                       @endforeach
                     </select>
                   </td>
                   <td style="border:none">
                     {{ Form::label('sub_category', 'Choose Your Sub-category') }}
                     <select class="form-control" name="sub_category">
                       @foreach($categories as $category)
                       @foreach($category->subcategories as $subcategory)
                       <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                       @endforeach
                       @endforeach
                     </select>
                   </td>
                 </tr>
                 </tbody>
               </table>

               {{ Form::label('question', 'What is your question?') }}
               {{ Form::text('question', null, ['class' => 'form-control']) }}

               {{ Form::label('detail', 'Explain your query in detail', ['style' => 'margin-top:20px']) }}
               {{ Form::textarea('detail', null, ['class' => 'form-control', 'rows' => '3']) }}

               <label style="margin-top:20px">Who can answer</label>
               <input type="radio" name="only_expert" value="1"> only expert
               <input type="radio" name="only_expert" value="0" checked> any one can answer
               <br>

               <label style="margin-top:20px">Do you want to show your name on site</label>
               <input type="radio" name="show_name" value="1" checked> Yes
               <input type="radio" name="show_name" value="0"> No
               <br>
             </div>
             </div>
             <div class="modal-footer">
             {{ Form::submit('Ask Question', ['class' => 'btn btn-primary btn-sm']) }}
             <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
             </div>
             {!! Form::close() !!}
             </div>
             </div>
             </div>
           </div>
       </div>
     </div>
   </div>
   



</div>

@endsection
