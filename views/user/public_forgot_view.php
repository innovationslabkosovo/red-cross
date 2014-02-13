<?php 
error_reporting(0);
include '../../core/init.php';
$page_title = 'Nderro Fjalkalimin';
include $project_root . '/views/layout/header.php';
$base_url = BASE_URL;


$email=$_POST['email'];
if($_POST['submit'] == 'Dergo')
{

$query="select * from User where email='$email'";
$result=mysql_query($query) or die(error);

if(mysql_num_rows($result))
{
	$code = generateRandomString();
	mysql_query("Update User SET activiation_code = '$code', verified = 0 WHERE email = '$email'");
	echo $message="Mund ta nderroni Fjalkalimin ketu: <a href=''>$base_url/views/user/public_resetpass_view.php?email=$email&code=$code</a>";
	// mail($email, "Red Cross - Nderroni Fjalkalimin!", $message);
	// echo "Shikoni adresen elektronike keni pranuar nje email per te nderruar fjalkalimin!";
}
else
{
	echo "Nuk ekziston perdoruese me kete adrese elektronike";
}
}
?>
<form action="public_forgot_view.php" method="post">
Shkruani adresen elektronike: <br><br><input type="text" name="email" class="txfform-wrapper input"><br><br>
<input type="submit" name="submit" value="Dergo">
</form>

<?php include $project_root . '/views/layout/footer.php';
