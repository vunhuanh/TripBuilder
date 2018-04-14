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

      <div class="row">
        <div class="col-sm-1">User:</div>
        <div class="col-sm-1" id="user"><?php echo $_SESSION['user'];?></div>
      </div>
      
      <div class="row">
        <div class="col-sm-1">
          <label>TripID</label>
        </div>
        <div class="col-sm-2">
          <label>Type</label>
        </div>
        <div class="col-sm-9">
          <label>Action</label>
        </div>
      </div>

      
    </div> <!--END CONTAINER-->
  </body>
</html>

<script type="text/javascript" src="control_manage.js"></script>