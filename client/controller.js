$(document).ready(function(){
  //Redirect to API
  var base_url="http://localhost/tripbuilder/api/";

  //Go back to home page
  $("#home").click(function(){
    $.ajax({
      type: "POST",
      url: base_url + "newsession",
      data: {},
      success: function(data){
        window.location.href = "/tripbuilder/client/";
      }
    }); 
  });

  //Make new trip for user
  $("#new").click(function(){
    var user = $("#user option:selected").text();
    var url = "/tripbuilder/client/newtrip.php?"+user;
    window.location.href = url;
  });

  //Manage user's upcoming trips
  $("#manage").click(function(){
    var user = $("#user option:selected").text();
    var url = "/tripbuilder/client/managetrips.php?"+user;
    window.location.href = url;
  });

  //Get airport info
  $.ajax({
    type: "GET",
    url: base_url + "getairports",
    dataType: 'json',
    success: function(data){
      for(var i=0; i<data.length; i++){
        var option = "<option>"+data[i][0]+"</option>";
        $('#src').append(option);
        $('#dst').append(option);
      }
    }
  });

  //Make new trip
  $("#make").click(function(){
    //Get flight info
    var user = $("#user").text();
    var ftype = $("#ftype option:selected").text();
    var src = $("#src option:selected").text();
    var dst = $("#dst option:selected").text();
    var order = $("#order").children().length;
    var postdata = "user="+user + "&ftype="+ftype + "&src="+src + "&dst="+dst;

    $.ajax({
      type: "POST",
      url: base_url + "newtrip",
      data: postdata,
      dataType: 'json',
      success: function(data){
        alert("Created new " + ftype + " trip for " + user);
        $('#order').append("<div class=\"row\" id=\"o1\">"+data[0]+"</div>");
        for(var i=1; i<data.length; i++){
          $('#details').append("<div class=\"row\">"+data[i]+"</div>");
        }
        if(ftype == "Multi-city"){
          $('#addnew').css('display','block');
        }
        else{
          $('#make').hide();
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        console.log("Status: " + textStatus); 
        console.log("Error: " + errorThrown); 
      } 
    }); 
  });

  //Add new trip to multi-city
  $("#addnew").click(function(){
    var tripID = $("#o1").html();
    var url = "/tripbuilder/client/addtrip.php?"+tripID;
    window.location.href = url;
  });

});