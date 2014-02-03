<?php
include '../init.php';
error_reporting(0);
if(empty($_POST) === false) {

    $participant_id = $_POST["participant_id"];
    $test_id = $_POST['test_id'];
    $participant_answers = $_POST['pa'];
    $participant_success = 1;

    transpose($participant_answers, $pa);

    // delete all answers first
    $delete_qs = "DELETE FROM ParticipantAnswer where participant_id=".$participant_id;
    if (mysql_query($delete_qs))
    {
        foreach ($pa as $answer_row)
        {
            foreach($answer_row as $answer_type => $answers)
            {
                foreach($answers as $q_id => $answer)
                {
                    // add answers for each question, before and after test
                    $add_answers_qs = "INSERT INTO ParticipantAnswer (test_id, question_id, participant_id, answer, type) VALUES ('".$test_id."', '".$q_id."', '".$participant_id."', '".$answer."', '".$answer_type."')";
                    if (mysql_query($add_answers_qs))
                    {
                        $participant_success =1;
                    }
                    else{
                        $participant_success = 0;

                    }

                }


            }

        }
        if ($participant_success)
        {
            header("location: ../../views/participant_answer.php?p_id=$participant_id&message=success&object=participant_answer");
        }
        else
        {
            header("location: ../../views/participant_answer.php?p_id=$participant_id&message=fail&object=participant_answer");
        }

    }
    else{
        header("location: ../../views/participant_answer.php?p_id=$participant_id&message=fail&object=participant_answer");
    }


}