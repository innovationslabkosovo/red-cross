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
<h2>Raporti Komunal per Muajin: <?php print_r($month); ?> </h2>

<form action="../core/application/municipal_report.php" method="POST">
    <select name="year">
        <option value="">Zgjidh Vitin</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
    </select>

    <select name="month">
        <option value="">Zgjidh Muajin</option>
        <option value="01">Janar</option>
        <option value="02">Shkurt</option>
        <option value="03">Mars</option>
        <option value="04">Prill</option>
        <option value="05">Maj</option>
        <option value="06">Qershor</option>
        <option value="07">Korrik</option>
        <option value="08">Gusht</option>
        <option value="09">Shtator</option>
        <option value="10">Tetor</option>
        <option value="11">Nentor</option>
        <option value="12">Dhjetor</option>
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
    <input type="submit" name="GO" value="Gjenero"/>
</form>
</body>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
</html>