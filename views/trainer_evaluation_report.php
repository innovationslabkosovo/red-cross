<?php
$page_title = "Evaluimi i Trajnerit";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality";
$municipalities = mysql_query($get_municipalities);

?>

<form action="">
	
</form>