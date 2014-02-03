<?php
$page_title = "Raportet e Punës së Kryqit të Kuq";

include '../core/init.php';
include $project_root . 'views/layout/header.php';

$get_municipalities = "SELECT municipality_id, name FROM Municipality";
$municipalities = mysql_query($get_municipalities);

$month = $_GET["month"];
if ($month == ""){
    $currentMonth = date('F');
    $month = Date('F', strtotime($currentMonth . " last month"));
}

$municipality = $_GET["municipality"];

?>
<html>
<head>
    <title>Raportet e Punës së Kryqit të Kuq</title>
</head>
<body>
<h1>Zgjidhni Vitin per Raportin Vjetor</h1>
<form action="../core/application/public_annual_report.php" method="POST">
    <div class="dropdown">
    <select name="year" class="dropdown-select">
        <option value="">Zgjidh Vitin</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
    </select>
    </div>
    <input type="submit" name="GO" value="Gjenero"/>
</form>
<hr>
</body>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
</html>