<?php
include '../../config/config.php';
if(empty($_POST) === false)
{

    $topic_group=$_POST["topic_group"];

    if(isset($_POST['active']) &&
        $_POST['active'] == 'active')
    {
        $active = 1;
    }
    else
    {
        $active = 0;
    }


    if (mysql_query("INSERT INTO TopicGroup(topic_group_id, name, active) VALUES ('', '$topic_group' ,  '$active')"))
        header("location: ../../views/create_topic_group.php?message=success&object=TopicGroup");
    else header("location: ../../views/create_topic_group.php?message=fail&object=TopicGroup");


}