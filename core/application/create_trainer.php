<?php
include '../init.php';
error_reporting(0);
if(empty($_POST) === false && empty($errors) == true)
{

    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];




    if (mysql_query("INSERT INTO Trainer(trainer_id, name, surname, email, phone) VALUES ('', '$first_name' ,  '$last_name', '$email', '$phone' )"))
    {


        header("location: ../../views/list_trainer.php?message=success&object=participant");
    }
    else
    {
        header("location: ../../views/create_trainer.php?message=fail&object=participant");
    }
}
