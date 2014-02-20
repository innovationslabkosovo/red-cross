<?php
include '../init.php';
if ($_POST['id']) {

	$id=mysql_real_escape_string($_POST['id']);
	$test_desc=mysql_real_escape_string(trim($_POST['test_description']));

	ob_clean();
	
	mysql_query("UPDATE Test set name='{$test_desc}' where test_id='{$id}'");

	echo json_encode($_POST);
	
}