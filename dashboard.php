<?php
include("auth_session.php");
?>

<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marker Map</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ilmudetil.css">
    <script src='assets/js/jquery-1.10.1.min.js'></script>       
    <script src="assets/js/bootstrap.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVakohwGB0k4X5aEr0CV_GVvckcQcfqPA&callback=initMap"></script>
    
    <script>
        
    var marker;
      function initialize() {
        var infoWindow = new google.maps.InfoWindow;
        
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
 
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions)
        var bounds = new google.maps.LatLngBounds();

        <?php
            $query = mysqli_query($con,"select * from points");
            while ($data = mysqli_fetch_array($query))
            {
                $nama = $data['description'];
                $lat = $data['lat'];
                $lon = $data['longitude'];
                
                echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
            }
          ?>
          
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }
        
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    
    </script>

<style>
body {
    background-image: url('bg.jpg');
}

#map-canvas{
    width: 200vh ; 
    height: 80vh;
    position: absolute; 
    left:6vh;
    border: 1vh solid black;
}

.text {
    font-size: 4vh;
    text-align: center;
    font-weight:bold;
}

.logout{
  font-size: 3vh;
  color: black;
  font-weight: bold;
  position: absolute;
  top: 0%;
  left: 92%;
  padding: 2vh;
  text-align: justify;
        }
.back{
  font-size: 3vh;
  color: black;
  font-weight: bold;
  position: absolute;
  top: 0%;
  left: 1%;
  padding: 2vh;
  text-align: justify;
  
}
</style>
    
</head>
<body onload="initialize()">
  <div class="text">
    <p>Bine ai venit, <?php echo $_SESSION['username']; ?>!</p>
  </div>
  <a class="logout" href="logout.php">
    Log out</a>
  <a class="back" href="cv.html">
     Back</a>

  <div id="map-canvas"></div>
</body>
</html>