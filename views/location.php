<?php 
$page_title = "Shto lokacion";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';?>

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


<form name="input" action="" method="post">
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
	<option value=''>-Select-</option>
<?php
while($row = mysql_fetch_array($result))
  {
	echo '<option value='.$row['id'].' >'.$row['name'].' </option>';
}
 ?>
		
	</select>
</td>
</tr>
<tr>
<td>Lokacioni: </td><td><input type="text" name="name"></td></tr>

<tr colspan="2">
<div id="map" class="smallmap" style="width:400px; height:300px"></div>
</tr>
<tr><td>Latitude: </td><td><p id="lat"></td></tr>
<tr><td>Longitude: </td><td><p id="lon" ></td></tr>
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
	header('Location: location.php?success');
	exit();
}
else echo implode(", ", $errors); // shfaqja e errorave ne qofte se egzistojne	
	
if(isset($_GET['success']) && empty($_GET['success']))	// nese eshte regjistruar shfaq notifikimin
{
		echo "Te dhenat u ruajten me sukses ne databaze";
}


?>

<script type="text/javascript" src="<?php //include $project_root . 'js/map.js'; ?>"></script>

<?php include $project_root . 'views/layout/footer.php'; ?>