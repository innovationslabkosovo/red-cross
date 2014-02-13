<?php 
// error_reporting(0);
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
	$change_password = "$base_url/views/user/public_resetpass_view.php?email=$email&code=$code";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$message .= "
	<html>
	<body>
		<p>Keni harruar fjalkalimin!</p>
		<p>Krijoni nje te ri ketu:</p>
		<a href='$change_password'>$change_password</a>
	</body>
	</html>
	";

	// Use wordwrap() if lines are longer than 70 characters
	$message = wordwrap($message,70);

	// Send email
	mail($email,"Nderrimi i fjalkalimit", $message, $headers);
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