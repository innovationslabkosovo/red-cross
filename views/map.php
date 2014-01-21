<?php
include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$get_course_locations = "SELECT Class.name, Location.name as location, latitude, longitude FROM Class inner join Location on Class.location_id = Location.location_id";
$locations = mysql_query($get_course_locations);

while ($current_location = mysql_fetch_assoc($locations)){
    $location_data[] = array($current_location['name']." ne ".$current_location['location'], $current_location['latitude'], $current_location['longitude']);

}
$location_to_json = json_encode($location_data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Harta e Kurseve nga Kryqi i Kuq</title>

	<link rel="stylesheet" href="../css/leaflet.css" />
	<script src="../js/leaflet.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/map.css" />
	<script src="../js/markercluster-src.js"></script>
</head>
<body>

	<div id="map"></div>
	<script type="text/javascript">

        function SetMap()
        {

            var cloudmadeUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                cloudmadeAttribution = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                cloudmade = L.tileLayer(cloudmadeUrl, {maxZoom: 17, attribution: cloudmadeAttribution}),
                latlng = L.latLng(42.59432909213417, 20.88294982397517);

            var map = L.map('map', {center: latlng, zoom: 9, layers: [cloudmade]});

            var markers = L.markerClusterGroup();
            var addressPoints = <?php print_r($location_to_json); ?>;
            for (var i = 0; i < addressPoints.length; i++) {
                var a = addressPoints[i];
                var title = a[0];
                var marker = L.marker(new L.LatLng(a[1], a[2]), { title: title });
                marker.bindPopup(title);
                markers.addLayer(marker);
            }

            map.addLayer(markers);
        }
	</script>
    <body onload="SetMap()">
</body>
<?php
include $project_root . 'views/layout/footer.php';
?>
</html>

