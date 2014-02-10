<?php
include '../init.php';

if(empty($_POST) === false)
{
    if(isset($_POST['category']) && $_POST["category"] != "" && $_POST['id'] == "") {

        $category=$_POST["category"];

        if (mysql_query("INSERT INTO Category(category_id, name) VALUES ('', '$category')"))
            header("location: ../../views/list_category.php?message=success&object=Category");
        else header("location: ../../views/create_category.php?message=fail&object=Category");

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
                //header("location: ../../views/list_category.php?message=success&object=Category");
                $data = array( 'rowID' => $rowID, 'message' => 'success', 'object'=>'Category');
                ob_clean();
                echo json_encode($data);
            }
            else {

                throw new Exception('Kategoria nuk mund te shtohet!');
                $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Category');
                ob_clean();
                echo json_encode($data1);
            }
        }
        catch (Exception $e) {
            $data1 = array( 'rowID' => '0', 'message' => 'fail', 'object'=>'Category');
            ob_clean();
            echo json_encode($data1);
        }
    }
}
