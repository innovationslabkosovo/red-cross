<?php
include '../init.php';
error_reporting(0);
if(empty($_POST) === false)
{

    $first_name=trim($_POST["first_name"]);
    $last_name=trim($_POST["last_name"]);
    $gender=$_POST["gender"];
    $age=trim($_POST["age"]);
    $class_id=$_POST["class"];



    if (mysql_query("INSERT INTO Participant(participant_id, name, surname, gender, age) VALUES ('', '$first_name' ,  '$last_name', '$gender', '$age' )"))
    {
        $participant_id = mysql_insert_id();

        mysql_query("INSERT INTO ParticipantClass(participant_id, class_id) VALUES ($participant_id, $class_id)");

        header("location: ../../views/list_participant.php?message=success&object=participant");
    }
    else
    {
        header("location: ../../views/create_participant.php?message=fail&object=participant");
    }
}
