<?php 
$page_title = "Shto kategori";
include '../core/init.php';
protect_page();
$errors = array();
include $project_root . 'views/layout/header.php'; ?>
	<h1>Add new category</h1>
<form action="" method="post">


<table border="0">
<tr>
<td>Emri i kategorise:</td><td><input type="text" name="kategoria"></td>
</tr>
<tr>
<td>&nbsp;</td><td><input type="submit" value="Ruaj!"></td>
</tr>
</table>

</form>

<?php
if (empty ($_POST) == false)	// nese eshte dergu forma
{
if(empty ($_POST['kategoria']))
{
	$errors[] = "Ju lutemi mbushni te dhenat";	
}
}

if(empty($_POST['kategoria']) == false && empty($errors) == true) 
{
	//inserto ne db
	$kategoria=$_POST["kategoria"];

	$query="INSERT INTO  category(id, name)
				VALUES ('','$kategoria')";
	mysql_query($query);
	echo "Te dhenat u ruajten me sukses ne databaze!\n";
}
else echo implode("", $errors);	

	
?>
<?php include 'inc/overall/footer.php'; ?>