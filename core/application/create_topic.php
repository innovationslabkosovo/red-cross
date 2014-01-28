<?php
include '../../config/config.php';

if(empty($_POST) === false)
{
    if(isset($_POST['topic']) && $_POST["topic"] != "" && $_POST['id'] == "") {

        $topic=$_POST["topic"];
        $topic_group_id=$_POST["topic_group"];

        if(isset($_POST['active']) && $_POST['active'] == 'active')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }

        if (mysql_query("INSERT INTO Topic(topic_id, description, topic_group_id, active) VALUES ('', '$topic' , '$topic_group_id', '$active')"))
            header("location: ../../views/view_topics.php?message=success&object=Topic");
        else header("location: ../../views/create_topic.php?message=fail&object=Topic");

    }

    if(isset($_POST['topic']) && $_POST["topic"] == "") {
        $data = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Topic');
        ob_clean();
        echo json_encode($data);
    }

    if($_POST['id']) {
        ob_clean();
        $id=mysql_real_escape_string($_POST['id']);
        $topic_edit=mysql_real_escape_string($_POST['topic']);
        $topic_status_edit=mysql_real_escape_string($_POST['status']);
        $topic_group_edit=mysql_real_escape_string($_POST['topic_group']);
        ($topic_status_edit == "Aktiv") ? $topic_status_edit = 1 : $topic_status_edit = 0;
        mysql_query("update Topic set description='$topic_edit', active='$topic_status_edit', topic_group_id='$topic_group_edit'  where topic_id='$id'");
        $topic_group = mysql_query("SELECT name from TopicGroup where topic_group_id=".$topic_group_edit);
        $_POST['topic_group'] = mysql_result($topic_group, 0, 'name');
        echo json_encode($_POST);
    }

    else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
    {
        $rowID = $_POST["hidDelete"];

        try
        {

            if (mysql_query("DELETE FROM Topic where topic_id='$rowID'")){
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'TopicDelete');
                ob_clean();
                echo json_encode($data);
            }
            else {

                throw new Exception('Grupi tematik nuk mund te fshihet per shkak se ka tema aktive apo klasa qe i takojne!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TopicGroupDelete');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TopicDelete');
            ob_clean();
            echo json_encode($data1);
        }
    }
}


