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


//get locations of all classes, number of participants, class names and IDs
$get_classes=mysql_query("SELECT DISTINCT Class.class_id, Class.name as class, Trainer.name as trainer_name, Trainer.surname as surname, Location.name as location, (SELECT COUNT(*) from ParticipantClass as ipc WHERE ipc.class_id = Class.class_id ) as participants, (Select COUNT(*) from ParticipantClass as ipc inner join Participant on Participant.participant_id = ipc.participant_id WHERE ipc.class_id = Class.class_id and Participant.gender = 'M') as male, (Select COUNT(*) from ParticipantClass as ipc inner join Participant on Participant.participant_id = ipc.participant_id WHERE ipc.class_id = Class.class_id and Participant.gender = 'F') as female
                          FROM Class inner join Location on Class.location_id = Location.location_id inner join ParticipantClass on ParticipantClass.class_id = Class.class_id inner join Trainer on Trainer.trainer_id = Class.trainer_id
                          WHERE Location.location_id IN (Select location_id from Location where municipality_id = '$selected') and date_from >= '$datefrom' and date_to <= '$dateto'");

?>
<html>
<head>
    <title>Raporti Mujor Komunal</title>
</head>
<body>
<h1>Raporti Komunal për <?php print_r($months[$_POST['month']]); echo " dhe komunën "; echo $municipality['name']; ?> </h1>

    <?php
    if (mysql_num_rows($get_classes) == 0) {
        echo "Në këtë komunë nuk janë mbajtur kurse gjatë muajit që keni zgjedhur!";
        exit;
    }
    else {
    ?>
    <table border="1" class="bordered">
    <tr>
        <th>Lokacioni</th>
        <th>Kursi</th>
        <th>Trajneri</th>
        <th>Numri i Participanteve</th>
        <th>M</th>
        <th>F</th>
        <th>Suksesi i Para-testit</th>
        <th>Suksesi i Pas-testit</th>
        <th>Ndryshimi</th>
    </tr>
    <?php
        while ($classes = mysql_fetch_assoc($get_classes)){

        //get only IDs of classes
        $classes_id = $classes['class_id'];
        $get_pre_success=mysql_query("SELECT COUNT(answer) as sum FROM ParticipantAnswer WHERE participant_id IN (SELECT participant_id from ParticipantClass where class_id = '$classes_id') and type = 'para'");
        $get_post_success=mysql_query("SELECT COUNT(answer) as sum FROM ParticipantAnswer WHERE participant_id IN (SELECT participant_id from ParticipantClass where class_id = '$classes_id') and type = 'pas'");
        $get_pre_success1=mysql_query("SELECT COUNT(answer) as sum FROM ParticipantAnswer WHERE participant_id IN (SELECT participant_id from ParticipantClass where class_id = '$classes_id') and type = 'para' and answer='1'");
        $get_post_success1=mysql_query("SELECT COUNT(answer) as sum FROM ParticipantAnswer WHERE participant_id IN (SELECT participant_id from ParticipantClass where class_id = '$classes_id') and type = 'pas' and answer='1'");

        $q1 = mysql_fetch_assoc($get_pre_success);
        $q2 = mysql_fetch_assoc($get_post_success);
        $q3 = mysql_fetch_assoc($get_pre_success1);
        $q4 = mysql_fetch_assoc($get_post_success1);
        $pre = round($q3['sum']*100/$q1['sum'], 2);
        $post = round($q4['sum']*100/$q2['sum'], 2);
        ?>
        <tr>
            <td><?php echo $classes['location'];?></td>
            <td><?php echo $classes['class'];?></td>
            <td><?php echo $classes['trainer_name']." ".$classes['surname'];?></td>
            <td><?php echo $classes['participants'];
            if ($classes['participants'] != 0){
            ?></td>
                <td><?php echo $classes['male'];?></td>
                <td><?php echo $classes['female'];?></td>
            <td><?php echo $pre; echo"%";?></td>
            <td><?php echo $post; echo"%";?></td>
            <td><?php echo $post-$pre; echo"%";?></td>
        </tr>
        <?php
            } else {
                ?>
                <td></td>
                <td></td>
                <?php
            }
        }
    }
    ?>
</table>
</body>
<?php
include $project_root . 'views/layout/footer.php';
?>
</html>