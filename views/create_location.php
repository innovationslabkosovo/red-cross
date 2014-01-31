<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

$page_title = "Shto Lokacion";
include '../core/init.php';
// protect_page();
$errors = array();
include 'layout/header.php';

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality ";
$municipalities = mysql_query($get_municipalities);

$get_locations_municipalities = "SELECT Location.location_id, Location.name as location_name,Location.latitude,Location.longitude,Municipality.coords as coords,Municipality.name as municipality_name
FROM Location
INNER JOIN Municipality
ON Location.municipality_id=Municipality.municipality_id";
$locations_municipalities = mysql_query($get_locations_municipalities);
?>

<title>Red Cross - Lokacionet</title>
<script type="application/javascript" src="<?php echo BASE_URL; ?>/js/form_validate.js"></script>
<script type="application/javascript" src="<?php echo BASE_URL; ?>/js/OpenLayers/OpenLayers.js"></script>
<script type="text/javascript">
    OpenLayers.ImgPath = "../img/";
</script>

<form name="create_location" id="create_location" action="<?php echo BASE_URL; ?>/core/application/create_location.php" method="POST">
    <h1>Shto nje lokacion te ri!!!</h1>

    <div id="map" class="smallmap" style="width:625px; height:350px"></div>
    <input type="hidden" id="lat" name="lat">
    <input type="hidden" id="lon" name="lon">
    <br>
    <label for="clearMarkers"></label>
    <input type="button" value="Clear Map" id="clearMarkers" class="button" />

    <br/>
    <div class="dropdown">
        <label for="select_city"></label>
        <select name="municipality" id="select_city" data-validation="required" class="dropdown-select">
            <option value="">-Zgjidhni Qytetin-</option>
            <?php
            create_options_municipality($municipalities, "municipality_id", "name", "coords");
            ?>
        </select>
    </div>
    <br/><br/>
    <label for="name"></label>
    <input type="text" name="name" id="name" class="txfform-wrapper input" value="" placeholder="Emri i Lokacionit" data-validation="required" data-validation-error-msg="Emri i lokacionit duhet plotesuar"><br/><br/>
    <input type="submit" value="Ruaj!" class="submitSmlBtn">
</form>
<div id="message"></div>


<div id="url" url="<?php echo BASE_URL; ?>/core/application/create_location.php"></div>
<table border="1" id="editable">
<tr>
    <th>Vendndodhja</th>
    <th>Komuna</th>
    <th>Modifiko</th>
</tr>
<?php
while($results = mysql_fetch_array($locations_municipalities))
{
$id=$results['location_id'];
$coords = explode(",", $results['coords']);
$location_name = $results['location_name'];
$municipality_name = $results['municipality_name'];
$latitude = $results['latitude'];
$longitude = $results['longitude'];
?>

<tr id="<?php echo $id; ?>" class="edit_tr">
<td>
    <a id="results_<?php echo $id; ?>" class="text" href="http://www.openstreetmap.org/?mlat=<?php echo $latitude; ?>&mlon=<?php echo $longitude; ?>" target="_blank"><?php echo $location_name; ?></a>
    <input name="location_name" type="text" value="<?php echo $location_name; ?>" class="editbox txfform-wrapper input" id="editbox_<?php echo $id; ?>" />
</td>

<td>
    <a href="http://www.openstreetmap.org/?mlat=<?php echo $coords[1]; ?>&mlon=<?php echo $coords[0]; ?>" target="_blank"><?php echo $municipality_name; ?></a>
    <!-- ID ne rreshtin e fundit -->
    <input type="hidden" name="id" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $id;?>">
</td>
<td>
    <input type="button" value="Ruaj" class="save submitSmlBtn" id="<?php echo $id; ?>">
    <input type="button" value="Perditeso" class="edit submitSmlBtn" id="<?php echo $id; ?>">
    <input type="button" value="Anulo" class="cancel submitSmlBtn" id="<?php echo $id; ?>" style="display:none;">
</td>
</tr>
<?php
}
?>
<?php
require_once('../core/application/Paginator.php');

$table = "Municipality";
$count_rows = mysql_query("SELECT count(*) FROM $table");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;
$result_set = mysql_query("SELECT * FROM $table $pages->limit");

while ($results = mysql_fetch_array($result_set)) {
    $id=$results['municipality_id'];
    $location_name = $results['name'];

    echo "<ul>";
        echo "<li>";
            echo $id .' '.$location_name;
        echo "</li>";
    echo "</ul>";
}
?>
</table>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/map.js"></script>
<?php include $project_root . 'views/layout/footer.php'; ?>