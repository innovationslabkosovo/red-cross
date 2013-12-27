<?php
/**
 * Created by PhpStorm.
 * User: innovations
 * Date: 12/27/13
 * Time: 1:38 PM
 */

include '../init.php';

//if (empty ($_POST) == false)	// nese eshte dergu forma
//{
//    if(empty ($_POST['category']))
//    {
//        $errors[] = "Ju lutemi mbushni te dhenat";
//    }
//    else
////}

if(empty($_POST['category']) == false && empty($errors) == true)
    {
    //insert to Db
    $name=$_POST["category"];

    $query="INSERT INTO Category(category_id, name)
				VALUES ('','$name')";
    mysql_query($query);
    echo "Te dhenat u ruajten me sukses ne databaze!\n";
    }
    else {
    echo "Ju lutemi mbushni te dhenat";
         }
//else echo implode("", $errors);
?>
