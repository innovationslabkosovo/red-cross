<?php
	$page_title = "Krijo_test";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>
<html>
<head>
  <script type="text/javascript" src="<?php echo BASE_URL  ?>/js/shto-fshi-fusha-script.js"></script>
<form action="" method="post" id = "form1">

<label>Emri i testit: </label><input type="text" name="emri_testit">

<!-- <input type="checkbox" name="vehicle" value="Bike">I have a bike<br> -->

<?php
	$query = mysql_query("SELECT * FROM `Question`");
	
	echo "<br><br>";
	
	while ($row = mysql_fetch_array($query))

	{
		echo '<input type="checkbox" name="chbox[]" value="' . $row['question_id'] . '">' . $row['question_id'] . " - " . $row['description'] . "<br>";
	}	
?>

<?php


	if(empty($_POST['emri_testit']) == false)	// nese e kemi plotsu emrin e testit 
	{
		$emri_testit = $_POST['emri_testit']; // ruaj emrin e testit
		mysql_query("INSERT INTO `Test` (`name`) VALUES ('$emri_testit')"); //inserto emrin e testit ne tabelen test
		$test_id = mysql_insert_id(); //merr id e fundit te insertuar
	}

	
?>

<br>

<input type="submit" id="krijo_test" value="Krijo test">

</form>

<?php
		
	if (empty($_POST) == false)	// nese ka dergu diqka forma
	{
		if (!empty($_POST['chbox']) && (empty($_POST['emri_testit']) == false))	// nese i kena plotsu chbox edhe emrin
		{
			foreach($_POST['chbox'] as $key => $value) // marrim vleren e arrayt (id e pytjes)
			{
				
				mysql_query("INSERT INTO `TestQuestion` (`test_id`, `question_id`) VALUES ('$test_id', '$value')");
				
			}
			echo "Keni regjistruar nje test te ri...";
		}
		
	}
	
?>

<?php include $project_root . 'views/layout/footer.php'; ?>