<?php
$page_title = "Raporti Mujor Komunal";

include '../init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$year = $_POST["year"];
if ($year == ""){
    $year = date("Y");;
}

$months = array(
    "01" => "Janar",
    "02" => "Shkurt",
    "03" => "Mars",
    "04" => "Prill",
    "05" => "Maj",
    "06" => "Qershor",
    "07" => "Korrik",
    "08" => "Gusht",
    "09" => "Shtator",
    "10" => "Tetor",
    "11" => "Nentor",
    "12" => "Dhjetor",
);

$datefrom = $year."-".$_POST['month']."-01";
$dateto = $year."-".$_POST['month']."-31";

//get name of selected municipality
$selected = $_POST['municipality'];
$get_municipality = mysql_query("SELECT name FROM Municipality where municipality_id='$selected'");
$municipality = mysql_fetch_assoc($get_municipality);


//get locations of all classes
$get_classes=mysql_query("SELECT Class.name as class, Location.name as location, ParticipantClass.participant_id as participants FROM Class inner join Location on Class.location_id = Location.location_id
                            inner join ParticipantClass on ParticipantClass.class_id = Class.class_id WHERE participant_id in
                            (SELECT COUNT(participant_id) from ParticipantClass inner join Class on ParticipantClass.class_id = Class.class_id) and Location.location_id IN
                           (Select location_id from Location where municipality_id = '$selected') and date_from >= '$datefrom' and date_to <= '$dateto'");




?>
<html>
<head>
    <title>Raporti Mujor Komunal</title>
</head>
<body>
<h1>Raporti Komunal per <?php print_r($months[$_POST['month']]); echo " dhe komunen "; echo $municipality['name']; ?> </h1>
<table border="1">
    <tr>
        <th>Lokacioni</th>
        <th>Klasa</th>
        <th>Numri i Participanteve</th>
        <th>Suksesi i Para-testit</th>
        <th>Suksesi i Pas-testit</th>
    </tr>
    <?php
    while ($classes = mysql_fetch_assoc($get_classes)){
        ?>
    <tr>
        <td><?php echo $classes['location'];?></td>
        <td><?php echo $classes['class'];?></td>
        <td><?php echo $classes['participants'];?></td>
        <td></td>
        <td></td>
    </tr>
    <?php
    }
    ?>
</table>


</body>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
</html>