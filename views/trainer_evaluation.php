<?php

$page_title = "Class Performance Report";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$municipality_id = $_GET['mun_id'];
$trainer_id = $_GET['trainer_id'];


if($trainer_id){

	$get_trainers = "SELECT * FROM Evaluation e inner join Location l ON e.location_id = l.location_id WHERE e.trainer_id = '{$trainer_id}'";
	$trainers = mysql_query($get_trainers);
	?>

	<table>
		<tr><th>Categories</th><th>Vleresime Pozitive</th><th>Vleresime Negative</th><th>Totali</th></tr>
	<?php
    $c = 0;
	// $evaluation_id;
	
	while($result = mysql_fetch_assoc($trainers)){

		$evaluatin_id[$c] = $result['evaluation_id'];

		$query = mysql_query("SELECT * FROM EvaluationCategory ec inner join Category c ON ec.category_id = c.category_id  and ec.evaluation_id = '{$evaluatin_id[$c]}' ");

		echo "<tr>";
		while($results = mysql_fetch_assoc($query)){
			$cat_id = $results['name'];
			$evaluati_poz = $results['evaluation'];
			echo "<td>".$cat_id."</td>";
			if($evaluati_poz == 1) {
				echo "<td>".$evaluati_poz."</td>";
			}else{
				echo "<td><td><td>".$evaluati_poz."</td>";
			}
			
			// echo "<td>".."</td>";
			
		}
		echo "</tr>";
	    $c++;		
	}	
	
	

	?>
	</table>
	<?php
}



?>

<?php include $project_root . 'views/layout/footer.php'; ?>

<div id="message"></div>