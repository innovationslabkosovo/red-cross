/*global $, jQuery*/
var lat = 42.6258687;
var lon = 20.8911131;
var zoom = 9;
var map;

var fromProjection = new OpenLayers.Projection("EPSG:900913"); // Transform from Spherical Mercator Projection
var toProjection = new OpenLayers.Projection("EPSG:4326"); // To from WGS 1984
var position = new OpenLayers.LonLat(lon, lat).transform(toProjection, fromProjection);

map = new OpenLayers.Map("map");
map.addControl(new OpenLayers.Control.LayerSwitcher());
var mapnik = new OpenLayers.Layer.OSM();
map.addLayer(mapnik);

var markers = new OpenLayers.Layer.Markers("Markers");
map.addLayer(markers);
markers.addMarker(new OpenLayers.Marker(position));
map.setCenter(position, zoom);

map.events.register("click", map, function (e) {
    "use strict";
    var point, transformedMarker;
    point = map.getLonLatFromPixel(e.xy);
    markers.clearMarkers(); // Clear markers first
    markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(point.lon, point.lat))); // New Location
    transformedMarker = point.transform(fromProjection, toProjection); // Transform marker
    OpenLayers.Util.getElement("lon").value = transformedMarker.lon.toFixed(6); // Update hidden values
    OpenLayers.Util.getElement("lat").value = transformedMarker.lat.toFixed(6); // Update hidden values
});

(function () {
    "use strict";
    $("#select_city").change(function () {
        var LonLatFromID = $(this).children(":selected").attr("id").split(","), marker;
        map.addLayer(markers);
        if (LonLatFromID[0] && LonLatFromID[1]) {
            markers.clearMarkers(); // Clear markers first
            marker = new OpenLayers.LonLat(LonLatFromID[0], LonLatFromID[1]).transform(toProjection, fromProjection); // Transform marker
            map.setCenter(marker, 13); // Set center
            markers.addMarker(new OpenLayers.Marker(marker)); // Add marker with latitude, longitude
            OpenLayers.Util.getElement("lat").value = LonLatFromID[1]; // Update hidden fields with latitude
            OpenLayers.Util.getElement("lon").value = LonLatFromID[0]; // Update hidden fields with longitude
        }
    });
}());

(function clearMarkers() {
    "use strict";
    $("#clearMarkers").on("click", function () {
        markers.clearMarkers();
        $("#lat, #lon").val("");
    });
}());