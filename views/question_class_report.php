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

$municipality_id = $_GET['mun_id'];
$class_id = $_GET['class_id'];
$question_id = $_GET['question_id'];
$user_id = $_SESSION['id'];

$get_questions = "SELECT * from Question WHERE question_id = '{$question_id}'";
$question = mysql_query($get_questions);

if (mysql_num_rows($question) > 0) {
	$question_result = mysql_result($question, 0, 'description');
} else {
	$question_result = "Zgjedh pytjen";
}

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
if ($municipality_id) {
	$query = mysql_query("SELECT Class.location_id, Class.class_id, Class.name, Class.test_id, Location.municipality_id, Location.location_id $fields from Location INNER JOIN Class ON Class.location_id = Location.location_id $inner_join WHERE Location.municipality_id = $municipality_id".$where.$where_question);
}
$true_answers_before = 0;
$true_answers_after = 0;

$number_of_participants = 0;

// $get_municipalities = "SELECT municipality_id, name, coords FROM Municipality";
if (is_admin($user_id)) {
    $get_municipalities = "SELECT m.municipality_id as municipality_id, m.name as name FROM Municipality m";
}
else {
    $get_municipalities = "SELECT m.municipality_id as municipality_id, m.name as name FROM Municipality m INNER JOIN User u on m.municipality_id=u.municipality_id where user_id=$user_id ";
}

$municipalities = mysql_query($get_municipalities);

?>
<form action="" method="GET">
<div class="dropdown">
<select name="mun_id" id="municipality_id" class="municipality_id dropdown-select" value="<?php echo $municipality_id; ?>">
    <option value="">Zgjedh Komunen</option>
    <?php
        create_options($municipalities, "municipality_id", "name");
    ?>
</select>
</div>
<div class="dropdown">
<select name="class_id" id="class_id" class="class_id dropdown-select">
    <option value="">Zgjedh Kursin</option>
</select>
</div>
<div class="dropdown">
<select name="question_id" id="questions" class="dropdown-select">
    <option value="">Zgjedh Pytjen</option>
<?php
$get_all_questions = "SELECT * FROM Question";
$questions = mysql_query($get_all_questions);
    while ($question = mysql_fetch_object($questions)) {
        echo "<option value='$question->question_id'>$question->description</option>";
    }
?>
</select>
</div>
<input type="submit" value="Gjenero" class="align-top">
</form>
<br><br>
<div id = 'content'>
<table class="bordered">
	<tr>
		<th>Pjesmarresit</th>
		<th colspan="2"><?php echo $question_result; ?></th>
	</tr>
	<tr>
		<td><strong>Emri Mibemri</strong></td>
		<td><strong>Para Testit</strong></td>
		<td><strong>Pas Testit</strong></td>
	</tr>
		<?php if ($municipality_id): ?>
		<?php while ($r = mysql_fetch_object($query)) : ;?>
				<?php
					if ($r->type == "para" && $r->answer == 1) {
						$true_answers_before++;
					}
					if ($r->type == "pas" && $r->answer == 1) {
						$true_answers_after++;
					}
					if ($r->type == "para") {
						$number_of_participants++;
						echo "<tr>";
							echo "<td>$r->name $r->surname</td>";
							echo "<td class='para-testit'>$r->answer</td>";
					} else if ($r->type == "pas") {
						echo "<td class='pas-testit'>$r->answer</td>";
					} else {
						echo "</tr>";
					}
				?>
		<?php endwhile; ?>
		<?php endif; ?>
	<tr>
		<?php
				$total_before = $true_answers_before / $number_of_participants * 100;
				$total_after  = $true_answers_after / $number_of_participants * 100;
		?>
		<td><strong>Totali i pergjigjeve te sakta:</strong></td>
		<td id="para-testit"><?php echo round($total_before, 2); ?>%</td>
		<td id="pas-testit"><?php echo  round($total_after, 2); ?>%</td>
	</tr>
</table>
</div>

<form>
    <br>
<input id="printBtn" type="button" value="Printo" class = 'button'/>
</form>
</body>

<script type="text/javascript">
$("#printBtn").click(function(){
    printcontent($("#content").html());
});
</script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/class_report.js"></script>
<?php include $project_root . 'views/layout/footer.php'; ?>

<div id="message"></div>