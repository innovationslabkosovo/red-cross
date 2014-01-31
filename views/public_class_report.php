<?php
$page_title = "Raporti Publik i Suksesit";
include '../core/init.php';
$errors = array();
include 'layout/header.php';

$true_answers_before = 0;
$true_answers_after = 0;

$number_of_questions_before = 0;
$number_of_questions_after = 0;

$test_id = $_GET['test_id'];
if ($test_id) {
	$public_report = mysql_query("SELECT Test.test_id, Test.name, Test.active, Question.description, ParticipantAnswer.type, Question.question_id, ParticipantAnswer.answer from Test
	INNER JOIN TestQuestion ON Test.test_id = TestQuestion.test_id
	INNER JOIN ParticipantAnswer ON ParticipantAnswer.question_id = TestQuestion.question_id
	INNER JOIN Question ON Question.question_id = TestQuestion.question_id
	WHERE TestQuestion.test_id = $test_id");
}

$get_tests = "SELECT * FROM `Test` where active = 1";
$tests = mysql_query($get_tests);

$selected_test = mysql_query("SELECT name FROM Test WHERE test_id = '{$test_id}'");
?>
<select name="class" onchange="location = this.options[this.selectedIndex].value;">
	<option value="">Zgjedh Testin</option>
<?php while ($test = mysql_fetch_object($tests)) : ?>
	<option value="<?php echo BASE_URL.'/views/public_class_report.php?test_id='.$test->test_id; ?>"><?php echo $test->name; ?></option>
<?php endwhile; ?>
</select>

<table class="bordered" id="class_public_report">
	<tr>
		<th>Pyetjet</th>
		<th colspan="2" id="question">Rezultatet Para dhe Pas Testit</th>
	</tr>
	<tr>
		<td><strong>Lista e Pyetjeve</strong></td>
		<td><strong>Para Testit</strong></td>
		<td><strong>Pas Testit</strong></td>
	</tr>
	<br><br>
	<p style="margin: 0; padding: 0;">Raporti Publik per Testin: <strong><?php echo ($test_id) ? mysql_result($selected_test, 0, 'name') : "Zgjedh Testin"; ?></strong></p>
	<?php while ($public_report_results = mysql_fetch_object($public_report)) : ?>
		<?php
			if ($public_report_results->type == "para" && $public_report_results->answer == 1) {
				$true_answers_before++;
			}
			if ($public_report_results->type == "pas" && $public_report_results->answer == 1) {
				$true_answers_after++;
			}
			if ($public_report_results->type == "para") {
				$number_of_questions_before++;
				echo "<tr>";
					echo "<td>$public_report_results->description</td>";
					echo "<td value='$public_report_results->answer' class='para-testit'> $public_report_results->answer</td>";
			} else if ($public_report_results->type == "pas") {
				$number_of_questions_after++;
				echo "<td class='pas-testit'>$public_report_results->answer</td>";
				echo "</tr>";
			} else {
				echo "</tr>";
			}
		?>
	<?php endwhile; ?>
	<tr>
		<?php
			if ($test_id) {
				$total_before = $true_answers_before / $number_of_questions_before * 100;
				$total_after  = $true_answers_after / $number_of_questions_after * 100;
			}
		?>
		<td><strong>Totali i pergjigjeve te sakta:</strong></td>
		<td id="para-testit"><?php echo number_format($total_before, 2, '.', ''); ?>%</td>
		<td id="pas-testit"><?php echo  number_format($total_after, 2, '.', ''); ?>%</td>
	</tr>
</table>

<?php include $project_root . 'views/layout/footer.php'; ?>