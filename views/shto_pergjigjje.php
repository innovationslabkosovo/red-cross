<?php
	$page_title = "Shto_pergjigjje";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>


<form action="" method="post">

<label>Id e pjesemarresit: </label> <input type="text" id="part_id" name="part_id"><br>
<input type="submit" value="Shto pergjigjje">


</form>

<?php

	if(empty ($_POST) == false)	// nese eshte dergu forma (klikohet butoni)
	{
		if(empty ($_POST['part_id']) == true)
		{
			$errors[] = "Ju lutem shkruani id e pjesemarresit...";
		}
	}	
	
	$part_id = "";
	
?>
        
<?php
	
	if(empty ($_POST['part_id']) == false && empty ($errors) == true)	// nese ska errora dhe eshte shkruar id
	{
		//selekto gjithcka qe ka id e participantit dhe redirect
		$id = $_POST['part_id'];
		
		$result = mysql_query("SELECT * FROM Participant WHERE `participant_id` = $id"); // a egziston participanti
		
		if(mysql_num_rows($result) > 0)	// nese egziston participanti
		{

			header("Location: saktesia.php?part_id=$id");
			
		}

		else
		{

			$errors[] = "Nuk egziston pjesemarres me id: " . $id;
			echo implode("", $errors);
			
		}
		
	}

	else echo implode("", $errors);		// shfaq errorat

	//==================//
	// marrim id e qesim permes linkut n faqen tjeter, e shkrujm pergjigjjet per participantin me id 13
	//i paraqesim me tabele te dhenat dhe insertojme ne db----

?>



<?php include $project_root . 'views/layout/footer.php'; ?>