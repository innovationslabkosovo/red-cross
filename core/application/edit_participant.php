<?php
include '../init.php';
error_reporting(0);
if(empty($_POST) === false) {

    $participant_id = $_POST["id"];
    $first_name=$_POST["name"];
    $last_name=$_POST["surname"];
    $gender=$_POST["gender"];
    $age=$_POST["age"];
    $class_id=$_POST["class"];


    $edit_part_qs = "UPDATE Participant set name='$first_name', surname='$last_name', gender='$gender', age='$age'  WHERE participant_id=$participant_id";
    if (mysql_query($edit_part_qs))
    {
        ob_clean();
        $edit_part_class_qs = "UPDATE ParticipantClass set class_id=$class_id  WHERE participant_id=$participant_id";
        mysql_query($edit_part_class_qs);

        $mun_query = mysql_query("SELECT name from Class where class_id=".$class_id);
        $_POST['class'] = mysql_result($mun_query, 0, 'name');


        echo json_encode($_POST);

    }else{
        echo "asdasd";
    }


}