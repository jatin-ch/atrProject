<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Live Search | Laravel</title>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>
  <body>

    <form>
    <input type="text" id="search" name="search" size="40">
    <div id="livesearch"></div>
    </form>

    <script type="text/javascript">
      $('#search').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
          type : 'get',
          url : '{{URL::to('liveSearch')}}',
          data : {'search':$value},
          success:function(data){
            $('#livesearch').html(data);
          }
        })
      })
    </script>

  </body>
</html>
