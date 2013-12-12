<?php
	$page_title = "Saktesia e pergjigjjeve";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
?>
<htm

<?php
$id = $_REQUEST['part_id'];	// me marr permes url linkut

// $part_id = mysql_query("SELECT q.question_id AS q_id, q.desctiption AS q_text, p.participant_id AS p_id, t.test_id AS t_id from Participant as p INNER JOIN Test as t on c.test_id = t.id INNER JOIN Testquestion as tq on t.id = tq.test_id INNER JOIN Question as q on tq.question_id = q.id WHERE p.id = $id");

$query = mysql_query("SELECT * FROM ParticipantAnswer pa inner join Question q inner join Test t WHERE t.test_id = pa.test_id and participant_id = '$id' and  q.question_id = pa.question_id
 		");

?>

<h3>Tabela per pergjigjjet e participantit me id:  <?php echo $id; ?></h3>

<form action="" method="post">  <!-- forma per shtimin e pergjigjjeve -->

<table border="1"> 

		<tr>
			<td> Pyetjet </td>
			<td> Para </td>
			<td> Pas </td>
			<td> Test_id</td>
		</tr>

<?php
while($record = mysql_fetch_array($query))	//paraqit query-n
	{
		echo '
		<tr>
			<td>' . $record['description'] . '</td>
			<td>T<input type="radio" name="para['.$record['question_id'].']" value="1"> F<input type="radio" name="para['.$record['question_id'].']" value="0"> </td>
			<td>T<input type="radio" name="pas['.$record['question_id'].']" value="1"> F<input type="radio" name="pas['.$record['question_id'].']" value="0"> </td>
			<td>' . $test_id = $record['test_id'] . '</td>
		</tr>';
	}

?>

</table><br>

<input type="submit" name="submit" value="Shto pegjigjje">

</form>
<?php 
if (isset($_POST['submit']))
	
{
	foreach ($_POST['para'] as $key => $value)	// type = 0 eshte paratesti
	{	
		$q_id = $key;	//id e pytjes
		$para = $value;	// saktesia paratest
		
		//print_r($value);
		
		mysql_query("INSERT INTO `participant_result` (`participant_id`, `test_id`, `question_id`, `answer`, `type`) VALUES ('$id', '$test_id', '$q_id', '$para', '0')");
	}
	
	
	foreach ($_POST['pas'] as $key => $value)	// type = 1 eshte pastesti
	{	
		$q_id = $key;	//id e pytjes
		$pas = $value;	// saktesia pastest
		
		//print_r($value);
		
		mysql_query("INSERT INTO `participant_result` (`participant_id`, `test_id`, `question_id`, `answer`, `type`) VALUES ('$id', '$test_id', '$q_id', '$pas', '1')");
		
	}

	echo "Pergjigjjet u insertuan";
	
}


		
	// exportoje edhe niher db
?>

<?php include $project_root . 'views/layout/footer.php'; ?>