<?php
include '../init.php';

if(empty($_POST) === false)
{
    if(isset($_POST['first_name']) && $_POST["first_name"] != "" && isset($_POST['last_name']) && $_POST["last_name"] != "" && $_POST['id'] == "") {

        $first_name=$_POST["first_name"];
        $last_name=$_POST["last_name"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        if (mysql_query("INSERT INTO Supervisor(supervisor_id, name, surname, email, phone) VALUES ('', '$first_name','$last_name','$email','$phone' )"))
            header("location: ../../views/list_supervisor.php?message=success&object=Supervisor");
        else header("location: ../../views/create_supervisor.php?message=fail&object=Supervisor");

    }
    else {
        header("location: ../../views/create_supervisor.php?message=fail&object=Supervisor");
    }

    if(isset($_POST['first_name']) && $_POST["first_name"] == "") {
        //header("location: ../../views/create_category.php?message=fail&object=Supervisor");
        $data = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Supervisor');
        ob_clean();
        echo json_encode($data);
    }

    if($_POST['id']) {
        $id=mysql_real_escape_string($_POST['id']);
        $name_edit=mysql_real_escape_string($_POST['first_name']);
        $surname_edit=mysql_real_escape_string($_POST['last_name']);
        mysql_query("update Supervisor set name='$name_edit', surname='$surname_edit' where supervisor_id='$id'");
        ob_clean();
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
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'Supervisor');
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

//<?php
//include '../init.php';
//error_reporting(0);
//if(empty($_POST) === false && empty($errors) == true)
//{
//
//    $first_name=$_POST["first_name"];
//    $last_name=$_POST["last_name"];
//    $email=$_POST["email"];
//    $phone=$_POST["phone"];
//
//
//
//
//    if (mysql_query("INSERT INTO Supervisor(Supervisor_id, name, surname, email, phone) VALUES ('', '$first_name' ,  '$last_name', '$email', '$phone' )"))
//    {
//
//
//        header("location: ../../views/list_supervisor.php?message=success&object=participant");
//    }
//    else
//    {
//        header("location: ../../views/create_supervisor.php?message=fail&object=participant");
//    }
//}
