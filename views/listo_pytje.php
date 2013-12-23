<?php
	$page_title = "Listo Pyetjet";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>

<?php 

	$query = mysql_query("SELECT * FROM Question");

	echo "<ol>";
	while ($result = mysql_fetch_assoc($query)) {
		

		echo "<li>".$result['description']."<input type = 'button' value = 'Edito' />"."</li>";
		
	}

	echo "</ol>";
	
 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>