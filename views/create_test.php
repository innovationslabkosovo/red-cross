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
<form action="" method="post" id = "form1" class="create_test_view">

<label>Emri i testit: </label><br><input type="text" name="emri_testit" class="txfform-wrapper input" data-validation="required"><br><br>
<input type="button" id="select_questions" class="button" value="Selekto te gjitha" /><br>
<input type="button" id="clear_questions" class="button" value="Pastro te gjitha" />

<!-- <input type="checkbox" name="vehicle" value="Bike">I have a bike<br> -->

<?php
	$query = mysql_query("SELECT * FROM `Question`");
	
	echo "<br><br>";
	
	while ($row = mysql_fetch_array($query))

	{
		echo '<label class="myCheckbox" style="padding-bottom: 10px;">
			<input type="checkbox" name="chbox[]" value="' . $row['question_id'] . '">' 
			. '<span style="vertical-align:middle;margin-bottom:5px;"></span>' 
			. '&nbsp;'.$row['question_id'] . " - " . $row['description'] . "</label><br>";
	}	
?>

<?php


	if(empty($_POST['emri_testit']) == false)	// nese e kemi plotsu emrin e testit 
	{
		$emri_testit = trim($_POST['emri_testit']); // ruaj emrin e testit
		mysql_query("INSERT INTO `Test` (`name`) VALUES ('$emri_testit')"); //inserto emrin e testit ne tabelen test
		$test_id = mysql_insert_id(); //merr id e fundit te insertuar
	}

	
?>

    <script type="application/javascript">
        $("#select_questions").click(function() {
            $("input[type='checkbox']").prop("checked", true); 
        });
        
        $("#clear_questions").click(function() {
            $("input[type='checkbox']").prop("checked", false); 
        });
    </script>
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