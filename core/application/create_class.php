<?php
include '../init.php';
if(empty($_POST) === false)
{

    $location=$_POST["location"];
    $date_from=$_POST["date_from"];
    $date_to=$_POST["date_to"];
    $test=$_POST["test"];
    $trainer=$_POST["trainer"];
    $topic_data = $_POST["topic"];

    transpose($topic_data, $output);

    $loc_query = mysql_query("SELECT name from Location where location_id=".$location);
    $location_name = mysql_result($loc_query, 0, 'name');



    if ($num_rows = mysql_num_rows(mysql_query("SELECT * from Class where location_id=$location and date_from='$date_from'")))
    {
        if ($num_rows == 0)
        {
            $class_name = "Kursi-".$location_name."-".$date_from."";
        }else{
            $num_rows++;
            $class_name = "Kursi".$num_rows."-".$location_name."-".$date_from;
        }

    }
    else
    {
        $class_name = "Kursi-".$location_name."-".$date_from."";
    }


    if (mysql_query("INSERT INTO Class(class_id, name, trainer_id, location_id, test_id, date_from, date_to) VALUES ('', '$class_name' ,  '$trainer', '$location', '$test', '$date_from', '$date_to')"))
    {
        $class_id = mysql_insert_id();
        foreach ($output as $key=>$value)
        {
            mysql_query("INSERT INTO ClassTopic(topic_group_id, class_id, date, time_from, time_to) VALUES (".$value['topic_group_id'].", '$class_id' ,  '".$value['date_topic']."', '".$value['time_from_topic']."', '".$value['time_to_topic']."')");
        }

        header("location: ../../views/list_class.php?message=success&object=class");
    }
    else
    {
        header("location: ../../views/create_class.php?message=fail&object=class");
    }


}