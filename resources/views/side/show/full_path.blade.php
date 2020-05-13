  <div>
    <input type="button" id="button" class="btn btn-warning" value="更新" onclick="update();">
    <button type="button" id="left" onclick="decrease();">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    </button>
    <label>Route Segment: </label><label id="route">先按更新</label>
    <button type="button" id="right" onclick="increase();">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    </button>
  </div>
  <div id="floating-panel">
      <strong>Start:</strong><br>
      <select id="start">
      </select>
      <br>
      <strong>End:&nbsp;</strong><br>
      <select id="end">             
      </select>
  </div>    
    <div id="map"></div>
    <div id="right-panel"></div>
    <div align="left" style="font-size:13px;"><b>Copyright © 2017-2018 | 黃庭緯,吳珮如</b></div>   
    <script>
      function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));

        //var control = document.getElementById('floating-panel');
        //control.style.display = 'block';
        //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('button').addEventListener('click',onChangeHandler);
        document.getElementById('left').addEventListener('click', onChangeHandler);
        document.getElementById('right').addEventListener('click',onChangeHandler);        
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var start = document.getElementById('start').value;
        var end = document.getElementById('end').value;
        directionsService.route({
          origin: start,
          destination: end,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }      
    </script>