<?php
include '../../config/config.php';

if(empty($_POST) === false)
{

    if(isset($_POST['topic_group']) && $_POST["topic_group"] != "") {

        $topic_group=$_POST["topic_group"];


        if(isset($_POST['active']) && $_POST['active'] == 'active')
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

    else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
    {
        $rowID = $_POST["hidDelete"];

       try
        {

            if (mysql_query("DELETE FROM TopicGroup where topic_group_id='$rowID'"))
                header("location: ../../views/create_topic_group.php?message=success&object=TopicGroupDelete");
            else throw new Exception('Grupi tematik nuk mund te fshihet per shkak se ka tema aktive qe i takojne!');

        }
        catch (Exception $e) {
                header("location: ../../views/create_topic_group.php?message=fail&object=TopicGroupDelete");
        }


    }

}