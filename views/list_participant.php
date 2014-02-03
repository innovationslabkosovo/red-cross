<?php
error_reporting(0);
$page_title = "Lista e participanteve";
include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
include $project_root . 'views/layout/header.php';


$count_rows = mysql_query("SELECT count(*) FROM Participant");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
$get_participants = "SELECT  p.*, c.name as class_name, c.class_id as class_id
                     FROM Participant as p INNER JOIN ParticipantClass as pc on p.participant_id=pc.participant_id INNER JOIN Class as c on pc.class_id=c.class_id
                     ORDER BY p.name
                     $pages->limit";
$participants = mysql_query($get_participants);
?>
<span class="message">
    <?php
    if (isset($_GET['message']))
    {
        if ($_GET['message'] == 'success')
        {
            echo $display_messages[$_GET['object']][$_GET['message']];

        }else{
            echo $display_messages[$_GET['object']][$_GET['message']];
        }

    }
    ?>

</span>

<h1>Lista e Participanteve</h1>
<?php $base_url = BASE_URL; ?>
<?php echo "<div id='url' url='{$base_url}/core/application/edit_participant.php' ></div>";?>
<?php



?>
<table class="bordered">

    <tr>
        <th >Emri</th>
        <th >Mbiemri</th>
        <th >Mosha</th>
        <th >Gjinia</th>
        <th >Klasa</th>
        <th >Modifiko</th>
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

    $get_class = "SELECT class_id, name FROM Class ";
    $classes = mysql_query($get_class);


    ?>
    <tr>
        <td>
            <span id='results_<?=$participant_id?>' class='text'> <?=$name?> </span>
            <input type='text' size='10' name='name' id='editbox_<?=$participant_id?>' value='<?=$name?>' class='editbox name'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$surname?> </span>
            <input type='text' size='10' name='surname' id='editbox_<?=$participant_id?>' value='<?=$surname?>' class='editbox surname'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$age?> </span>
            <input type='number' size='10' name='age' id='editbox_<?=$participant_id?>' value='<?=$age?>' class='editbox age'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$gender?> </span>
            <select size='1' id='editbox_<?=$participant_id?>' name='gender' class='editbox gender'>
                <option value="M" <?php if ($gender =="M") echo "selected"; ?> >Mashkull</option>
                <option value="F" <?php if ($gender =="F") echo "selected"; ?> >Femer</option>
            </select>
        </td>

        <td ><span id='results_<?=$participant_id?>' class='text'> <?=$class_name?></span>
            <select size='1' id='editbox_<?=$participant_id?>' name='class' class='editbox class'>
                <option value=''>Zgjedh Klasen</option> ";<?php echo  create_options($classes, 'class_id', 'name', $class_id); ?>
        </td>

        <td>
            <input type='hidden' name='id' class='editbox' id='editbox_<?=$participant_id?>' value='<?=$participant_id?>' />
            <input type='button' value='Ruaj' class='save submitSmlBtn' id='<?=$participant_id?>'>
            <input type='button' value='Perditeso' class='edit submitSmlBtn' id='<?=$participant_id?>'>
            <input type='button' value='Anulo' class='cancel submitSmlBtn' id='<?=$participant_id?>' style='display:none;'>
        </td >
    </tr>

    <?php
}



echo $pages->display_pages();
echo "&nbsp &nbsp";
echo $pages->display_jump_menu();
echo "&nbsp &nbsp";
echo $pages->display_items_per_page();
echo "<br><br>";
echo $pages->next_page;
echo $pages->prev_page;