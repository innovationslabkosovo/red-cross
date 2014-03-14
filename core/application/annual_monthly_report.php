<?php
include '../init.php';
include $project_root . 'views/layout/header.php';

$datefrom = $_POST['date_from'];
$dateto = $_POST['date_to'];


//get locations of all classes, number of participants, class names and IDs
$get_classes=mysql_query("SELECT Municipality.municipality_id as m_id, Municipality.name as m_name, pc.participant_id as p_id, par.gender, ((SELECT count(answer) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='para' and answer=1) / (SELECT count(*) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='para' )) as para_correct,
((SELECT count(answer) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='pas' and answer=1) / (SELECT count(*) from ParticipantAnswer as pa where pa.participant_id=pc.participant_id and pa.type='pas' )) as pas_correct

FROM Class inner join Location on Class.location_id = Location.location_id inner join Municipality on Municipality.municipality_id = Location.municipality_id  inner join ParticipantClass as pc on pc.class_id = Class.class_id inner join Participant as par on par.participant_id = pc.participant_id

and Class.date_to >= '$datefrom' and Class.date_to <= '$dateto' order by m_id ASC");

?>
<html>
<head>
    <title>Raporti Periodik </title>
</head>
<body>
<div id = 'content'>

<h1>Raporti për periudhën <?php print_r($_POST['date_from']); echo " deri më "; print_r($_POST['date_to']); ?> </h1>
<?php
if (mysql_num_rows($get_classes) == 0) {
    echo "Në këtë periudhë nuk është mbajtur apo përfunduar asnjë kurs!";
    exit;
}
else {
?>
<table border="1" class="bordered">
    <tr>
        <th>Komuna</th>
        <th>Numri i Participanteve</th>
        <th>M</th>
        <th>F</th>
        <th>Suksesi i Para-testit</th>
        <th>Suksesi i Pas-testit</th>
        <th>Ndryshimi</th>
    </tr>
    <?php
    //these keep track of records per municipality
    $previous_municipality = 0;
    $participants = 0;
    $pre_success = 0;
    $post_success = 0;
    $gender_m = 0;
    $gender_f = 0;
    $counter = 0;

    //these keep track of overall records
    $total_counter = 1;
    $count_participants = array();
    $total_males = 0;
    $total_females = 0;
    $total_pre = 0;
    $total_post = 0;
    $total_change = 0;

    while ($classes = mysql_fetch_assoc($get_classes)){

        //check if we are talking about the same municipality as before
        //if not we need to get the data about the new municipality
        if ($classes['m_id'] != $previous_municipality){

            //the first time we need to see if the second row, i.e. municipality will be the same as the first one
            if ($counter == 0){

            $municipality = $classes['m_name'];
            $participants += 1;
            $count_participants[0]+=1;

                if ($classes['gender'] == "M"){
                    $gender_m += 1;
                    $count_participants[1] += 1;
                }
                else {
                    $gender_f += 1;
                    $count_participants[2] += 1;
                }

            $pre_success += $classes['para_correct'];
            $post_success += $classes['pas_correct'];
            $previous_municipality = $classes['m_id'];
            $counter++;
            continue;

            }

            //if we are not talking about the first municipality then go ahead and display the current data
            if ($counter != 0){
            ?>
            <tr>
                <td><?php echo $municipality;?></td>
                <td><?php echo $participants;
                    //if there are participants
                    if ($participants != 0){
                    $pre = round($pre_success*100/$participants, 2);
                    $post = round($post_success*100/$participants, 2);
                    $change = $post-$pre;
                    $total_pre += $pre*$participants;
                    $total_post += $post*$participants;
                    ?></td>
                <td><?php echo $gender_m; ?></td>
                <td><?php echo $gender_f; ?></td>
                <td><?php echo $pre; echo"%";?></td>
                <td><?php echo $post; echo"%";?></td>
                <td><?php echo $change; echo"%";?></td>
                <?php
                    }
                    //else, participants is 1
                    else {
                    ?>
                <td></td>
                <td></td>
                <td></td>
                <?php
                }
                $municipality = $classes['m_name'];
                $participants = 1;
                $count_participants[0]+=1;

                if ($classes['gender'] == "M"){
                    $gender_m = 1;
                    $gender_f = 0;
                    $count_participants[1] += 1;
                }
                else {
                    $gender_f = 1;
                    $gender_m = 0;
                    $count_participants[2] += 1;
                }

                $pre_success = $classes['para_correct'];
                $post_success = $classes['pas_correct'];
                $previous_municipality = $classes['m_id'];
                $counter++;
                $total_counter++;
              ?>
            </tr>
        <?php

            }
        }

        //this part handles the data for the same municipality as previous one
        else {

            $previous_municipality = $classes['m_id'];
            $participants += 1;
            $count_participants[0]+=1;

            if ($classes['gender'] == "M"){
                $gender_m += 1;
                $count_participants[1] += 1;
            }
            else {
                $gender_f += 1;
                $count_participants[2] += 1;
            }
            $pre_success += $classes['para_correct'];
            $post_success += $classes['pas_correct'];

        }
    }}
    ?>

    <tr>
    <td><?php echo $municipality;?></td>
    <td><?php echo $participants;
        if ($participants != 0){
        $pre = round($pre_success*100/$participants, 2);
        $post = round($post_success*100/$participants, 2);
        $change = $post-$pre;
        $total_pre += $pre * $participants;
        $total_post += $post * $participants;
        ?></td>
            <td><?php echo $gender_m; ?></td>
            <td><?php echo $gender_f; ?></td>
            <td><?php echo $pre; echo"%";?></td>
            <td><?php echo $post; echo"%";?></td>
            <td><?php echo $change; echo"%";?></td>
            <?php
            }
            else {
            ?>
                <td></td>
                <td></td>
                <td></td>

            <?php
            }

            ?>
    </tr>
    <td>Totali</td>
    <td><?php echo $count_participants[0];?></td>
    <td><?php echo $count_participants[1];?></td>
    <td><?php echo $count_participants[2];?></td>
    <td><?php echo round($total_pre/$count_participants[0], 2); echo"%";?></td>
    <td><?php echo round($total_post/$count_participants[0], 2); echo"%";?></td>
    <td><?php echo round(($total_post-$total_pre)/$count_participants[0], 2); echo"%";?></td>
    
</table>
</div>

<form>
    <input id="printBtn" type="button" value="print" />
</form>

</body>

<script type="text/javascript">
$("#printBtn").click(function(){
    printcontent($("#content").html());
});

</script>
<?php
include $project_root . 'views/layout/footer.php';
?>
</html>