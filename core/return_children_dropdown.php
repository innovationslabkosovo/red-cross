<?php
include('init.php');

if (isset($_POST['parent_value']) && isset($_POST['parent_id_field']) && isset($_POST['child_table']) && isset($_POST['child_id_field']) && isset($_POST['child_text_field'])){
    $parent_value = $_POST['parent_value'];
    $parent_id_field = $_POST['parent_id_field'];
    $child_table = $_POST['child_table'];
    $child_id_field = $_POST['child_id_field'];
    $child_text_field = $_POST['child_text_field'];

}
if ($query_result=mysql_query("select $child_id_field , $child_text_field from $child_table where $parent_id_field = $parent_value"))
    echo create_options($query_result , $child_id_field , $child_text_field);
else
    echo "";
