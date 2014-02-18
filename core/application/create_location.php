<?php
include '../init.php';
if(empty($_POST) === false)
{
    $name = $_POST['name'];
    $latitude = $_POST['lat'];
    $longitude = $_POST['lon'];
    $municipality_id = $_POST['municipality'];

    if (mysql_query("INSERT INTO Location(location_id, name, latitude, longitude, municipality_id) VALUES ('', '$name', '$latitude', '$longitude', '$municipality_id')"))
        header("location: ../../views/create_location.php?message=success&object=location");
        // echo "Lokacioni eshte shtuar me sukses";
    else if($_POST['id']) {
        $id=mysql_real_escape_string($_POST['id']);
        $loc_name=mysql_real_escape_string($_POST['location_name']);
        mysql_query("update Location set name='$loc_name' where location_id='$id'");
        ob_clean();
        echo json_encode($_POST);
        // echo "Lokacioni eshte perditesuar me sukses!";
    } else {
        //header("location: ../../views/create_location.php?message=fail&object=location");
        echo "Lokacioni nuk eshte shtuar";
    }
}