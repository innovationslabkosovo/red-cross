<?php
include '../init.php';
if(empty($_POST) === false) {

    $class_id = $_POST["id"];
    $location=$_POST["location"];
    $date_from=$_POST["date_from"];
    $date_to=$_POST["date_to"];
    $test=$_POST["test"];
    $trainer=$_POST["trainer"];
    $topic_data = $_POST["topic"];

    transpose($topic_data, $output);

    $class_name = "Kursi".$location;


    $edit_class_qs = "UPDATE Class set name='$class_name', trainer_id=$trainer, location_id=$location, date_from='$date_from', date_to='$date_to' WHERE class_id='$class_id'";
    if (mysql_query($edit_class_qs))
    {
        ob_clean();
        foreach ($output as $key=>$value)
        {
            //print_r($output);
            $edit_class_topics_qs = "UPDATE ClassTopic set  date='".$value['date_topic']."', time_from='".$value['time_from_topic']."', time_to='".$value['time_to_topic']."' WHERE topic_group_id=".$value['topic_group_id']."";
           // echo $edit_class_topics_qs;
            mysql_query($edit_class_topics_qs);
        }
        echo json_encode($_POST);

    }else{
        echo "asdasd";
    }


}