<?php
include '../init.php';
if ($_POST['id']) {

    $id=mysql_real_escape_string($_POST['id']);
    $name=mysql_real_escape_string(trim($_POST['name']));

    ob_clean();

    mysql_query("UPDATE Category set name='{$name}' where category_id='{$id}'");

    echo json_encode($_POST);

}