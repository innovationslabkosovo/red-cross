<?php
include '../init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$year = $_POST["year"];
if ($year == ""){
    $year = date("Y");;
}

$datefrom = $year."-01-01";
$dateto = $year."-12-31";

//get locations of all classes, number of participants, class names and IDs
$get_classes=mysql_query("SELECT Municipality.municipality_id as m_id, Municipality.name as m_name, pc.participant_id as p_id, ((SELECT count(answer) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='para' and answer=1) / (SELECT count(*) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='para' )) as para_correct,
((SELECT count(answer) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='pas' and answer=1) / (SELECT count(*) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='pas' )) as pas_correct

FROM Class inner join Location on Class.location_id = Location.location_id inner join Municipality on Municipality.municipality_id = Location.municipality_id  inner join ParticipantClass as pc on pc.class_id = Class.class_id

and Class.date_from >= '$datefrom' and Class.date_to <= '$dateto'");

?>
<html>
<head>
    <title>Raporti Vjetor</title>
</head>
<body>
<h1>Raporti Vjetor për <?php print_r($_POST['year']); ?> </h1>
<?php
if (mysql_num_rows($get_classes) == 0) {
    echo "Në këtë vit nuk janë mbajtur kurse!";
    exit;
}
else {
?>
<table border="1">
    <tr>
        <th>Komuna</th>
        <th>Numri i Participanteve</th>
        <th>Suksesi i Para-testit</th>
        <th>Suksesi i Pas-testit</th>
    </tr>
    <?php
    $previous_municipality = 0;
    $participants = 0;
    $pre_success = 0;
    $post_success = 0;
    $counter = 0;

    while ($classes = mysql_fetch_assoc($get_classes)){

        if ($classes['m_id'] != $previous_municipality){

            if ($counter == 0){


            $municipality = $classes['m_name'];
            $participants += 1;
            $pre_success += $classes['para_correct'];
            $post_success += $classes['pas_correct'];

                $previous_municipality = $classes['m_id'];
                $counter++;
                continue;
            }

            if ($counter != 0){

            ?>
            <tr>
                <td><?php echo $municipality;?></td>
                <td><?php echo $participants;
                    if ($participants != 0){
                    ?></td>
                <td><?php echo $pre_success*100/$participants; echo"%";?></td>
                <td><?php echo $post_success*100/$participants; echo"%";
                    } else {
                    ?></td>
                <td></td>
                <td></td>
                <?php
                }
                    $municipality = $classes['m_name'];
                    $participants = 1;
                    $pre_success = $classes['para_correct'];
                    $post_success = $classes['pas_correct'];

                    $previous_municipality = $classes['m_id'];
                    $counter++;

              ?>
            </tr>
        <?php

            }
        }

        else {

            $previous_municipality = $classes['m_id'];
            $participants += 1;
            $pre_success += $classes['para_correct'];
            $post_success += $classes['pas_correct'];
        }
    }}?>

        <tr>
    <td><?php echo $municipality;?></td>
    <td><?php echo $participants;
        if ($participants != 0){
        ?></td>
    <td><?php echo $pre_success*100/$participants; echo"%";?></td>
    <td><?php echo $post_success*100/$participants; echo"%";
        } else {
        ?></td>
            <td></td>
            <td></td>
            <?php
            }
            ?>
    </tr>

</table>
</body>
<?php
include $project_root . 'views/layout/footer.php';
?>
</html>