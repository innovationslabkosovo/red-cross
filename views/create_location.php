<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

$page_title = "Shto Lokacion";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality ";
$municipalities = mysql_query($get_municipalities);

$get_locations_municipalities = "SELECT Location.name as location_name,Location.latitude,Location.longitude,Municipality.coords as coords,Municipality.name as municipality_name
FROM Location
INNER JOIN Municipality
ON Location.municipality_id=Municipality.municipality_id";
$locations_municipalities = mysql_query($get_locations_municipalities);
?>

<script type="text/javascript" src="http://openlayers.org/dev/OpenLayers.js"></script>
<meta charset=utf-8/>
<title>Red Cross - Lokacionet</title>
<script type="application/javascript" src="<?php echo BASE_URL; ?>/js/form_validate.js"></script>

<form name="create_location" id="create_location" action="<?php echo BASE_URL; ?>/core/application/create_location.php" method="POST">
    <h1>Shto nje lokacion te ri</h1>

    <div id="map" class="smallmap" style="width:625px; height:350px"></div>
    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lon" name="lon">
    <label for="clearMarkers"></label>
    <input type="button" value="Clear Map" id="clearMarkers"/>

    <br/>
    <label for="select_city"></label>
    <select name="municipality" id="select_city" data-validation="required">
        <option value="">-Zgjidhni Qytetin-</option>
        <?php
        create_options_municipality($municipalities, "municipality_id", "name", "coords");
        ?>
    </select><br/><br/>
    <label for="name"></label>
    <input type="text" name="name" id="name" value="" placeholder="Emri i Lokacionit" data-validation="required"
    data-validation-error-msg="Emri i lokacionit duhet plotesuar"><br/><br/>
    <input type="submit" value="Ruaj!">
</form>
<div id="message"></div>
<table border="1">
  <tr>
    <th>Location Name</th>
    <th>Municipality Name</th>
</tr>
<?php
while($results = mysql_fetch_array($locations_municipalities))
{
    $coords = explode(",", $results['coords']);
    $location_name = $results['location_name'];
    $municipality_name = $results['municipality_name'];
    $latitude = $results['latitude'];
    $longitude = $results['longitude'];
    ?>
    <tr>
        <td>
            <a href="http://www.openstreetmap.org/?mlat=<?php echo $latitude; ?>&mlon=<?php echo $longitude; ?>" target="_blank"><?php echo $location_name; ?></a>
        </td>
        <td>
            <a href="http://www.openstreetmap.org/?mlat=<?php echo $coords[1]; ?>&mlon=<?php echo $coords[0]; ?>" target="_blank"><?php echo $municipality_name; ?></a>
        </td>
    </tr>
    <?php }; ?>
</table>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/map.js"></script>
<script type="text/javascript">
    $.validate({
            validateOnBlur : false, // disable validation when input looses focus
            //errorMessagePosition : 'top', // Instead of 'element' which is default;
            //scrollToTopOnError : false, // Set this property to true if you have a long form
            errorPlacement: function(error, element) {
                error.appendTo($("#message"));
            }
        });
</script>

    <?php include $project_root . 'views/layout/footer.php'; ?>