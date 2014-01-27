<?php
include('init.php');
$municipality_id = 	$_POST['municipality_id'];
$class_id = $_POST['class_id'];
$question_id = $_POST['question_id'];

if ($class_id) {
	$where = " AND class.class_id = '{$class_id}'";
}

if ($question_id) {
	$fields2 = " ,participant.name, participantanswer.type, participantanswer.answer, ques.question_id, ques.description";
	$inner_join2 = " INNER JOIN participantanswer ON participantanswer.participant_id = participantclass.participant_id
	INNER JOIN participant ON participant.participant_id = participantanswer.participant_id
	INNER JOIN question as ques";
	$where_question = " AND participantanswer.question_id = '{$question_id}'";
}



if ($municipality_id) {
	$sql = mysql_query("SELECT location.municipality_id, location.location_id, class.class_id, class.name, ,class.location_id, class.test_id $fields2 from Location INNER JOIN class ON class.location_id = location.location_id 
		INNER JOIN participantclass ON participantclass.class_id = class.class_id $inner_join2 WHERE location.municipality_id = $municipality_id".$where.$where_question);
	if ($sql) {
		while ($results = mysql_fetch_object($sql)): 
			pre($results);
				if ($class_id) {
			?>
				<option value="<?php echo $results->question_id; ?>"><?php echo $results->description; ?></option>	
			<?php } ?>
			<?php if ($municipality_id) { ?>
				<option value="<?php echo $results->class_id; ?>"><?php echo $results->name; ?></option>
			<?php } ?>
		<?php endwhile; ?>
	<?php } }  ?>
	<?php //mysql_free_result($sql); ?>