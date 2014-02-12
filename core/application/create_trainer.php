<?php
include '../init.php';

if(empty($_POST) === false)
{
    if(isset($_POST['first_name']) && $_POST["first_name"] != "" && isset($_POST['last_name']) && $_POST["last_name"] != "" && $_POST['id'] == "") {

        $first_name=$_POST["first_name"];
        $last_name=$_POST["last_name"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        if (mysql_query("INSERT INTO Trainer(trainer_id, name, surname, email, phone) VALUES ('', '$first_name','$last_name','$email','$phone' )"))
            header("location: ../../views/list_trainer.php?message=success&object=Trainer");

        else {
            header("location: ../../views/create_trainer.php?message=fail&object=Trainer");
        }
    }

    else if($_POST['id']) {
        $id=mysql_real_escape_string($_POST['id']);
        $name_edit=mysql_real_escape_string($_POST['first_name']);
        $surname_edit=mysql_real_escape_string($_POST['last_name']);
        $email_edit=mysql_real_escape_string($_POST['email']);
        $phone_edit=mysql_real_escape_string($_POST['phone']);
        mysql_query("update Trainer set name='$name_edit', surname='$surname_edit', email='$email_edit', phone='$phone_edit' where trainer_id='$id'");
        ob_clean();
        $post = $_POST;
        echo json_encode($post);
    }

    if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
    {
        $rowID = $_POST["hidDelete"];

        try
        {

            if (mysql_query("DELETE FROM Trainer where trainer_id='$rowID'")){
                //header("location: ../../views/list_trainer.php?message=success&object=Trainer");
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'Trainer');
                ob_clean();
                echo json_encode($data);

            }
            else {

                throw new Exception('Trajneri nuk mund te shtohet!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Trainer');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Trainer');
            ob_clean();
            echo json_encode($data1);
        }
    }
}
