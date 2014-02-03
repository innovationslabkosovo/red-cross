<?php
include('init.php');
$municipality_id = 	$_GET['mun_id'];
$class_id = $_GET['class_id'];
$question_id = $_GET['question_id'];

if($class_id) {
	$fields = " ,Participant.name, Participant.surname, ParticipantAnswer.type, ParticipantAnswer.answer, Question.question_id, Question.description";
	$inner_join = " INNER JOIN ParticipantClass ON ParticipantClass.class_id = Class.class_id
	INNER JOIN ParticipantAnswer ON ParticipantAnswer.participant_id = ParticipantClass.participant_id
	INNER JOIN Participant ON Participant.participant_id = ParticipantAnswer.participant_id
	INNER JOIN Question ON Question.question_id = ParticipantAnswer.question_id";
	$where = " AND Class.class_id = '{$class_id}'";
}

if ($question_id) {
	$where_question = " AND ParticipantAnswer.question_id = '{$question_id}'";
}

if ($municipality_id) :
	$sql = mysql_query("SELECT Class.location_id, Class.class_id, Class.name, Class.test_id, Location.municipality_id, Location.location_id $fields from Location INNER JOIN Class ON Class.location_id = Location.location_id $inner_join WHERE Location.municipality_id = $municipality_id".$where.$where_question);
	if ($sql) :
		while ($results = mysql_fetch_object($sql)) : pre($results); ?>
				<option value="<?php echo $results->class_id; ?>"><?php echo $results->name; ?></option>
		<?php endwhile; ?>
	<?php endif; ?>
<?php endif; ?>

<!-- SELECT Class.location_id, Class.class_id, Class.name, Class.test_id, Location.municipality_id, Participant.name, Participant.surname, ParticipantAnswer.type, ParticipantAnswer.answer, Question.question_id, Question.description, Location.location_id from Location INNER JOIN Class ON Class.location_id = Location.location_id
INNER JOIN ParticipantClass ON ParticipantClass.class_id = Class.class_id
	INNER JOIN ParticipantAnswer ON ParticipantAnswer.participant_id = ParticipantClass.participant_id
	INNER JOIN Participant ON Participant.participant_id = ParticipantAnswer.participant_id
	INNER JOIN Question ON Question.question_id = ParticipantAnswer.question_id
WHERE Location.municipality_id = 26 AND Class.class_id = 1 AND ParticipantAnswer.question_id = 1 -->