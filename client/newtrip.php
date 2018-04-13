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

      <!-- FLIGHT TYPE -->
      <div class="row">
        <div class="col-sm-3">
          <label>Type of flight</label>
        </div>

        <div class="col-sm-3">
          <select class="form-control" id="ftype">
            <option>One-way</option>
            <option>Round-trip</option>
            <option>Multi-city</option>
          </select>
        </div>
      </div>

      <!-- FLIGHT SELECTION -->
      <div class="row">Flight selection</div>
      <div class="row">
        <div class="col-sm-2">
          <label>Origin</label>
        </div>

        <div class="col-sm-4">
          <select class="form-control" id="src">
            <option></option>
          </select>
        </div>

        <div class="col-sm-2">
          <label>Destination</label>
        </div>

        <div class="col-sm-4">
          <select class="form-control" id="dst">
            <option></option>
          </select>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-10">
          <input class="btn-default" type="submit" id="submit" value="Add flight to trip">
        </div>
      </div>

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