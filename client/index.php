<!DOCTYPE html>
<html>

  <?php 
    require 'head.html';
  ?>

  <body>

    <div class="container-fluid">

      <div class="row">
        Trip Builder is a web service (API) that serves as the engine for front-end websites to manage trips for their customers.
      </div>

      <!-- USER -->
      <div class="row">
        <div class="form-group">
          <div class="col-sm-3">
            <label>User</label>
          </div>

          <div class="col-sm-3">
            <select class="form-control" id="user">
              <option>admin</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </div>
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
      <div class="row">
        <div class="col-sm-3">
          <label>Origin</label>
        </div>

        <div class="col-sm-3">
          <select class="form-control" id="src">
          </select>
        </div>

        <div class="col-sm-3">
          <label>Destination</label>
        </div>

        <div class="col-sm-3">
          <select class="form-control" id="dst">
          </select>
        </div>
      </div>
      
      <div class="row"><input type="submit" id="submit" value="Add flight to trip"></div>


    </div> <!--END CONTAINER-->


  </body>
</html>

<script>
$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";

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
        console.log(data);
      }
    }); 
  });
  

});
</script>
