<?php 
$page_title = "Shto ligjerues";
include 'core/init.php';
protect_page();
$errors = array();
include 'inc/overall/header.php'; ?>
  <h1>Add new lecturers</h1>

<form name="input" action="" method="post">

<table border="0">

<tr> <td>Emri:</td><td><input type="text" name="emri"></td></tr>
<tr><td>Mbiemri:</td><td><input type="text" name="mbiemri"></td></tr>
<tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Ruaj!"></td></tr>

</table>

</form>

<?php
if (empty ($_POST) == false)	// nese eshte dergu forma
{
if(empty ($_POST['emri']))
{
	$errors[] = "Ju lutemi plotesoni emrin";
}
if(empty ($_POST['mbiemri']))
{
	$errors[] = "Ju lutemi plotesoni mbiemrin";
}
if(empty($_POST['email']))
{
	$errors[] = "Ju lutemi plotesoni e-mail adresen";
}
}

if((empty($_POST) === false) && empty($errors) === true)
{
	$emri=$_POST["emri"];
	$mbiemri=$_POST["mbiemri"];
	$email=$_POST["email"];

	$query="INSERT INTO lecturer (id, name, surname, email)
				VALUES ('','$emri','$mbiemri','$email')";
	mysql_query($query);
	
	header('Location: newlecturer.php?success');
	exit();
}

else echo implode(", ", $errors); // shfaqja e errorave ne qofte se egzistojne	
	
	if(isset($_GET['success']) && empty($_GET['success']))	// nese eshte regjistruar shfaq notifikimin
	{
			echo "Te dhenat u ruajten me sukses ne databaze";
	}
	

?>
<?php include 'inc/overall/footer.php'; ?>