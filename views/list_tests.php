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
	echo '<div class="form-error-message hide"></div>';
	echo "<form id='url' action='{$base_url}/core/application/edit_test.php' >";
	echo "<table  class = 'bordered'>";
	echo "<tr><th>Emri</th><th>Edito</th></tr>";
	while ($result = mysql_fetch_assoc($query)) {
		echo "<tr id = '{$result["test_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["test_id"]}' class='text'>{$result["name"]}</span>"
		."<input name='test_description' data-validation='required' type='text' class='editbox_{$result["test_id"]} editbox txfform-wrapper input' value='{$result["name"]}' />"
		."</td>";

		echo "<td>"."<input type='hidden' name='id' class='editbox_{$result["test_id"]} editbox' value='{$result["test_id"]}' />"
		."<input type='button' value='Ruaj' class='save_{$result["test_id"]} save submitSmlBtn' id='{$result["test_id"]}'>"
        ."<input type='button' value='Perditeso' class='edit_{$result["test_id"]} edit submitSmlBtn' id='{$result["test_id"]}'>"
        ."<input type='button' value='Anulo' class='cancel_{$result["test_id"]} cancel submitSmlBtn' id='{$result["test_id"]}' style='display:none;' >"
		."</td>";

	}

	echo "</table>";
	echo "</form>";
	echo "</div>";

 ?>

<?php include $project_root . 'views/layout/footer.php'; ?>