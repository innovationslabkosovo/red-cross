<?php
	$page_title = "Lista e Testeve";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
	$base_url = BASE_URL;
	$user_id = $_SESSION['id'];
?>

<?php

	$query = mysql_query("SELECT * FROM Test ORDER BY test_id desc");

	echo '<div class="form-error-message hide"></div>';
	echo "<form id='url' class='edit_tests_view' action='{$base_url}/core/application/edit_test.php' >";
	echo "<table  class = 'bordered'>";
	echo "<tr><th>Emri</th><th>Pyetjet</th>";

	if(is_admin($user_id)){
		echo "<th>Edito</th></tr>";
	}
	
	while ($result = mysql_fetch_assoc($query)) {

		echo "<tr id = '{$result["test_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["test_id"]}' class='text'>{$result["name"]}</span>"
		."<input name='test_description' data-validation='required' type='text' class='editbox_{$result["test_id"]} editbox txfform-wrapper input' value='{$result["name"]}' />"
		."</td>";

		echo "<td><a href='$base_url/views/list_question_test.php?test_id={$result["test_id"]}'>Shiko pyetjet per kete test</a></td>";

		if(is_admin($user_id)){

			echo "<td>"."<input type='hidden' name='id' class='editbox_{$result["test_id"]} editbox' value='{$result["test_id"]}' />"
			."<input type='button' value='Ruaj' class='save_{$result["test_id"]} save submitSmlBtn' id='{$result["test_id"]}'>"
	        ."<input type='button' value='Perditeso' class='edit_{$result["test_id"]} edit submitSmlBtn' id='{$result["test_id"]}'>"
	        ."<input type='button' value='Anulo' class='cancel_{$result["test_id"]} cancel submitSmlBtn' id='{$result["test_id"]}' style='display:none;' >"
			."</td>";

		}
		
        echo "</tr>";

	}

 	echo "</table>";
	echo "</form>";
	echo "</div>";

    

 ?>
<?php include $project_root . 'views/layout/footer.php'; ?>