<?php
include '../../config/config.php';

if(empty($_POST) === false)
{
    if(isset($_POST['category']) && $_POST["category"] != "" && $_POST['id'] == "") {

        $category=$_POST["category"];

        if (mysql_query("INSERT INTO Category(category_id, name) VALUES ('', '$category')"))
            header("location: ../../views/list_category.php?message=success&object=CategoryDelete");
        else header("location: ../../views/create_category.php?message=fail&object=CategoryDelete");

    }

    if(isset($_POST['category']) && $_POST["category"] == "") {
        //header("location: ../../views/create_category.php?message=fail&object=CategoryDelete");
        $data = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Category');
        ob_clean();
        echo json_encode($data);
    }

    if($_POST['id']) {
        $id=mysql_real_escape_string($_POST['id']);
        $category_edit=mysql_real_escape_string($_POST['category']);
        mysql_query("update Category set name='$category_edit' where category_id='$id'");
        ob_clean();
        $post = $_POST;
        echo json_encode($post);
    }

    else if(isset($_POST["hidDelete"]) || $_POST["hidDelete"] != "")
    {
        $rowID = $_POST["hidDelete"];

        try
        {

            if (mysql_query("DELETE FROM Category where category_id='$rowID'")){
                //header("location: ../../views/list_category.php?message=success&object=CategoryDelete");
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'CategoryDelete');
                ob_clean();
                echo json_encode($data);
            }
            else {

                throw new Exception('Kategoria nuk mund te shtohet!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'CategoryDelete');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'CategoryDelete');
            ob_clean();
            echo json_encode($data1);
        }
    }
}



//<?php
///**
// * Created by PhpStorm.
// * User: innovations
// * Date: 12/27/13
// * Time: 1:38 PM
// */
//
//include '../init.php';
//
////if (empty ($_POST) == false)	// nese eshte dergu forma
////{
////    if(empty ($_POST['category']))
////    {
////        $errors[] = "Ju lutemi mbushni te dhenat";
////    }
////    else
//////}
//
//if(empty($_POST['category']) == false && empty($errors) == true)
//{
//    //insert to Db
//    $name=$_POST["category"];
//
//    $query="INSERT INTO Category(category_id, name)
//			VALUES ('','$name')";
//    if (mysql_query($query)) {
//
//        header("location: ../../views/list_category.php?message=success&object=Category");
//
//    }
//    else {
//        header("location: ../../views/create_category.php?message=fail&object=Category");
//    }
//}
//else {
//    header("location: ../../views/create_category.php?message=fail&object=Category");
//}
////echo implode("", $errors);
//?>
