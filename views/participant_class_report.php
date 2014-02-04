<?php

$page_title = "Class Performance Report";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$municipality_id = $_GET['mun_id'];
$class_id = $_GET['class_id'];

if($class_id) {
	$fields = " ,Participant.name, Participant.surname, ParticipantAnswer.type, ParticipantAnswer.answer";
	$inner_join = " INNER JOIN ParticipantClass ON ParticipantClass.class_id = Class.class_id
	INNER JOIN ParticipantAnswer ON ParticipantAnswer.participant_id = ParticipantClass.participant_id
	INNER JOIN Participant ON Participant.participant_id = ParticipantAnswer.participant_id
	";
	$where = " AND Class.class_id = '{$class_id}' group by Participant.name";
}

if ($municipality_id) {
	$query = mysql_query("SELECT
		(SELECT sum(ParticipantAnswer.answer) FROM ParticipantAnswer WHERE ParticipantAnswer.type = 'para' AND ParticipantClass.participant_id = ParticipantAnswer.participant_id) as para_correct,
		(SELECT count(ParticipantAnswer.answer) FROM ParticipantAnswer WHERE ParticipantAnswer.type = 'para' AND ParticipantClass.participant_id = ParticipantAnswer.participant_id) as count_answers_para,
		(SELECT sum(ParticipantAnswer.answer) FROM ParticipantAnswer WHERE ParticipantAnswer.type = 'pas' AND ParticipantClass.participant_id = ParticipantAnswer.participant_id) as pas_correct,
		(SELECT count(ParticipantAnswer.answer) FROM ParticipantAnswer WHERE ParticipantAnswer.type = 'pas' AND ParticipantClass.participant_id = ParticipantAnswer.participant_id) as count_answers_pas
		$fields from Location
		INNER JOIN Class ON Class.location_id = Location.location_id $inner_join
		WHERE Location.municipality_id = $municipality_id".$where.$where_question);
}

$number_of_participants = 0;
$success_para_total 	= 0;
$success_pas_total  	= 0;

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality";
$municipalities = mysql_query($get_municipalities);

?>
<form action="" method="GET">
<div class="dropdown">
<select name="mun_id" id="municipality_id" class="dropdown-select" value="<?php echo $municipality_id; ?>">
    <option value="">Zgjedh Komunen</option>
    <?php
        create_options($municipalities, "municipality_id", "name");
    ?>
</select>
</div>
<div class="dropdown">
<select name="class_id" id="class_id" class="dropdown-select">
    <option value="">Zgjedh Klasen</option>
</select>
</div>
<input type="submit" value="Gjenero" class="align-top">
</form>
<br>
<table class="bordered">
	<tr>
		<th>Pjesmarresit</th>
		<th colspan="2">Rezultatet Finale Para/Pas Testit</th>
	</tr>
	<tr>
		<td><strong>Emri Mibemri</strong></td>
		<td><strong>Para Testit</strong></td>
		<td><strong>Pas Testit</strong></td>
	</tr>
		<?php if ($municipality_id): ?>
			<?php while ($r = mysql_fetch_object($query)) :  ?>
					<?php
						$number_of_participants++;
						$success_para = $r->para_correct / $r->count_answers_para * 100;
						$success_pas = $r->pas_correct / $r->count_answers_pas * 100;

						$success_para_formated = round($success_para, 2);
						$success_pas_formated = round($success_pas, 2);

						$success_para_total += $success_para_formated;
						$success_pas_total += $success_pas_formated;

						echo "<tr>";
							echo "<td>$r->name $r->surname</td>";
							echo "<td class='para-testit'>".$success_para_formated."%</td>";
							echo "<td class='pas-testit'>".$success_pas_formated."%</td>";
						echo "</tr>";
					?>
			<?php endwhile; ?>
		<?php endif; ?>
	<tr>
		<?php
			$total_before = $success_para_total / $number_of_participants;
			$total_after  = $success_pas_total / $number_of_participants;
		?>
		<td><strong>Totali i pergjigjeve te sakta:</strong></td>
		<td id="para-testit"><?php echo round($total_before, 2); ?>%</td>
		<td id="pas-testit"><?php echo  round($total_after, 2); ?>%</td>
	</tr>
</table>

<script type="text/javascript" src="<?php echo BASE_URL;?>/js/class_report.js"></script>
<?php include $project_root . 'views/layout/footer.php'; ?>

<div id="message"></div>