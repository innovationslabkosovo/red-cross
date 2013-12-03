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
<script src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.2&mkt=en-us"></script> 
<meta charset=utf-8 />
<title>Red Cross - Location</title>
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>

<style id="jsbin-css">

</style>


<form name="input" action="<?php echo BASE_URL; ?>/core/application/location.php" method="post">
<?php



$query="SELECT id, name from municipality ";
$result = mysql_query($query);

 ?>

<h1>Add new location</h1>
<table border="0">
<tr>
<td>Komuna:</td>
<td>
	<select name="komuna">
        <option value="">--Select Municipality--</option>
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


if((empty($_POST) === false) && empty($errors) === true)
{
	$komuna=$_POST["komuna"];
	$lokacioni=$_POST["name"];
	$lon=$_POST["lon"];
	$lat=$_POST["lat"];


	$query="INSERT INTO location(id, name, lat, lon, municipality_id)
		VALUES ('', '$lokacioni', '$lat', '$lon', '$komuna')";

	mysql_query($query);
	header('Location: create_location.php?success');
	exit();
}
else echo implode(", ", $errors); // shfaqja e errorave ne qofte se egzistojne	

if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}


?>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/map.js"></script>

<?php include $project_root . 'views/layout/footer.php'; ?>