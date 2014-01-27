<?php
$page_title = "Raporti Mujor Komunal";

include '../core/init.php';
protect_page();
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
    <title>Raporti Mujor Komunal</title>
</head>
<body>
<h2>Raporti Mujor Komunal per Muajin: <?php print_r($month); ?> </h2>
<select name="forma" onchange="location = this.options[this.selectedIndex].value;">
    <option value="">Zgjidh Muajin</option>
    <option value="municipal_report.php?month=01">Janar</option>
    <option value="municipal_report.php?month=02">Shkurt</option>
    <option value="municipal_report.php?month=03">Mars</option>
    <option value="municipal_report.php?month=04">Prill</option>
    <option value="municipal_report.php?month=05">Maj</option>
    <option value="municipal_report.php?month=06">Qershor</option>
    <option value="municipal_report.php?month=07">Korrik</option>
    <option value="municipal_report.php?month=08">Gusht</option>
    <option value="municipal_report.php?month=09">Shtator</option>
    <option value="municipal_report.php?month=10">Tetor</option>
    <option value="municipal_report.php?month=11">Nentor</option>
    <option value="municipal_report.php?month=12">Dhjetor</option>
</select>

<select name="municipality">
    <option value=0>Zgjidh Komunen
        <?php
        while($row = mysql_fetch_array($municipalities))
        {
            $name=$row["name"];
            $select=$row["municipality_id"];
            echo "<OPTION VALUE=\"$select\">".$name.'</option>';
        }
        ?>
</select>

<h2>Raporti Komunal per: <?php print_r($municipality); ?> </h2>



</body>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
</html>