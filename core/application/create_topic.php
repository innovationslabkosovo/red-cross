<?php
include '../../config/config.php';

if(empty($_POST) === false)
{
    if(isset($_POST['topic']) && $_POST["topic"] != "" && $_POST['id'] == "") {

        $topic_group=$_POST["topic"];


        if(isset($_POST['active']) && $_POST['active'] == 'active')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }


        if (mysql_query("INSERT INTO Topic(topic_group_id, name, active) VALUES ('', '$topic_group' ,  '$active')"))
            header("location: ../../views/view_topic_groups.php?message=success&object=TopicGroup");
        else header("location: ../../views/create_topic_group.php?message=fail&object=TopicGroup");

    }

    if(isset($_POST['topic_group']) && $_POST["topic_group"] == "") {
        //header("location: ../../views/create_topic_group.php?message=fail&object=TopicGroup");
        $data = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TopicGroup');
        ob_clean();
        echo json_encode($data);
    }

    if($_POST['id']) {
        $id=mysql_real_escape_string($_POST['id']);
        $topic_group_edit=mysql_real_escape_string($_POST['topic_group']);
        $topic_group_status_edit=mysql_real_escape_string($_POST['status']);
        mysql_query("update TopicGroup set name='$topic_group_edit', active='$topic_group_status_edit' where topic_group_id='$id'");
        $data = array( 'rowID' => '0', 'message' => 'success_edit', 'object'=>'TopicGroup');
        ob_clean();
        echo json_encode($data);
    }

    else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
    {
        $rowID = $_POST["hidDelete"];

        try
        {

            if (mysql_query("DELETE FROM TopicGroup where topic_group_id='$rowID'")){
                //header("location: ../../views/view_topic_groups.php?message=success&object=TopicGroupDelete");
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'TopicGroupDelete');
                ob_clean();
                echo json_encode($data);
            }
            else {

                throw new Exception('Grupi tematik nuk mund te fshihet per shkak se ka tema aktive qe i takojne!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TopicGroupDelete');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TopicGroupDelete');
            ob_clean();
            echo json_encode($data1);
        }
    }
}


