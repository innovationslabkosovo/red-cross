<?php
include '../init.php';
if(empty($_POST) === false) {

    $class_id = $_POST["class_id"];
    $location=$_POST["location"];
    $date_from=$_POST["date_from"];
    $date_to=$_POST["date_to"];
    $test=$_POST["test"];
    $trainer=$_POST["trainer"];
    $topic_data = $_POST["topic"];

    transpose($topic_data, $output);

    // print_r($output);
    //  print_r($topic_data);

    // exit;
    $class_name = "Kursi".$location;


    if (mysql_query("UPDATE Class set name='$class_name', trainer_id='$trainer', location_id='$location', date_from='$date_from', date_to='$date_to' WHERE class_id='$class_id'"))
    {
        ob_clean();
        foreach ($output as $key=>$value)
        {
            mysql_query("UPDATE ClassTopic set topic_group_id=".$value['topic_group_id'].", class_id=$class_id, date='".$value['date_topic']."', time_from='".$value['time_from_topic']."', time_to='".$value['time_to_topic']." WHERE class_id=$class_id");
        }
        echo json_encode($_POST);

    }
        mysql_query("update Question set description='$question_desc' where question_id='$id'");

}