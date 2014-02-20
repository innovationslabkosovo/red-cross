<?php
include '../init.php';
if ($_POST['id']) {
	$id=mysql_real_escape_string($_POST['id']);
	$question_desc=mysql_real_escape_string(trim($_POST['question_description']));
	$answers_description = trim($_POST['answers_description']);
	$answers_id = $_POST['answers_id'];
	mysql_query("update Question set description='$question_desc' where question_id='$id'");
	ob_clean();
	$i = 0;
	if (isset($answers_description)) {
		foreach ($answers_id as $answer_id) {
			mysql_query("update Answer set description='{$answers_description[$i++]}' where answer_id='{$answer_id}' AND question_id='$id'");
		}
	}
	echo json_encode($_POST);
}