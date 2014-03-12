<?php
error_reporting(0);
$page_title = "Lista e Participanteve";
include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
include $project_root . 'views/layout/header.php';


$user_id = $_SESSION['id'];
$mun_access = "";
$include_user = "";
if (!is_admin($user_id))
{
    $include_user = ",Location l, Municipality m, User u ";
    $mun_access = "and c.location_id = l.location_id and l.municipality_id = m.municipality_id and m.municipality_id = u.municipality_id and u.user_id=$user_id";
}


$count_rows = mysql_query("SELECT count(*) FROM Participant p, ParticipantClass pc, Class c ".$include_user."
                     WHERE p.participant_id=pc.participant_id and
                     pc.class_id=c.class_id ".$mun_access."
                     ORDER BY p.name");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
$get_participants = "SELECT  p.*, c.name as class_name, c.class_id as class_id
                     FROM Participant p, ParticipantClass pc, Class c ".$include_user."
                     WHERE p.participant_id=pc.participant_id and
                     pc.class_id=c.class_id ".$mun_access."
                     ORDER BY p.participant_id desc
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
<form id="url" action="../core/application/edit_participant.php" class="edit_participant_view">
<div class="form-error-message hide"></div>
<table class="bordered">

    <tr>
        <th >Emri</th>
        <th >Mbiemri</th>
        <th >Mosha</th>
        <th >Gjinia</th>
        <th >Kursi</th>
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
            <input type='text' size='10' name='name' data-validation='required' value='<?=$name?>' class='editbox_<?=$participant_id?> editbox name'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$surname?> </span>
            <input type='text' size='10' name='surname' id='' value='<?=$surname?>' class='editbox_<?=$participant_id?> editbox surname'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$age?> </span>
            <input type='number' size='10' name='age' value='<?=$age?>' class='editbox_<?=$participant_id?> editbox age'>
        </td>

        <td><span id='results_<?=$participant_id?>' class='text'> <?=$gender?> </span>
            <select size='1' name='gender' class='editbox_<?=$participant_id?> editbox gender'>
                <option value="M" <?php if ($gender =="M") echo "selected"; ?> >Mashkull</option>
                <option value="F" <?php if ($gender =="F") echo "selected"; ?> >Femer</option>
            </select>
        </td>

        <td ><span id='results_<?=$participant_id?>' class='text'> <?=$class_name?></span>
            <select size='1' name='class' class='editbox_<?=$participant_id?> editbox class'>
                <option value=''>Zgjedh Kursin</option> ";<?php echo  create_options($classes, 'class_id', 'name', $class_id); ?>
        </td>

        <td>
            <input type='hidden' name='id' class='editbox_<?=$participant_id?> editbox' id='' value='<?=$participant_id?>' />
            <input type='button' value='Ruaj' class='save_<?=$participant_id?> save submitSmlBtn' id='<?=$participant_id?>'>
            <input type='button' value='Perditeso' class='edit_<?=$participant_id?> edit submitSmlBtn' id='<?=$participant_id?>'>
            <input type="button" value="Anulo" class="cancel_<?=$participant_id?> cancel submitSmlBtn" id="<?=$participant_id?>" style="display: none;">
        </td>
    </tr>
    </form>
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