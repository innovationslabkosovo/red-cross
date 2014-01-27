<?php

$page_title = "Class Performance Report";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';
/*
* Print overall class pre-test and post-test performance
* As well as change in performance per question
*/

echo $municipality_id = $_GET['mun_id'];
echo $class_id = $_GET['class_id'];
echo $question_id = $_GET['question_id'];

$get_questions = "SELECT * from question WHERE question_id = '{$question_id}'";
$question = mysql_query($get_questions);

// if($class_id) {
// 	$fields = " ,class.location_id, class.class_id, class.name, class.test_id, participant.name, participantanswer.type, participantanswer.answer, question.description";
// 	$inner_join = "	INNER JOIN class ON class.location_id = location.location_id
// 	INNER JOIN participantattendance ON participantattendance.class_id = class.class_id
// 	INNER JOIN participantanswer ON participantanswer.participant_id = participantattendance.participant_id
// 	INNER JOIN participant ON participant.participant_id = participantanswer.participant_id
// 	INNER JOIN question ON question.question_id = participantanswer.question_id";
// 	$where = " AND class.class_id = '{$class_id}'";
// }


if($class_id) {
	$fields = " ,class.location_id, class.class_id, class.name, class.test_id, participant.name, participantanswer.type, participantanswer.answer, question.question_id, question.description";
	$inner_join = "	INNER JOIN class ON class.location_id = location.location_id
	INNER JOIN participantclass ON participantclass.class_id = class.class_id
	INNER JOIN participantanswer ON participantanswer.participant_id = participantclass.participant_id
	INNER JOIN participant ON participant.participant_id = participantanswer.participant_id
	INNER JOIN question ON question.question_id = participantanswer.question_id";
	$where = " AND class.class_id = '{$class_id}'";
}

if ($question_id) {
	$where_question = " AND participantanswer.question_id = '{$question_id}'";
}

$query = mysql_query("SELECT location.municipality_id, location.location_id $fields from Location $inner_join WHERE location.municipality_id = $municipality_id".$where.$where_question);

// $class_performance = mysql_query("SELECT class.test_id as test_class_id, class.name as class_name, test.test_id, participantanswer.test_id, participantanswer.type,participantanswer.answer,participant.participant_id, participant.name, participant.surname, question.description FROM Class
// 	INNER JOIN Test ON class.test_id = test.test_id
// 	INNER JOIN participantanswer ON participantanswer.test_id = test.test_id
// 	INNER JOIN participant ON participant.participant_id = participantanswer.participant_id
// 	INNER JOIN question ON participantanswer.question_id = question.question_id");
// 	$para = 'para';
// 	$pas = 'pas';
// 	$c_true_answers_para = 0;
// 	$c_false_answers_para = 0;

// 	$c_true_answers_pas = 0;
// 	$c_false_answers_pas = 0;

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality";
$municipalities = mysql_query($get_municipalities);

?>
<table class="bordered">
	<tr>
		<th>Participants</th>
		<th colspan="2"><?php echo mysql_result($question, 0, 'description'); ?></th>
	</tr>
	<tr>
		<td><strong>Emri Mibemri</strong></td>
		<td><strong>Para Testit</strong></td>
		<td><strong>Pas Testit</strong></td>
	</tr>
		<?php while ($r = mysql_fetch_object($query)) : ?>
				<?php
					if ($r->type == "para") {
						echo "<tr>";
							echo "<td>$r->name</td>";
							echo "<td class='para-testit'>$r->answer</td>";
					} else if ($r->type == "pas") {
						echo "<td class='pas-testit'>$r->answer</td>";
					} else {
						echo "</tr>";
					}
				?>
		<?php endwhile; ?>
</table>
<select name="municipalities" id="municipality_id">
	<option value="">Zgjedh Komunen</option>
    <?php
		create_options($municipalities, "municipality_id", "name");
	?>
</select>
<select name="class" id="class_id">
	<option value="">Zgjedh Klasen</option>
</select>
<select name="questions" id="questions">
	<option value="">Zgjedh Pytjen</option>
</select>



<?php
$test_id = $_GET['test_id'];
$public_report = mysql_query("SELECT test.test_id, test.name, test.active, question.description, participantanswer.type, question.question_id, participantanswer.answer from test
INNER JOIN testquestion ON test.test_id = testquestion.test_id
INNER JOIN participantanswer ON participantanswer.question_id = testquestion.question_id
INNER JOIN question ON question.question_id = testquestion.question_id
WHERE testquestion.test_id = $test_id");


while ($public_report_results = mysql_fetch_object($public_report)) {
	pre($public_report_results);
}
?>


<script type="text/javascript" src="<?php echo BASE_URL;?>/js/class_report.js"></script>
<?php include $project_root . 'views/layout/footer.php'; ?>