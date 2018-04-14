$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";

  //Get current itinerary
  $.ajax({
    type: "GET",
    url: base_url + "trip_display",
    dataType: 'json',
    success: function(data){
      for(var i=1; i<data.length; i++){
        $('#triporder').append("<div class=\"row\">"+i+"</div>");
        $('#tripdetails').append("<div class=\"row\">"+data[i]+"</div>");
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
      console.log("Status: " + textStatus); 
      console.log("Error: " + errorThrown); 
    } 
  });

  $("#addanother").click(function(){
    //Get flight info
    var src = $("#src option:selected").text();
    var dst = $("#dst option:selected").text();
    var postdata = "src="+src + "&dst="+dst;

    $.ajax({
      type: "POST",
      url: base_url + "trip_add",
      data: postdata,
      dataType: 'json',
      success: function(data){
        if(data == "same"){
          alert("Origin and destination airports are the same");
        }
        else if(data == "noflight"){
          alert("There are no flights that match this query");
        }
        else{
          $('#triporder').empty();
          $('#tripdetails').empty();
          alert("Added new flight to trip");
          console.log(data);
          for(var i=1; i<data.length; i++){
            $('#triporder').append("<div class=\"row\">"+i+"</div>");
            $('#tripdetails').append("<div class=\"row\">"+data[i]+"</div>");
          }
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); 
        console.log("Error: " + errorThrown); 
      } 
    }); 
  });
});