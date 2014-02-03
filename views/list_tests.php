<?php
	$page_title = "Listo Pyetjet";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
	$base_url = BASE_URL;
?>

<?php 

	$query = mysql_query("SELECT * FROM Test");

	echo "<div id='url' url='{$base_url}/core/application/edit_test.php' ></div>";
	echo "<table  class = 'bordered'>";
	echo "<tr><th>Emri</th><th>Edito</th></tr>";
	while ($result = mysql_fetch_assoc($query)) {
		echo "<tr id = '{$result["test_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["test_id"]}' class='text'>{$result["name"]}</span>"
		."<input name='test_description' type='text' class='editbox txfform-wrapper input' value='{$result["name"]}' id='editbox_{$result["test_id"]}' />"
		."</td>";

		echo "<td>"."<input type='hidden' name='id' class='editbox' id='editbox_{$result["test_id"]}' value='{$result["test_id"]}' />"
		."<input type='button' value='Ruaj' class='save submitSmlBtn' id='{$result["test_id"]}'>"
        ."<input type='button' value='Perditeso' class='edit submitSmlBtn' id='{$result["test_id"]}'>"
		."</td>";
		
	}
	echo "</table>";
	echo "</div>";

	
 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>