<?php
$page_title = "Krijo_pyetje";
include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id );
include $project_root . 'views/layout/header.php';
	$errors = array();
?>
<html>
<head>
  <script type="text/javascript" src="<?php echo BASE_URL  ?>/js/shto-fshi-fusha-script.js"></script>
<title>Krijo Pyetje</title>
 
</head>

<h1>Krijo pyetjet per teste: </h1>

<form action="" method="post">

    <!-- <label>Emri i testit :</label><input type="text" id="krijo_test" name="name"></li> -->
        
    <div id='TextBox'>
	<div id="TextBoxDiv1">

		<label><strong>Pyetja #1 :</strong> </label><br><input type='text' id='q1' name="question[]" class="txfform-wrapper input" data-validation="required"> <br>
      
        <label>Pergjigjja A : </label><br><input type='text' id='a1' name="answer[q0][]" class="txfform-wrapper input" data-validation="required">
        <input type="hidden" name="check[c0][a1]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a1]" value="1"><br> -->
        <label>Pergjigjja B : </label><br><input type='text' id='a2' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a2]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a2]" value="1"><br> -->
        <label>Pergjigjja C : </label><br><input type='text' id='a3' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a3]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a3]" value="1"><br> -->
        <label>Pergjigjja D : </label><br><input type='text' id='a4' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a4]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a4]" value="1"><br> -->
        <label>Pergjigjja E : </label><br><input type='text' id='a5' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a5]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a5]" value="1"><br> -->
        <label>Pergjigjja F : </label><br><input type='text' id='a5' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a5]" value="0"><br>
        <!-- <input type="checkbox" name="check[c0][a5]" value="1"><br> -->
        <label>Pergjigjja G : </label><br><input type='text' id='a6' name="answer[q0][]" class="txfform-wrapper input">
        <input type="hidden" name="check[c0][a6]" value="0"><br><br>
        <!-- <input type="checkbox" name="check[c0][a5]" value="1"><br> -->
	</div>
</div>
<input type='button' value='Shto fushe' id='addButton'>
<input type='button' value='Fshi fushe' id='removeButton'>


<input type="submit" id="krijo_pyetje" value="Krijo pyetjet">
    
</form><?php

	if(empty($_POST) === false)	// nese eshte dergu forma
	{
		
		
		
		foreach ($_POST['question'] as $q)	// validimi i pyetjeve
		{
			
			if(empty($q))
			{
				$errors[] = 'Ju lutemi shkruani te gjitha pyetjet...';
				//errorat i shfaqim ne fund ne qoftse egzistojn ( te else )
				break; // mos mi shfaq krejt errorat
			}
		}
		
		
		foreach ($_POST['answer'] as $key=>$value)	// validimi i pergjigjjeve marrim vlerat
		{
			
			foreach ($value as $v)	// tash shkojm per secilen pergjigjje vec e vec
			{
				// if(empty($v))
				// {					
				// 	$errors[] = 'Ju lutemi shkruani te gjitha pergjigjjet...';
				// 	break;	// break mos me qit 5 errora per secilen pergjigjje, por per secilen pytje del error
				// 	//errorat i shfaqim ne fund ne qoftse egzistojn ( te else )
				// }
			}
			
			if (empty($errors) == false)	// mos mi paraqit errorat krejt
			break;
		}
		
	
	}
	
	if((empty($_POST) === false) && empty($errors) === true)	// nese ska errora inserto edhe redirect
	{

			$questions = $_POST['question'];	// ruaj pyetjet ne nje array

			$codes = array("A","B","C","D","E");
			for($i = 0; $i <  sizeof($questions); $i++)
			{
                $questions[$i] = trim($questions[$i]);
				$shto_pyetje = mysql_query("INSERT INTO `Question` (`description`) VALUES ('$questions[$i]')"); // insert te question
				
				$question_id = mysql_insert_id();	// kthen id e fundit te insertuar (id e pyetjes)
			
				$answers = $_POST['answer']['q'.$i];	// marrim pergjigjjet nje nga nje
				
				for ($j=0; $j < sizeof($answers); $j++){	
					
					$n = $j+1;	// percdo pyetje fusim pergjigjje	rrisim j sepse answers fillojn prej 1 jo prej 0
					// $correct_ans = $_POST['check']['c'.$i]['a'.$n];
					//marrim correct answer nese osht check e marrim checked nese jo e marrim hidden field
					if (!empty($answers[$j])) {
                        $answers[$j] = trim($answers[$j]);
						$shto_pergjigjje = mysql_query("INSERT INTO `Answer` (`question_id`, `description`) VALUES ('$question_id', '$answers[$j]')");
					}
					// shto nje pergjigjje
					// $answer_id = mysql_insert_id(); // id e fundit e insertuar (id e pergjigjjes)
					
					// $shto_question_answer = mysql_query("INSERT INTO `question_answer` (`question_id`, `answer_id`, `correct_answer`) VALUES ('$question_id', '$answer_id', '$correct_ans')"); 
					// shto te question_answer te dhenat perkatese
				}
					
			}			
	
			//header('Location: krijo_pyetje.php?success');
			header("location: create_question.php?message=success&object=question");
			exit();
	}
	else echo implode(', ---', $errors); // shfaqja e errorave ne qofte se egzistojne
	
	if(isset($_GET['success']) && empty($_GET['success']))	// nese eshte regjistruar shfaq notifikimin
	{
			echo "<h4> " . "Ju keni regjistruar pyetjet perkatese me sukses!" . "</h4>";
	}
	
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
		
?>
