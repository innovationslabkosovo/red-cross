<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

$page_title = "Shto lokacion";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$get_municipalities = "SELECT municipality_id, name FROM Municipality ";
$municipalities = mysql_query($get_municipalities);
?>

<script type="text/javascript" src="http://openlayers.org/dev/OpenLayers.js"></script>
<meta charset=utf-8 />
<title>Red Cross - Location</title>
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>

<style id="jsbin-css">

</style>


<form name="input" action="<?php echo BASE_URL; ?>/core/application/create_location.php" method="post">
<h1>Add new location</h1>
<table border="0">
<tr>
<td>Komuna:</td>
<td>
	<select name="komuna">
        <option value="">--Zgjedh Komunen--</option>
        <?php
            create_options($municipalities, "municipality_id", "name");
        ?>
	</select>
</td>
</tr>
<tr>
<td>Lokacioni: </td><td><input type="text" name="name"></td></tr>

<tr colspan="2">
<div id="map" class="smallmap" style="width:625px; height:350px"></div>
</tr>
<tr><td><input type="hidden" id="lat" name="lat"></td></tr>
<tr><td><input type="hidden" id="lon" name="lon"></td></tr>
<tr><td>&nbsp;</td><td><input type ="submit" value="Ruaj!"></td></tr>

</table>
</form>


<?php
if (empty ($_POST) == false)	// nese eshte dergu forma
{
	if(empty ($_POST['komuna']))
	{
		$errors[] = "Ju lutemi plotesoni komunen";
	}
	if(empty ($_POST['name']))
	{
		$errors[] = "Ju lutemi plotesoni lokacionin";
	}
	if(empty($_POST['lon']))
	{
		$errors[] = "Ju lutemi plotesoni longituden";
	}
	if(empty($_POST['lat']))
	{
		$errors[] = "Ju lutemi plotesoni latituden";
	}
}

if (empty($_POST) == false) {
    if (isset($_GET['message']) && isset($_GET['object'])) {
        echo $display_messages[$_GET['object']][$_GET['message']];
    }
}


?>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/map.js"></script>

<?php include $project_root . 'views/layout/footer.php'; ?>