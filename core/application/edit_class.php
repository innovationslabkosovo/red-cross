<?php
error_reporting(0);
include '../init.php';
if(empty($_POST) === false) {

    $class_id = $_POST["id"];
    $municipality = $_POST["municipality"];
    $location=$_POST["location"];
    $date_from=$_POST["date_from"];
    $date_to=$_POST["date_to"];
    $test=$_POST["test"];
    $trainer=$_POST["trainer"];
    $topic_data = $_POST["topic"];

    transpose($topic_data, $output);

    $loc_query = mysql_query("SELECT name from Location where location_id=".$location);
    $location_name = mysql_result($loc_query, 0, 'name');
    $class_name = "Kursi-".$location_name."-".$date_from;


    $edit_class_qs = "UPDATE Class set name='$class_name', trainer_id=$trainer, location_id=$location, date_from='$date_from', date_to='$date_to' WHERE class_id='$class_id'";
    if (mysql_query($edit_class_qs))
    {
        ob_clean();

        $mun_query = mysql_query("SELECT name from Municipality where municipality_id=".$municipality);
        $_POST['municipality'] = mysql_result($mun_query, 0, 'name');

        $location_query = mysql_query("SELECT name from Location where location_id=".$location);
        $_POST['location'] = mysql_result($location_query, 0, 'name');

        $trainer_query = mysql_query("SELECT name from Trainer where trainer_id=".$trainer);
        $_POST['trainer'] = mysql_result($trainer_query, 0, 'name');

        foreach ($output as $key=>$value)
        {
            //print_r($value);
            $edit_class_topics_qs = "UPDATE ClassTopic set  date='".$value['date_topic']."', time_from='".$value['time_from_topic']."', time_to='".$value['time_to_topic']."' WHERE topic_group_id=".$value['topic_group_id']."";
           // echo $edit_class_topics_qs;
            mysql_query($edit_class_topics_qs);
        }
        echo json_encode($_POST);

    }else{
        echo "asdasd";
    }


}