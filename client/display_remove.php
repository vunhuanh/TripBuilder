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
        <div class="col-sm-1">Trip:</div>
        <div class="col-sm-1" id="trip"><?php echo $_SERVER['QUERY_STRING'];?></div>
      </div>
      
      <!-- ITENERARY RECAP -->
      <div class="row">
        <div class="col-sm-3">Current itinerary</div>
      </div>
      <div class="row">
        <div class="col-sm-1"><label>Order</label></div>
        <div class="col-sm-6"><label>Flight</label></div>
        <div class="col-sm-2"><label>Action</label></div>
      </div>

      <div class="row" id="itinerary">
        <div class="col-sm-1" id="flightorder"></div>
        <div class="col-sm-6" id="flightdetails"></div>
        <div class="col-sm-2" id="flightremove"></div>
      </div>

      

    </div> <!--END CONTAINER-->
  </body>
</html>

<script type="text/javascript" src="control_remove.js"></script>