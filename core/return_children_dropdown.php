<?php
error_reporting(0);
include('init.php');

if (isset($_POST['parent_value']) && isset($_POST['parent_id_field']) && isset($_POST['child_table']) && isset($_POST['child_id_field']) && isset($_POST['child_text_field'])){
    $parent_value = $_POST['parent_value'];
    $parent_id_field = $_POST['parent_id_field'];
    $child_table = $_POST['child_table'];
    $child_id_field = $_POST['child_id_field'];
    $child_text_field = $_POST['child_text_field'];

    if ($query_result=mysql_query("select $child_id_field , $child_text_field from $child_table where $parent_id_field = $parent_value"))
        echo create_options($query_result , $child_id_field , $child_text_field);
    else
        echo "";
}


if(isset($_POST['mun_id'])){

	$municipality_id = $_POST['mun_id'];

	$get_trainers = "SELECT e.* , t.* , l.municipality_id,l.location_id FROM Evaluation e  inner join Trainer t ON e.trainer_id = t.trainer_id inner join Location l ON e.location_id = l.location_id  WHERE l.municipality_id = '{$municipality_id}' GROUP BY t.trainer_id";
	
	$trainers = mysql_query($get_trainers);

	while($result = mysql_fetch_assoc($trainers)){
	
		echo "<option value = '{$result['trainer_id']}'>".$result['name']." ".$result['surname']."</option>";

	}

}

