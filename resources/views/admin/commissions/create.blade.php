@extends('layouts.admin')
@section('title') | Commission | Create @endsection
@section('content')
<section class="content-header">
      <h1>
        Adviceli Commission
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">All</li>
      </ol>
    </section>
<hr style="border: 1px solid #00a65a;">
<section>
    <div class="container-fluid">
    <div class="row">
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-body">

        <div class="col-md-12">
            {!! Form::open(['route' => ['commissions.sort'], 'method' => 'POST']) !!}
            <div class="form-group col-md-5">
                <select class="form-control" name="catId" id="catc">
                    <option value="">-- Select Category --</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" >{{$category->name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <select class="form-control" name="subcatId" id="subcatc">
                  <option value="">--  Select Sub-category --</option>
                </select>
            </div>
            <div class="form-group col-md-2">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>

        @if(isset($message))
        {{$message}}
        @endif


        {!! Form::open(['route'=>['commissions.store'], 'method'=>'POST', 'id'=>'submitCommission']) !!}
            <table class="table">
              <thead>
                <tr>
                  <th>
                    <input type="checkbox" class="selectall"> All</input>
                  </th>
                  <th>Name</th>
                  <th>Email Id</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($advisers as $adviser)
                  <tr>
                    <th class="checklist">
                        <!--<input type="checkbox" name="adviser[]" value"{{ $adviser->id }}"></input>-->
                        {{ Form::checkbox('adviser[]', $adviser->id) }}
                    </th>
                    <td>{{ $adviser->name }}</td>
                    <td>{{ $adviser->email }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <div class="col-md-12 text-center">
              <div class="form-group form-inline">
                {{ Form::text('price', null, ['class'=>'form-control', 'placeholder'=>'price (INR)', 'required'=>'']) }}
                <button class="btn btn-success " onclick="document.getElementById('submitCommission').submit();">Submit</button>
              </div>
            </div>

         {!! Form::close() !!}

        </div>
    </div>
</div>
</div>
</div>
</section>


<!--script for category select-->
 <script type="text/javascript">

       $('#catc').on('change', function(e){
         console.log(e);
         var cat_id = e.target.value;

         $.get('http://testserver.adviceli.com/public/newGet?cat_id=' + cat_id, function(data){
           $('#subcatc').empty();
           $.each(data, function(index, subcatObj){
             $('#subcatc').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>')
           });
         });
       });


       $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('.checklist input').prop('checked', true);
        } else {
             $('.checklist input').prop('checked', false);
        }
      });


     </script>


@endsection
