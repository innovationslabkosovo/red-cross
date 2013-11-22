<?php
	$page_title = "Saktesia e pergjigjjeve";
	include("core/init.php");
	protect_page();
	include("inc/overall/header.php");	
	$errors = array();
?>

<?php
$id = $_REQUEST['part_id'];	// me marr permes url linkut


$part_id = mysql_query("SELECT q.id AS q_id, q.text AS q_text, p.id AS p_id, t.id AS t_id from participant as p INNER JOIN class as c on p.class_id = c.id INNER JOIN test as t on c.test_id = t.id INNER JOIN test_question as tq on t.id = tq.test_id INNER JOIN question as q on tq.question_id = q.id WHERE p.id = $id");

?>

<h3>Tabela per pergjigjjet e participantit me id:  <?php echo $id; ?></h3>

<form action="" method="post">  <!-- forma per shtimin e pergjigjjeve -->

<table border="1"> 
		<tr>
			<td> Pyetjet </td>
			<td> Para </td>
			<td> Pas </td>
			<td>Test_id</td>
		</tr>

<?php
while($record = mysql_fetch_array($part_id))	//paraqit query-n
	{
		echo ' 
		<tr>
			<td>' . $record['q_text'] . '</td>
			<td>T<input type="radio" name="para['.$record['q_id'].']" value="1"> F<input type="radio" name="para['.$record['q_id'].']" value="0"> </td>
			<td>T<input type="radio" name="pas['.$record['q_id'].']" value="1"> F<input type="radio" name="pas['.$record['q_id'].']" value="0"> </td>
			<td>' . $test_id = $record['t_id'] . '</td>
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


<?php include("inc/overall/footer.php"); ?>