var lat = 42.6258687;
var lon = 20.8911131;
var zoom = 9;

var fromProjection = new OpenLayers.Projection("EPSG:900913"); // Transform from Spherical Mercator Projection
var toProjection = new OpenLayers.Projection("EPSG:4326"); // To from WGS 1984
var position = new OpenLayers.LonLat(lon, lat).transform( toProjection, fromProjection);

map = new OpenLayers.Map("map");
var mapnik = new OpenLayers.Layer.OSM();
map.addLayer(mapnik);

var markers = new OpenLayers.Layer.Markers("Markers");
map.addLayer(markers);
markers.addMarker(new OpenLayers.Marker(position));

map.setCenter(position, zoom);

map.events.register("click", map, function(e) {
    var point = map.getLonLatFromPixel(e.xy);

    markers.clearMarkers();
    markers.addMarker(new OpenLayers.Marker(point));

    point.transform(fromProjection, toProjection);

    var coords = {latitude: point.lat, longitude: point.lon};

    OpenLayers.Util.getElement("lon").value = coords.longitude;
    OpenLayers.Util.getElement("lat").value = coords.latitude;

});