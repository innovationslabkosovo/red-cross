 <?php
$username = "root";
$password = "admin";
$hostname = "localhost";
$dbname = "red_cross";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
mysql_set_charset("utf8", $dbhandle);

$selected = mysql_select_db($dbname,$dbhandle)
or die("Could not find Red Cross Database");

?>