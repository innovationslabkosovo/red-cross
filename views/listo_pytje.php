<?php
	$page_title = "Listo Pyetjet";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
	$base_url = BASE_URL;
?>

<?php

	$query = mysql_query("SELECT * FROM Question");
	echo "<div id='url' url={$base_url}/core/application/edit_questions.php></div>";
	echo "<table border = '1'>";
	echo "<tr><th>Pyejta</th><th>Pergjigjet</th><th>Edito</th></tr>";

	while ($result = mysql_fetch_assoc($query)) {

		echo "<tr id = '{$result["question_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["question_id"]}' class='text'>{$result["description"]}</span>"
		."<input name='question_description' type='text' class='editbox' value='{$result["description"]}' id='editbox_{$result["question_id"]}' />"
		."</td><td>".
 		"<div id = 'show_questions'>";
		$c = 0;

		$answers = mysql_query("SELECT * FROM Answer where `question_id` = {$result["question_id"]}");

		while($answer_res = mysql_fetch_assoc($answers)){
			$question_id[$c] = $answer_res['question_id'];
			$answer_description[$c] = $answer_res['description'];
			$answer_id[$c] = $answer_res['answer_id'];

			if($question_id[$c] == $result["question_id"]){
				$alphabet = range("A", "Z");
				// echo $alphabet[$c]." : ".$answer_description[$c]."<br>";
				echo "<span class='alphabet'>$alphabet[$c]:</span><span id='results_{$result["question_id"]}' class='text'>{$answer_description[$c]}</span>"
				."<input name='answers_description[]' history='{$c}' type='text' class='editbox' value='{$answer_description[$c]}' id='editbox_{$result["question_id"]}' />"
				."<input name='answers_id[]' type='hidden' class='editbox' value='{$answer_id[$c]}' id='editbox_{$result["question_id"]}' />";
				$c++;
			}

		}
		echo "</div>";

		echo "</td><td>"."<input type='hidden' name='id' class='editbox' id='editbox_{$result["question_id"]}' value='{$result["question_id"]}' />"
		."<input type='button' value='Ruaj' class='save' id='{$result["question_id"]}'>"
        ."<input type='button' value='Perditeso' class='edit' id='{$result["question_id"]}'>"
		."</td>";


	}

	echo "</table>";

 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>