<?php
	$page_title = "Listo Pyetjet";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>

<?php 

	$query = mysql_query("SELECT * FROM Test");

	echo "<table border = '1'>";

	while ($result = mysql_fetch_assoc($query)) {
		

		echo "<tr id = '{$result["test_id"]}'><td>".$result['name']
		."</td><td>"."<input type = 'button' value = 'Edito' />"."</td>";

		
	}

	echo "</table>";
	
 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>