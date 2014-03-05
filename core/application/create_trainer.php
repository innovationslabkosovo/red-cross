<?php
include '../init.php';

if(empty($_POST) === false)
{
    if(isset($_POST['name']) && $_POST["name"] != "" && isset($_POST['surname']) && $_POST["surname"] != "" && isset($_POST['email']) && isset($_POST['phone']) && !(isset($_POST['id']))) {

        $name=trim($_POST["name"]);
        $surname=trim($_POST["surname"]);
        $email=trim($_POST["email"]);
        $phone=trim($_POST["phone"]);
        $trainer_municipality=$_POST['trainer_municipality'];

        if (mysql_query("INSERT INTO Trainer(trainer_id, name, surname, email, phone, municipality_id) VALUES ('', '$name','$surname','$email','$phone', '$trainer_municipality' )"))
            header("location: ../../views/list_trainer.php?message=success&object=Trainer");
        else header("location: ../../views/create_trainer.php?message=fail&object=Trainer");
    }
    if((isset($_POST['name']) && $_POST["name"] == "") || (isset($_POST['surname']) && $_POST["surname"] == "" )) {
        header("location: ../../views/create_trainer.php?message=fail&object=Trainer");
        }
    if($_POST['id']) {
        ob_clean();
        $id=mysql_real_escape_string($_POST['id']);
        $name_edit=mysql_real_escape_string(trim($_POST['name']));
        $surname_edit=mysql_real_escape_string(trim($_POST['surname']));
        $email_edit=mysql_real_escape_string(trim($_POST['email']));
        $phone_edit=mysql_real_escape_string(trim($_POST['phone']));
        mysql_query("UPDATE Trainer SET name='$name_edit', surname='$surname_edit', email='$email_edit', phone='$phone_edit' WHERE trainer_id='$id'");
        $post = $_POST;
        echo json_encode($post);
    }
    else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "") {
        $rowID = $_POST["hidDelete"];

        try
        {

            if (mysql_query("DELETE FROM Trainer where trainer_id='$rowID'")){
                //header("location: ../../views/list_trainer.php?message=success&object=Trainer");
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'TrainerDelete');
                ob_clean();
                echo json_encode($data);

            }
            else {

                throw new Exception('Trajneri nuk mund te fshihet!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TrainerDelete');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'TrainerDelete');
            ob_clean();
            echo json_encode($data1);
        }
    }
}
