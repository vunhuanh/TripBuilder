<!DOCTYPE html>
<html>
  <?php 
    require 'head.html';
    session_start();
    $_SESSION['user'] = $_SERVER['QUERY_STRING'];
  ?>
  <body>
    <div class="container-fluid" style="margin:2rem">

      <div class="row">
        <div class="col-sm-3">
          <input class="btn-default" type="submit" id="home" value="Home">
        </div>
      </div>

      <div class="row" style="display:none">
        <div class="col-sm-1">User:</div>
        <div class="col-sm-1" id="user"><?php echo $_SESSION['user'];?></div>
      </div>

      <!-- FLIGHT TYPE -->
      <div class="row">
        <div class="col-sm-2">
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
            <div class="col-sm-3">Itinerary</div>
          </div>
          <div class="row">
            <div class="col-sm-2"><label>Order</label></div>
            <div class="col-sm-10"><label>Details</label></div>
          </div>

          <div class="row" id="itinerary">
            <div class="col-sm-2" id="order">
            </div>

            <div class="col-sm-10" id="details">
            </div>
          </div>

        </div>
      </div>


      
      <div class="row">
        <br>
        <div class="col-sm-6">
          <input class="btn-default" type="submit" id="make" value="Make trip">
        </div>
        <div class="col-sm-6">
          <input class="btn-default" type="submit" id="addnew" value="Add new flight to trip" style="display:none">
        </div>
      </div>

      

    </div> <!--END CONTAINER-->
  </body>
</html>