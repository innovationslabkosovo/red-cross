<?php
$username = "root";
$password = "root";
$hostname = "localhost";
$dbname = "red_cross";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

$selected = mysql_select_db($dbname,$dbhandle)
or die("Could not find Red Cross Database");
