<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
  </head>
  <body>

      <select class="" name="category" id="category">
        <option value="">Select category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>

      <select class="" name="subcategory" id="subcategory">
        <option value=""></option>
      </select>

      <input type="date" id="fsd" />
      <!--<input type="text" name="" value="46" id="fsId">-->
      {{ Form::hidden('fsId', 5, ['id'=>'fsId']) }}
      <select  name="" id="fst">
        <option value=""></option>
      </select>


     <script type="text/javascript">
       $('#category').on('change', function(e){
         //console.log(e);
         var cat_id = e.target.value;

         $.get('newGet?cat_id=' + cat_id, function(data){
           //console.log(data);
           $('#subcategory').empty();
           $.each(data, function(index, subcatObj){
             $('#subcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>')
           });
         });
       });
     </script>

     <script type="text/javascript">
       $('#fsd').on('change', function(e){
         console.log(e);
         var fsd = e.target.value;
         var fsId = $('#fsId').val();

         $.get('newTime?fsd=' + fsd +'&fsId='+ fsId, function(data){
          // console.log(data);
           $('#fst').empty();
           $.each(data, function(index, fsObj){
           $('#fst').append('<option value="'+fsObj.time_from+'">'+fsObj.time_from +' - '+ fsObj.time_to +'</option>')
           });
         });
       });
     </script>

  </body>
</html>
