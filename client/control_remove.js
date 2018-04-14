$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";

  //Get current itinerary
  $.ajax({
    type: "GET",
    url: base_url + "flight_display",
    dataType: 'json',
    success: function(data){
      for(var i=1; i<data.length; i++){
        $('#flightorder').append("<div class=\"row\">"+i+"</div>");
        $('#flightdetails').append("<div class=\"row\">"+data[i]+"</div>");
        var flightID = data[i].substr(0, data[i].indexOf(':'));
        $('#flightremove').append("<input type=\"submit\" id=\"removeflight\" class=\""+flightID+"\"value=\"Remove flight\">");
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      console.log("Status: " + textStatus); 
      console.log("Error: " + errorThrown); 
    } 
  });

  $(".container-fluid").on("click", "#removeflight", function(){
    var tripID = $("#trip").text();
    var flightID = $(this).attr('class');
    var postdata = "tripID="+tripID + "&flightID="+flightID;
    $.ajax({
      type: "POST",
      url: base_url + "trip_remove",
      data: postdata,
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