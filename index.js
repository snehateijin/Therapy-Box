function weather() {
  var location = document.getElementById("location");
  var apiKey = "d0a10211ea3d36b0a6423a104782130e";
  var url = " http://api.openweathermap.org/data/2.5/weather";

  navigator.geolocation.getCurrentPosition(success, error);

  function success(position) {

    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
       $.getJSON("http://api.openweathermap.org/data/2.5/weather?lat="+latitude+"&lon="+longitude+"&units=metric&APPID="+apiKey,function(json){
           let temperature = typeof json.main.temp !='undefined' ? json.main.temp + ' degrees' : '';
           let place_name = typeof json.name !='undefined' ? json.name : ''; 
           let icon_html =   typeof json.weather[0].icon !='undefined' ? '<img src="http://openweathermap.org/img/w/'+json.weather[0].icon+'.png">' : ''; 
           console.log(json.weather);
           $('#weather_loader_div').hide();
           $('#weather_icon').html(icon_html);
           $('#weather_temp').html(temperature);
           $('#weather_place').html(place_name);
         });
//      let json = '{"coord":{"lon":76.36,"lat":10.01},"weather":[{"id":200,"main":"Thunderstorm","description":"thunderstorm with light rain","icon":"11d"}],"base":"stations","main":{"temp":26,"pressure":1007,"humidity":94,"temp_min":26,"temp_max":26},"visibility":3500,"wind":{"speed":3.1,"deg":230},"clouds":{"all":90},"dt":1538654400,"sys":{"type":1,"id":7827,"message":0.0047,"country":"IN","sunrise":1538613782,"sunset":1538656994},"id":2643743,"name":"London","cod":200}';
//       json = JSON.parse(json);
//          let temperature = typeof json.main.temp !='undefined' ? json.main.temp + ' degrees' : '';
//          let place_name = typeof json.name !='undefined' ? json.name : ''; 
//          let icon_html =   typeof json.weather[0].icon !='undefined' ? '<img src="http://openweathermap.org/img/w/'+json.weather[0].icon+'.png">' : ''; console.log(json.weather);
//           $('#weather_loader_div').hide();
//          $('#weather_icon').html(icon_html);
//          $('#weather_temp').html(temperature);
//          $('#weather_place').html(place_name);
  }

  function error() {
   $('#weather_place').html("Unable to retrieve your location");
  }
 $('#weather_place').html("Locating...");
}


$(document).ready(function(){
  getClothData();
  weather();
});

function getClothData (){
  $.ajax({
    url : 'getclothdata.php',
    type : 'GET',
    success : function(data) { 
      $('#cloth_loader_div').hide();
      let chartData =    JSON.parse(data);    
      let chart = anychart.pie();     
      chart.data(chartData);
      chart.container('container');
      chart.labels().position("outside");
      chart.draw();
      $('.anychart-credits').remove();
    },
    error : function(request,error)
    {
      console.log("Request: "+JSON.stringify(error));
    }
});
}