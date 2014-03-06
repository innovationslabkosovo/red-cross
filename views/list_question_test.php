<?php
error_reporting(0);
$page_title = "Lista e pyetje per test";
include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
include $project_root . 'views/layout/header.php';

$test_id = $_GET['test_id'];
$get_questions_for_test = "SELECT q.question_id, q.description FROM Question q
	INNER JOIN TestQuestion tq ON tq.question_id = q.question_id
	WHERE tq.test_id=$test_id";
$questions_for_test = mysql_query($get_questions_for_test);

$get_test = "SELECT name FROM Test WHERE test_id=$test_id";
$test = mysql_query($get_test);
?>
<a href="list_tests.php">Kthehu te testet</a><br><br>
<p>Pyetjet per testin: <b><?=mysql_result($test, '0', 'name'); ?></b></p>
<table class="bordered">
	<tr>
		<th>Pyetja</th>
	</tr>
	<?php while ($results = mysql_fetch_object($questions_for_test)) { ?>
		<tr>
			<td style="padding-left:10px !important;text-align:left;"><?=$results->description; ?></td>
		</tr>
	<?php } ?>
</table>

<?php include $project_root . 'views/layout/footer.php'; ?>