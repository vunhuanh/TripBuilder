<!DOCTYPE html>
<html>
  <?php 
    require 'head.html';
  ?>
  <body>
    <div class="container-fluid" style="margin:2rem">

      <div class="row">
        <div class="col-sm-3">
          <input class="btn-default" type="submit" id="home" value="Home">
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-10">
          <input class="btn-default" type="submit" id="submit" value="Add flight to trip">
        </div>
      </div>

      <input type="text" class="form-control" id="order1">

    </div> <!--END CONTAINER-->
  </body>
</html>

<script>
$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";

  $("#home").click(function(){
    var url = "/tripbuilder/client/";
    window.location.href = url;
  });

  //Get airport info
  $.ajax({
    type: "GET",
    url: base_url + "getairports",
    dataType: 'json',
    success: function(data){
      for(var i=0; i<data.length; i++){
        console.log(data[i][0]);
        var option = "<option>"+data[i][0]+"</option>";
        $('#src').append(option);
        $('#dst').append(option);
      }
    }
  });


  $("#submit").click(function(){
    //Get flight info
    var user = $("#user option:selected").text();
    var ftype = $("#ftype option:selected").text();
    var src = $("#src option:selected").text();
    var dst = $("#dst option:selected").text();
    var postdata = "user="+user + "&ftype="+ftype + "&src="+src + "&dst="+dst;

    $.ajax({
      type: "POST",
      url: base_url + "addflight",
      data: postdata,
      success: function(data){
        window.location.href = '/COMP307/front-end/html/index.php';
      }
    }); 
  });
  

});
</script>