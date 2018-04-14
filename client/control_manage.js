$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";
  var user = $('#user').text();

  //Get current itinerary
  $.ajax({
    type: "GET",
    url: base_url + "usertrips/" + user,
    dataType: 'json',
    success: function(data){
      for(var i=0; i<data.length; i++){
        var toappend;
        if(data[i][1] == "Multi-city"){
          toappend = "<div class=\"row\"><div class=\"col-sm-1\">"+data[i][0]+"</div><div class=\"col-sm-2\">"+data[i][1]+"</div><div class=\"col-sm-2\"><input type=\"submit\" class=\"btn-default addflight\" id=\""+data[i][0]+"\"value=\"Add a flight\"></div><div class=\"col-sm-2\"><input type=\"submit\" class=\"btn-default removeflight\" id=\""+data[i][0]+"\"value=\"Remove a flight\"></div><div class=\"col-sm-2\"><input type=\"submit\" class=\"btn-default deletetrip\" id=\""+data[i][0]+"\"value=\"Delete trip\"></div></div>";
        }
        else{
          toappend = "<div class=\"row\"><div class=\"col-sm-1\">"+data[i][0]+"</div><div class=\"col-sm-2\">"+data[i][1]+"</div><div class=\"col-sm-2\"></div><div class=\"col-sm-2\"></div><div class=\"col-sm-2\"><input type=\"submit\" class=\"btn-default deletetrip\" id=\""+data[i][0]+"\"value=\"Delete trip\"></div></div>";
        }
        $(".container-fluid").append(toappend);
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      console.log("Status: " + textStatus); 
      console.log("Error: " + errorThrown); 
    } 
  });

  $(".container-fluid").on("click", ".addflight", function(){
    var tripID = $(this).attr('id');
    var redirect = "/tripbuilder/client/display_add.php?"+tripID;
    window.location.href = redirect;
  });

  $(".container-fluid").on("click", ".removeflight", function(){
    var tripID = $(this).attr('id');
    var redirect = "/tripbuilder/client/display_remove.php?"+tripID;
    window.location.href = redirect;
  });

  $(".container-fluid").on("click", ".deletetrip", function(){
    var tripID = $(this).attr('id');
    $.ajax({
      type: "DELETE",
      url: base_url + "trip_delete/" + tripID,
      success: function(data){
        location.reload();
      }
    }); 
  });
});