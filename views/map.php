<!DOCTYPE html>
<html>
<head>
	<title>Harta e Kurseve nga Kryqi i Kuq</title>

	<link rel="stylesheet" href="../css/leaflet.css" />
	<script src="../js/leaflet.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/map.css" />
	<script src="../js/markercluster-src.js"></script>
	<script src="http://leaflet.github.io/Leaflet.markercluster/example/realworld.388.js"></script>

<?php
include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';
?>

</head>
<body>

	<div id="map"></div>
	<span>Mouse over a cluster to see the bounds of its children and click a cluster to zoom to those bounds</span>
	<script type="text/javascript">

		var cloudmadeUrl = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png',
			cloudmadeAttribution = 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2011 CloudMade, Points &copy 2012 LINZ',
			cloudmade = L.tileLayer(cloudmadeUrl, {maxZoom: 17, attribution: cloudmadeAttribution}),
			latlng = L.latLng(-37.82, 175.24);

		var map = L.map('map', {center: latlng, zoom: 13, layers: [cloudmade]});

		var markers = L.markerClusterGroup();
		
		for (var i = 0; i < addressPoints.length; i++) {
			var a = addressPoints[i];
			var title = a[2];
			var marker = L.marker(new L.LatLng(a[0], a[1]), { title: title });
			marker.bindPopup(title);
			markers.addLayer(marker);
		}

		map.addLayer(markers);

	</script>
</body>
<?php
include $project_root . 'views/layout/footer.php';
?>
</html>

