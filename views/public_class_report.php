<?php
$page_title = "Raporti Publik i Suksesit";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';


	$test_id = $_GET['test_id'];
	if ($test_id) {
		$public_report = mysql_query("SELECT test.test_id, test.name, test.active, question.description, participantanswer.type, question.question_id, participantanswer.answer from test
		INNER JOIN testquestion ON test.test_id = testquestion.test_id
		INNER JOIN participantanswer ON participantanswer.question_id = testquestion.question_id
		INNER JOIN question ON question.question_id = testquestion.question_id
		WHERE testquestion.test_id = $test_id");
	}

	$get_tests = "SELECT * FROM `test` where active = 1";
	$tests = mysql_query($get_tests);
?>

<select name="class" onchange="location = this.options[this.selectedIndex].value;">
	<option value="">Zgjedh Testin</option>
<?php while ($test = mysql_fetch_object($tests)) : ?>
	<option value="<?php echo BASE_URL.'/views/public_class_report.php?test_id='.$test->test_id; ?>"><?php echo $test->name; ?></option>
<?php endwhile; ?>
</select>


<?php
$true_answers_before = 0;
$true_answers_after = 0;

$number_of_questions_before = 0;
$number_of_questions_after = 0;
?>
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
	<p><?php //echo mysql_result($public_report, 0, 'name'); ?></p>
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
			$total_before = $true_answers_before / $number_of_questions_before;
			$total_after  = $true_answers_after / $number_of_questions_after;
		?>
		<td><strong>Totali i pergjigjeve te sakta:</strong></td>
		<td id="para-testit"><?php echo number_format($total_before, 2, '.', ''); ?>%</td>
		<td id="pas-testit"><?php echo  number_format($total_after, 2, '.', ''); ?>%</td>
	</tr>
</table>

<?php include $project_root . 'views/layout/footer.php'; ?>