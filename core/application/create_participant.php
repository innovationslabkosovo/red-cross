<?php
include '../init.php';
error_reporting(0);
if(empty($_POST) === false)
{

    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $gender=$_POST["gender"];
    $age=$_POST["age"];
    $class_id=$_POST["class"];

    $c = 0;
    foreach ($first_name as $key => $value) {
        if($value != null){

            if($last_name[$c] != null && $gender[$c] != null && $age[$c] != null){
                $query = mysql_query("INSERT INTO Participant(participant_id, name, surname, gender, age) VALUES ('', '$value' ,  '{$last_name[$c]}', '{$gender[$c]}', '{$age[$c]}' ) ");
            
                if ($query)
                {
                    $participant_id = mysql_insert_id();

                    mysql_query("INSERT INTO ParticipantClass(participant_id, class_id) VALUES ($participant_id, $class_id)");

                    $c++;      
                } 
            }
                 
        }

    }


    if($query){
        header("location: ../../views/list_participant.php?message=success&object=participant");
    }else{
        header("location: ../../views/create_participant.php?message=fail&object=participant");
    }
            
}
