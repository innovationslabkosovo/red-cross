<?php 
error_reporting(0);
include '../../core/init.php';
$page_title = 'Ndrysho Fjalkalimin';
include $project_root . '/views/layout/header.php';
$base_url = BASE_URL;

$get_email = $_GET['email'];
$code = $_GET['code'];
$password = $_POST['password'];
$password_again = $_POST['password_again'];
$validate = "SELECT * from User where email='$get_email' AND activiation_code='$code' AND verified = 1";
$check_validate = mysql_query($validate);
$querys="select * from User where email='$get_email' AND activiation_code='$code'";
$res = mysql_query($querys);
if (mysql_num_rows($check_validate)) {
	echo "Kodi i aktivizimit nuk mund te perdoret perseri!";
} else {
	if (mysql_num_rows($res)) {
		echo '<form name="change_password" id="change_password" action="" method="post">
		<ul>
		<li>
		<label for="password">Fjalkalimi i ri <span class="required">*</span></label><br><br>
		<input type="password" name="password" id="password" class="txfform-wrapper input" placeholder="Fjalkalimi i ri">
		</li><br>
		<li>
		<label for="password_again">Perserisni fjalkalimin e ri <span class="required">*</span></label><br><br>
		<input type="password" name="password_again" id="password_again" class="txfform-wrapper input" placeholder="Perserisni fjalkalimin e ri">
		</li>
		<li><br>
		<input type="submit" value="Ndrysho">
		</li>
		</ul>
		</form>';
		if (empty($_POST) === FALSE) {
			if (empty($password) || empty($password_again)) {
					echo "Te dy fushat jane te kerkuara!";
			} else if(trim($password) !== trim($password_again)) {
				echo "Fjalkalimet duhet te jene te njejta ne te dy fushat!";
			} else if (strlen($_POST['password']) < 6) {
				echo "Fjalekalimi juaj duhet te jete te pakten 6 karaktere!";
			} else {
				change_password_email($get_email, $password); 
				echo "Fjalkalimi juaj eshte nderruar, kthehuni ne balline dhe provoni te kyceni!";
			}
		}
	} else {
		echo "Perdoruese me kete adrese elektronike/kode nuk ekziston!";
	}
}
include $project_root . '/views/layout/footer.php';
