var start = new Array();
var end = new Array();
//初始化地圖
function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: 25.117609, lng: 121.520442}          
        });
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);    
        });                  
}
//取得所有資料且計算最短路徑並將結果呈現出來
function calculateAndDisplayRoute(directionsService, directionsDisplay) {		
        var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }

        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          waypoints: waypts,		    
		  optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');	
            summaryPanel.innerHTML = '';	
			      var id,i;
            // For each route, display summary information.
            for (i = 0; i < route.legs.length; i++) {
				var routeSegment = i + 1;		
				start[i] = route.legs[i].start_address;
				end[i] = route.legs[i].end_address;
				if(routeSegment % 2 != 0)
					summaryPanel.innerHTML +="<div style=\"background-Color : lightblue\"><br> <b>Route Segment: " + routeSegment + "</b><br><a href=\"#popupMap\" class = \"ads\" id = " + i + " >" + start[i] + '<br>to<br>' + end[i] + "</a><br>" + route.legs[i].distance.text + "<br><br></div>";				
				else
					summaryPanel.innerHTML +="<div style=\"background-Color : white\"><br> <b>Route Segment: " + routeSegment + "</b><br><a href=\"#popupMap\" class = \"ads\" id = " + i + " >" + start[i] + '<br>to<br>' + end[i] + "</a><br>" + route.legs[i].distance.text + "<br><br></div>";
				setCookie("start"+i,start[i],0.125);
				setCookie("end"+i,end[i],0.125);				
            }	
			setCookie("route",i,0.125);	
				
			$(".ads").click(function () {				
				var ads = $(this).attr('id');			  
				//alert(ads);			 
				setCookie("ads",ads,0.125);
			}); 
          } else {
				window.alert('Directions request failed due to ' + status);
          }			
        });			
}
function setCookie(cname,cvalue,exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=;";
}