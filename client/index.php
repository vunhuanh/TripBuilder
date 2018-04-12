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
        <div class="col-sm-3">User:</div>
        <div class="col-sm-9">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">None
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#">admin</a></li>
              <li><a href="#">test1</a></li>
              <li><a href="#">test2</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- FLIGHT TYPE -->
      <div class="row">
        <div class="col-sm-3">Type of flight:</div>
        <div class="col-sm-3">
          <input type="radio" value="one">One-way
        </div>
        <div class="col-sm-3">
          <input type="radio" value="round">Roundtrip
        </div>
        <div class="col-sm-3">
          <input type="radio" value="multi">Multi-city
        </div>
      </div>

      <!-- FLIGHT SELECTION -->
      <div class="row">
        <div class="col-sm-3">Origin:</div>
        <div class="col-sm-3 dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Airport
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">admin</a></li>
            <li><a href="#">test1</a></li>
            <li><a href="#">test2</a></li>
          </ul>
        </div>

        <div class="col-sm-3">Destination:</div>
        <div class="col-sm-3 dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Airport
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">admin</a></li>
            <li><a href="#">test1</a></li>
            <li><a href="#">test2</a></li>
          </ul>
        </div>
      </div>
      
      <div class="row"><button>Add flight to trip</button></div>


    </div> <!--END CONTAINER-->


  </body>
</html>
