<?php
	$page_title = "Listo Pyetjet";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>

<?php 

	$query = mysql_query("SELECT * FROM Question");
	
	echo "<table border = '1'>";
	echo "<tr><th>Pyejta</th><th>Pergjigjet</th><th>Edito</th></tr>";

	while ($result = mysql_fetch_assoc($query)) {
		
		echo "<tr id = '{$result["question_id"]}'><td>".$result['description']
		."</td><td>".
 		"<div id = 'show_questions'>";

		echo "<ol>";
		$c = 0;

		$answers = mysql_query("SELECT * FROM Answer where `question_id` = {$result["question_id"]}");
		
		while($answer_res = mysql_fetch_assoc($answers)){

			$question_id[$c] = $answer_res['question_id'];
			$answer_description[$c] = $answer_res['description'];

			if($question_id[$c] == $result["question_id"]){
				$alphabet = range("A", "Z");
				echo $alphabet[$c]." : ".$answer_description[$c]."<br>";
				$c++;
			}
			
		}

		echo "</ol>";
		echo "</div>";

		echo "</td><td>"."<input type = 'button' value = 'Edito' />"."</td>";
		

	}

	echo "</table>";
	
 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>