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
      
      <div class="row">
        <!-- FLIGHT SELECTION -->
        <div class="col-sm-6" style="border-right: solid black 1px" id="fselect">
          <div class="row">
            <div class="col-sm-3">Flight selection</div>
          </div>
          <div class="row">
            <div class="col-sm-6"><label>Origin</label></div>
            <div class="col-sm-6"><label>Destination</label></div>
          </div>

          <!-- One field row -->
          <div class="row" id="field">
            <div class="col-sm-6">
              <select class="form-control" id="src">
                <option></option>
              </select>
            </div>

            <div class="col-sm-6">
              <select class="form-control" id="dst">
                <option></option>
              </select>
            </div>
          </div>

          <!-- Next field row -->
        </div>

        <!-- ITENERARY RECAP -->
        <div class="col-sm-6">
          <div class="row">
            <div class="col-sm-3">Current itinerary</div>
          </div>
          <div class="row">
            <div class="col-sm-1"><label>Order</label></div>
            <div class="col-sm-11"><label>Details</label></div>
          </div>

          <div class="row" id="itinerary">
            <div class="col-sm-1" id="triporder">
            </div>

            <div class="col-sm-11" id="tripdetails">
              <div></div>
            </div>
          </div>

        </div>
      </div>


      
      <div class="row">
        <br>
        <div class="col-sm-6">
          <input class="btn-default" type="submit" id="addanother" value="Add another flight">
        </div>
        <div class="col-sm-6">
          <input class="btn-default" type="submit" id="addnew" value="Add new flight to trip" style="display:none">
        </div>
      </div>

      

    </div> <!--END CONTAINER-->
  </body>
</html>

<script type="text/javascript" src="control_add.js"></script>