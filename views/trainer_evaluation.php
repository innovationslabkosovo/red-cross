<?php

$page_title = "Trainer evaluation";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$municipality_id = $_GET['mun_id'];
$trainer_id = $_GET['trainer_id'];

if($trainer_id){

		$query = mysql_query("SELECT `name`,`surname` FROM Trainer where trainer_id = '{$trainer_id}'");
		while($fetch = mysql_fetch_assoc($query)){
			$trainer = $fetch['name'];
			$trainer_surname = $fetch['surname'];

		}
	?>
	<div id = 'content'>
	<h1>Vleresimet per 3 muajt e fundit per <?php echo $trainer ." ".$trainer_surname; ?></h1>
	<table class="bordered">
		
		<tr><th>Kategorite</th><th>Vleresime Pozitive</th><th>Vleresime Negative</th><th>Perqindja e vleresimeve pozitive</th></tr>
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


					$cat_query = mysql_query("SELECT COUNT(evaluation) from Evaluation e inner join EvaluationCategory ec ON e.trainer_id = '{$trainer_id}' and ec.category_id = '{$cat_idd[$c]}' and e.evaluation_id = ec.evaluation_id 
					and evaluation = 1 and date BETWEEN DATE_SUB( now( ) ,INTERVAL 3 MONTH ) and now()");


					$pozitive = mysql_result($cat_query, 0);
					echo "<td>".$pozitive."</td>";

					$cat_query2 = mysql_query("SELECT COUNT(evaluation) from Evaluation e inner join EvaluationCategory ec ON e.trainer_id = '{$trainer_id}' and ec.category_id = '{$cat_idd[$c]}' and e.evaluation_id = ec.evaluation_id 
					and evaluation = 0 and date BETWEEN DATE_SUB( now( ) ,INTERVAL 3 MONTH ) and now()");

					$negative = mysql_result($cat_query2, 0);
					echo  "<td>".$negative."</td>";
					
				 	$total = $pozitive+$negative;

					$percentage = round($pozitive / $total * 100,2);

					echo "<td>".$percentage."%"."</td>";

		$c++;
		echo "</tr>";
	    		
	}	

	?>
	</table>
	</div>

<form>
<input id="printBtn" type="button" value="print" />
</form>

	<?php
}



?>
<script type="text/javascript">
$("#printBtn").click(function(){
    printcontent($("#content").html());
});
</script>
<?php include $project_root . 'views/layout/footer.php'; ?>

<div id="message"></div>