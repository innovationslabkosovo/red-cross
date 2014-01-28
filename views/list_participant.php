<?php
$page_title = "Lista e klasave";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$get_participants = "SELECT p.*, c.name as class_name, c.class_id as class_id
                     FROM Participant p INNER JOIN ParticipantClass pc on p.participant_id=pc.participant_id INNER JOIN Class c on pc.class_id=c.class_id
                     ORDER BY p.name";
$participants = mysql_query($get_participants);

$get_class = "SELECT class_id, name FROM Class ";
$classes = mysql_query($get_class);

?>

<h1>Lista e Participanteve</h1>
<?php $base_url = BASE_URL; ?>
<?php echo "<div id='url' url='{$base_url}/core/application/edit_participant.php' ></div>";?>
<?php

if ($_GET['message'] != NULL)
{
    if ($_GET['message'] == 'success')
    {
        echo $display_messages[$_GET['object']][$_GET['message']];

    }else{
        echo $display_messages[$_GET['object']][$_GET['message']];
    }

}

?>
<table class="bordered">

    <tr>
        <th >Emri</th>
        <th >Mbiemri</th>
        <th >Mosha</th>
        <th >Gjinia</th>
        <th >Klasa</th>
    </tr>
<?php
while ($row_participant = mysql_fetch_assoc($participants))
{
    $participant_id = $row_participant["participant_id"];
    $name = $row_participant["name"];
    $surname = $row_participant["surname"];
    $age = $row_participant["age"];
    $gender = $row_participant["gender"];
    $class_id = $row_participant["class_id"];
    $class_name = $row_participant["class_name"];

    ?>
    <tr>
        <td >


        </td>
        <td >


        </td>
        <td >


        </td>
        <td >


        </td>
        <td ><span id='results_<?=$participant_id?>' class='text'> <?=$class_name?></span>
            <select size='1' id='editbox_<?=$participant_id?>' name='class' class='editbox class'>
                <option value=''>Zgjedh Klasen</option> ";<?php echo  create_options($classes, 'class_id', 'name', $class_id); ?>
        </td>
    </tr>

    <?php
}