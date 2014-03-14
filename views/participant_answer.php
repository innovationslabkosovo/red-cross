<?php
$page_title = "Pergjegjet e Pjesmarresve";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';


if (isset($_GET['message']))
{
    if ($_GET['message'] == 'success')
    {
        echo $display_messages[$_GET['object']][$_GET['message']];
        echo "<br>";
        echo "<br>";
        echo "<br>";

    }else{
        echo $display_messages[$_GET['object']][$_GET['message']];
        echo "<br>";
        echo "<br>";
        echo "<br>";
    }

}

if (isset($_GET['p_id']))
{

$participant_id= $_GET['p_id'];
$mun_id = $_GET['mun_id'];
$class_id = $_GET['class_id'];
$get_details = "SELECT p.name as p_name, p.surname, p.gender,p.age , t.test_id as test_id, t.name as test_name, cs.name as class_name FROM Participant p INNER JOIN ParticipantClass pc on  p.participant_id=pc.participant_id
                                                             INNER JOIN Class cs on cs.class_id=pc.class_id
                                                             INNER JOIN Test t on cs.test_id=t.test_id
                                                             where p.participant_id=$participant_id";

$get_details_query = mysql_query($get_details);

$p_name = mysql_result($get_details_query , 0, 'p_name');
$p_surname = mysql_result($get_details_query , 0, 'surname');
$p_gender = mysql_result($get_details_query , 0, 'gender');
$p_age = mysql_result($get_details_query , 0, 'age');
$test_name = mysql_result($get_details_query , 0, 'test_name');
$test_id = mysql_result($get_details_query , 0, 'test_id');
$class_name= mysql_result($get_details_query , 0, 'class_name');


$get_questions = "SELECT q.question_id, q.description from Question q INNER JOIN TestQuestion tq on q.question_id=tq.question_id
                                                      INNER JOIN Test t on tq.test_id=t.test_id
                                                      INNER JOIN Class cs on cs.test_id=t.test_id
                                                      INNER JOIN ParticipantClass pc on pc.class_id=cs.class_id
                                                      WHERE pc.participant_id=$participant_id";
$participant_question_query = mysql_query($get_questions);

$i=0;
while($row_q=mysql_fetch_assoc($participant_question_query))
{
    $participant_question[$i]['question_id'] = $row_q['question_id'];
    $participant_question[$i]['description'] = $row_q['description'];
    $i++;
}

$get_answers = "SELECT pa.question_id, pa.answer, pa.type from ParticipantAnswer pa WHERE pa.participant_id=$participant_id";
$participant_answers_query = mysql_query($get_answers);

while($row_a = mysql_fetch_assoc($participant_answers_query))
{
    $participant_answer[$row_a['question_id']][$row_a['type']] = $row_a['answer'];
}
?>

Pjesemarresi: <strong><?=$p_name?> <?=$p_surname?></strong>
<br>
Gjinia:<strong> <?=$p_gender?></strong>
<br>
Mosha:<strong> <?=$p_age?></strong>
<br>
Modeli i Testit:<strong> <?=$test_name?></strong>
<br>
Kursi:<strong> <?=$class_name?></strong>
<br><br>
<br><br>

<form action="../core/application/add_participant_answers.php" method="post">
    <input type="hidden" value="<?=$participant_id?>" name="participant_id" id="participant_id">
    <input type="hidden" value="<?=$test_id?>" name="test_id" id="test_id">
<table class="bordered">
<tr>
    <th>
        Pyetja
    </th>

    <th>
        Pergjegjja <strong>para</strong> testit
    </th>

    <th>
        Pergjegjja <strong>pas</strong> testit
    </th>

</tr>
<?php
foreach ($participant_question as $key=>$value)
{
    $para_false ="";
    $para_true ="";
    $pas_false ="";
    $pas_true ="";
    ?>
    <tr>
        <td>
            <input type="hidden" name="ps[question_id][]" value="<?=$value['question_id']?>">
            <?=$value['description']?>
        </td>

        <td>
            <?php
            if (isset($participant_answer[$value['question_id']]['para']))
            {
                 if ($participant_answer[$value['question_id']]['para'] == 0){
                    $para_false = "checked";
                    $para_true = "";
                }else{
                    $para_false = "";
                    $para_true = "checked";
                }
            }

            ?>
            <br>
            <label>E Sakte</label><input type="radio" name="pa[<?=$value['question_id']?>][para][]" value="1" <?php echo $para_true; ?>> <br>
            <label>E Pasakte</label><input type="radio" name="pa[<?=$value['question_id']?>][para][]" value="0" <?php echo $para_false; ?>>
        </td>

        <td>
            <?php
            if (isset($participant_answer[$value['question_id']]['pas']))
            {
                if ($participant_answer[$value['question_id']]['pas'] == 0){
                    $pas_false = "checked";
                    $pas_true = "";
                }else{
                    $pas_false = "";
                    $pas_true = "checked";
                }
            }

            ?>
            <br>
            <label>E Sakte</label><input type="radio" name="pa[<?=$value['question_id']?>][pas][]" value="1" <?php echo $pas_true; ?>> <br>
            <label>E Pasakte</label><input type="radio" name="pa[<?=$value['question_id']?>][pas][]" value="0" <?php echo $pas_false; ?>>
        </td>
    </tr>

    <?php
}
?>

</table>
<br>
    <input type="submit" value="Dergo" id="submit">
    <input type="button" value="Anulo" id="cancel_answer" class="submitSmlBtn" onclick="location.href='participant_answer.php?p_id=<?=$participant_id?>';">
    <a class="submitSmlBtn" href="find_participant.php?p_id=<?php echo $participant_id; ?>&mun_id=<?php echo $mun_id; ?>&c_id=<?php echo $class_id; ?>">Listo Participantet</a>

</form>
<?php
}else{
    echo "Participant nuk eshte zgjedhur";
}

include $project_root . 'views/layout/footer.php'; ?>
