<?php

$page_title = "Trainer evaluation";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$municipality_id = $_GET['mun_id'];
$trainer_id = $_GET['trainer_id'];

if($trainer_id){


	?>

	<table class="bordered">
		<tr><th>Categories</th><th>Vleresime Pozitive</th><th>Vleresime Negative</th><th>Totali</th></tr>
	<?php

	$get_cat = "SELECT * FROM Category c ";
	$cat = mysql_query($get_cat);

    $c = 0;
	
	while($resultss = mysql_fetch_assoc($cat)){
			  
		$cat_idd[$c] = $resultss['category_id'];
		$catt[$c] =  $resultss['name'];
		$cc = 0;
		echo "<tr>";
		echo "<td>".$catt[$c]."</td>";


		$evaluatin_id[$c] = $result['evaluation_id'];

			// while($result = mysql_fetch_assoc($trainers)){

				// echo $evaluatin_id[$cc] = $result['evaluation_id'];
		
			 // echo $evaluatin_id[$c]." ; ";

				// $query = mysql_query("SELECT *  FROM EvaluationCategory ec inner join Category c ON ec.category_id = c.category_id and ec.evaluation_id = '{$evaluatin_id[$c]}' ");


				// while($results = mysql_fetch_assoc($query)){
					
				// 	$evaluati = $results['evaluation'];

					// $cat_id[$cc]." ; ";

					$cat_query = mysql_query("SELECT COUNT(evaluation) FROM `EvaluationCategory` WHERE evaluation_id IN (SELECT evaluation_id from Evaluation where trainer_id = '{$trainer_id}') and evaluation = 1 AND category_id = '{$cat_idd[$c]}' ");

					echo "<td>".mysql_result($cat_query, 0)."</td>";

					$cat_query2 = mysql_query("SELECT COUNT(evaluation) FROM `EvaluationCategory` WHERE evaluation_id IN (SELECT evaluation_id from Evaluation where trainer_id = '{$trainer_id}') and evaluation = 0 AND category_id = '{$cat_idd[$c]}' ");

					echo "<td>".mysql_result($cat_query2, 0)."</td>";

					echo "<td>".""."</td>";
					
				// }
				
				// $cc++;
		// }
		$c++;
		echo "</tr>";
	    		
	}	
	
	

	?>
	</table>
	<?php
}



?>

<?php include $project_root . 'views/layout/footer.php'; ?>

<div id="message"></div>