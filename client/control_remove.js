$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";
  var tripID = $("#trip").text();

  //Get current itinerary
  $.ajax({
    type: "GET",
    url: base_url + "trip_display/" + tripID,
    dataType: 'json',
    success: function(data){
      for(var i=1; i<data.length; i++){
        $('#flightorder').append("<div class=\"row\">"+i+"</div>");
        $('#flightdetails').append("<div class=\"row\">"+data[i]+"</div>");
        var flightID = data[i].substr(0, data[i].indexOf(':'));
        $('#flightremove').append("<input type=\"submit\" class=\"btn-default removeflight\" id=\""+flightID+"\"value=\"Remove flight\">");
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      console.log("Status: " + textStatus); 
      console.log("Error: " + errorThrown); 
    } 
  });

  //Remove flight from trip
  $(".container-fluid").on("click", ".removeflight", function(){
    var tripID = $("#trip").text();
    var flightID = $(this).attr('id');
    var postdata = "/"+tripID + "/"+flightID;
    $.ajax({
      type: "DELETE",
      url: base_url + "trip_remove" + postdata,
      //data: postdata,
      success: function(data){
        location.reload();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); 
        console.log("Error: " + errorThrown); 
      } 
    });
  });
});