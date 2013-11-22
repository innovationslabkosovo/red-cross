/**
 * Created by visar on 11/18/13.
 */
var map, vectors, controls;
map = new OpenLayers.Map('map');
var wms = new OpenLayers.Layer.WMS( "OpenLayers WMS",
    "http://vmap0.tiles.osgeo.org/wms/vmap0?", {layers: 'basic'});

vectors = new OpenLayers.Layer.Vector("Vector Layer");

map.addLayers([wms, vectors]);
map.addControl(new OpenLayers.Control.LayerSwitcher());
map.addControl(new OpenLayers.Control.MousePosition());
//map.addControl(new OpenLayers.Control.Click());

map.events.register("click", map, function(e) {
    var position = map.getLonLatFromPixel(e.xy);

    OpenLayers.Util.getElement("lon").innerHTML = "<input value=\" "+ position.lon.toFixed(10) + "\" type=\"text\" name=\"lon\">";
    OpenLayers.Util.getElement("lat").innerHTML = "<input value=\" "+  position.lat.toFixed(10) + "\" type=\"text\" name=\"lat\">";
});


/*controls = {
 point: new OpenLayers.Control.DrawFeature(vectors,
 OpenLayers.Handler.Point),

 line: new OpenLayers.Control.DrawFeature(vectors,
 OpenLayers.Handler.Path),
 polygon: new OpenLayers.Control.DrawFeature(vectors,
 OpenLayers.Handler.Polygon),
 drag: new OpenLayers.Control.DragFeature(vectors)
 };*/

map.setCenter(new OpenLayers.LonLat(21, 42.5), 8);

