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
    var postdata = "user="+user + "&ftype="+ftype + "&src="+src + "&dst="+dst + "&addnew=0";

    $.ajax({
      type: "POST",
      url: base_url + "addflight",
      data: postdata,
      dataType: 'json',
      success: function(data){
        console.log(data);
        $('#itinerary').empty();
        alert("Created new " + ftype + " trip for " + user);
        for(var i=0; i<data.length; i++){
          $('#details').append("<div class=\"row\">"+data[i]+"</div>");
        }
        if(ftype == "Multi-city"){
          $('#addnew').css('display','block');
        }
      }
    }); 
  });

  //Add new trip to multi-city
  $("#addnew").click(function(){
    //Add new flight selection fields
    $('#field').clone().appendTo('#fselect');

    //Get flight info
    var user = $("#user").text();
    var ftype = $("#ftype option:selected").text();
    var src = $("#src option:selected").text();
    var dst = $("#dst option:selected").text();
    var postdata = "user="+user + "&ftype="+ftype + "&src="+src + "&dst="+dst + "&addnew=1";

    $.ajax({
      type: "POST",
      url: base_url + "addflight",
      data: postdata,
      dataType: 'json',
      success: function(data){
        alert("Added new flight to " + ftype + " trip for " + user);
        for(var i=0; i<data.length; i++){
          $('#details').append("<div class=\"row\">"+data[i]+"</div>");
        }
      }
    }); 
  });

});