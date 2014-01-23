<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);

include("core/database/connect.php");

function createoptions($table , $id , $field , $condition_field , $value)
{
    $sql = sprintf("select * from $table WHERE $condition_field=%d ORDER BY $field" , $value);
    $res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($res) > 0) {
        while ($a = mysql_fetch_assoc($res))
        $out[] = "{optionValue: {$a[$id]}, optionDisplay: '$a[$field]'}";
        return "[" . implode("," , $out) . "]";
    } else

        return "[{optionValue: -1 , optionDisplay: 'No result'}]";
}

if (isset($_GET['municipality'])) {
    echo createoptions("location" , "id" , "name" , "municipality_id" , $_GET['municipality']);
}


die();
?>