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
	echo "<div id='url' url='{$base_url}/core/application/edit_questions.php'></div>";
	echo '<div class="form-error-message hide"></div>';
	echo "<form id='url' class='edit_question_view' action='../core/application/edit_questions.php'>";
	echo "<table border = '1' class='bordered'>";
	echo "<tr><th>Pyejta</th><th>Pergjigjet</th><th>Edito</th></tr>";

	while ($result = mysql_fetch_assoc($query)) {

		echo "<tr id = '{$result["question_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["question_id"]}' class='text'>{$result["description"]}</span>"
		."<input name='question_description' data-validation='required' type='text' class='editbox_{$result["question_id"]} editbox txfform-wrapper input' value='{$result["description"]}' />"
		."</td><td>".
 		"<div id = 'show_questions'>";
		$c = 0;

		$answers = mysql_query("SELECT * FROM Answer where `question_id` = {$result["question_id"]} ORDER BY question_id desc");

		while($answer_res = mysql_fetch_assoc($answers)){
			$question_id[$c] = $answer_res['question_id'];
			$answer_description[$c] = $answer_res['description'];
			$answer_id[$c] = $answer_res['answer_id'];

			if($question_id[$c] == $result["question_id"]){
				$alphabet = range("A", "Z");
				// echo $alphabet[$c]." : ".$answer_description[$c]."<br>";
				echo "<span class='alphabet'>$alphabet[$c]:</span><span id='results_{$result["question_id"]}' class='text'>{$answer_description[$c]}</span>"
				."<input name='answers_description[]' history='{$c}' type='text' class='editbox_{$result["question_id"]} editbox txfform-wrapper input' value='{$answer_description[$c]}' />"
				."<input name='answers_id[]' type='hidden' class='editbox_{$result["question_id"]} editbox txfform-wrapper input' value='{$answer_id[$c]}' />";
				$c++;
			}

		}
		echo "</div>";

		echo "</td><td>"."<input type='hidden' name='id' class='editbox_{$result["question_id"]} editbox' value='{$result["question_id"]}' />"
		."<input type='button' value='Ruaj' class='save_{$result["question_id"]} save submitSmlBtn' id='{$result["question_id"]}' />"
        ."<input type='button'  value='Perditeso' class='edit_{$result["question_id"]} edit submitSmlBtn' id='{$result["question_id"]}'  />"
        ."<input type='button'  value='Anulo' class='cancel_{$result["question_id"]} cancel submitSmlBtn' id='{$result["question_id"]}' style='display:none;' />"
		."</td>";


	}

	echo "</table>";
	echo "</form>";

 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>