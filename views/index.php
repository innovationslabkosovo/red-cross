<?php
$page_title = "Ballina";
include '../core/init.php';
include 'layout/header.php';

$year = $_GET["year"];
if ($year == ""){
    $year = date("Y");;
}
$year1 = $year."-01-01";
$year2 = $year."-12-31";
$get_course_locations = "SELECT Class.name, Location.name as location, latitude, longitude FROM Class inner join Location on Class.location_id = Location.location_id where date_to > '$year1' AND date_to < '$year2'";
$locations = mysql_query($get_course_locations);

while ($current_location = mysql_fetch_assoc($locations)){
    $location_data[] = array($current_location['name'], $current_location['latitude'], $current_location['longitude']);

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
<h2>Kurset nga Viti: <?php print_r($year); ?> </h2>
<div class="dropdown" style="margin-bottom: 20px;">
<select name="forma" class="dropdown-select" onchange="location = this.options[this.selectedIndex].value;">
    <option value="">Ndrysho Vitin</option>
    <option value="public_map.php?year=2013">2013</option>
    <option value="public_map.php?year=2014">2014</option>
    <option value="public_map.php?year=2015">2015</option>
    <option value="public_map.php?year=2016">2016</option>
</select>
</div>



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




<?php include 'layout/footer.php'; ?>
