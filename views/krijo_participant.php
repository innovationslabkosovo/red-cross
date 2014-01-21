<?php
	$page_title = "Krijo_participant";
	include("core/init.php");
	protect_page();
	include("inc/overall/header.php");	
	$errors = array();
?>

<form action="" method="post">
<h4>Gender: </h4> 
<?php
	$gender = "gender";
?>
<label>Male</label><input type="radio" name="<?php echo $gender; ?>" value="M">
<label>Female</label><input type="radio" name="<?php echo $gender; ?>" value="F">

<h4>Zgjedh klasen: </h4>

<?php
	 $query = mysql_query("SELECT * FROM `class`");
	 $klasa = "klasa";	
?>

<select name="<?php echo $klasa; ?>">
<?php
while($record = mysql_fetch_array($query))
{
	echo '<option value ="' . $record['id'] . '">' . $record['id'] . '</option>';	// renditja e id se klases ne dropdown
}
?>
</select>

<input type="submit" id="Shto Participant" value="Shto Participant">

</form>

<?php
if (empty ($_POST) == false)	// nese eshte dergu forma
{
if(empty ($_POST['gender']))
{
	$errors[] = "Ju lutemi mbushni te dhenat...";	
}
}

if(empty ($_POST['gender']) == false && empty ($errors) == true) // nese e kemi mbush gjinine dhe nuk ka errora
{
	//inserto ne db
	$k = $_POST['klasa'];	//marrim te dhenen nga dropdown
	$g = $_POST['gender'];	// marrim te dhenen nga radio buttoni
	
	$inserto = mysql_query("INSERT INTO participant(gender, class_id) VALUES('$g', '$k')");
	echo "Participanti u shtua me sukses...";
}
else echo implode("", $errors);	

	
?>

<?php include("inc/overall/footer.php"); ?>