<!DOCTYPE html>
<html>
  <?php 
    require 'head.html';
  ?>
  <body>
    <div class="container-fluid" style="margin:2rem">

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
            <select class="form-control" id="users">
              <option></option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6"><input class="btn-default" type="submit" id="new" value="Make a new trip"></div>
        <div class="col-sm-6"><input class="btn-default" type="submit" id="manage" value="Manage current trips"></div>
      </div>


    </div> <!--END CONTAINER-->
  </body>
</html>


