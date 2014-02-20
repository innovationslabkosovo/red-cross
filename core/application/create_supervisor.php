<?php
include '../init.php';

if(empty($_POST) === false)
{
    if(isset($_POST['name']) && $_POST["name"] != "" && isset($_POST['surname']) && $_POST["surname"] != "" && !(isset($_POST['id']))) {

        $name=trim($_POST["name"]);
        $surname=trim($_POST["surname"]);
        $email=trim($_POST["email"]);
        $phone=trim($_POST["phone"]);

        if (mysql_query("INSERT INTO Supervisor(supervisor_id, name, surname, email, phone) VALUES ('', '$name','$surname','$email','$phone' )"))
            header("location: ../../views/list_supervisor.php?message=success&object=Supervisor");
        else header("location: ../../views/create_supervisor.php?message=fail&object=Supervisor");
    }

    if((isset($_POST['name']) && $_POST["name"] == "") || (isset($_POST['surname']) && $_POST["surname"] == "" )) {
        header("location: ../../views/create_supervisor.php?message=fail&object=Supervisor");
        }

    if($_POST['id']) {
        ob_clean();
        $id=mysql_real_escape_string($_POST['id']);
        $name_edit=mysql_real_escape_string(trim($_POST['name']));
        $surname_edit=mysql_real_escape_string(trim($_POST['surname']));
        $email_edit=mysql_real_escape_string(trim($_POST['email']));
        $phone_edit=mysql_real_escape_string(trim($_POST['phone']));
        mysql_query("UPDATE Supervisor SET name='$name_edit', surname='$surname_edit', email='$email_edit', phone='$phone_edit' WHERE supervisor_id='$id'");
        $post = $_POST;
        echo json_encode($post);
    }

         else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
         {
             $rowID = $_POST["hidDelete"];

             try
             {

                 if (mysql_query("DELETE FROM Supervisor where supervisor_id='$rowID'")){
                 //header("location: ../../views/list_category.php?message=success&object=Category");
                     $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'SupervisorDelete');
                     ob_clean();
                     echo json_encode($data);
                 }
                 else {

                 throw new Exception('Supervizori nuk mund te shtohet!');
                 $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Supervisor');
                 ob_clean();
                 echo json_encode($data1);
                      }
             }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Supervisor');
            ob_clean();
            echo json_encode($data1);
        }
    }
}
