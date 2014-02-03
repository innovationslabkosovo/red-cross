<?php

$display_messages = array(
    "class" => array(
        "success" => "Klasa u shtua me sukses",
        "fail" => "Klasa nuk u shtua!"
    ),
    "participant" => array(
        "success" => "Participanti u shtua me sukses",
        "fail" => "Participanti nuk u shtua !"
    ),
    "user" => array(
        "success" => "Fjalkalimi u perditsu",
        "fail" => "Fjalkalimi nuk u perditesua"
    ),
    "location" => array(
        "success" => "Lokacioni u shtua me sukses",
        "fail" => "Lokacioni nuk u shtua"
    ),
    "TopicGroup" => array(
        "success" => "Grupi Tematik u shtua me sukses",
        "success_edit" => "Grupi Tematik u editua me sukses",
        "fail" => "Grupi Tematik nuk u shtua!",
    ),
    "TopicGroupDelete" => array(
        "success" => "Grupi Tematik u fshi me sukses",
        "fail" => "Grupi tematik nuk mund te fshihet per shkak se ka tema  aktive apo klasa qe i takojne!",
    ),
    "Topic" => array(
        "success" => "Tema u shtua me sukses",
        "success_edit" => "Tema u editua me sukses",
        "fail" => "Tema nuk u shtua!",
    ),
    "TopicDelete" => array(
        "success" => "Tema u fshi me sukses",
    ),
    "Category" => array(
        "success" => "Kategoria u shtua me sukses",
        "fail" => "Kategoria nuk u shtua",
    ),
);


function logged_in_redirect()
{
    if(logged_in() === true)
    {
        header('Location:'.BASE_URL.'/views/index.php');
        exit();
    }
}

function protect_page()
{
    if(logged_in() === false)
    {
        header('Location:'.BASE_URL.'/views/protected.php');
        exit();
    }
}

function sanitize($data)
{
    return mysql_real_escape_string($data);
}

function output_errors($errors)
{
    return '<ul><li>'. implode('</li><li>', $errors) .'</li></ul>';
}

function create_options($query_result , $value , $text, $selected=NULL)
{


    while ($data = mysql_fetch_assoc($query_result))
    {
        //print_r($data);

        if ($data[$value] == $selected)
            echo "<option value=\"{$data[$value]}\" selected>$data[$text]</option>";
        else
            echo "<option value=\"{$data[$value]}\">$data[$text]</option>";

    }

}

function create_options_municipality($query_result , $value , $text, $optional)
{
    while ($data = mysql_fetch_assoc($query_result))
        echo "<option value=\"{$data[$value]}\" id=\"{$data[$optional]}\">$data[$text]</option>";
}

function transpose($array,&$out, $indices = array()) {
    if(is_array($array)){
        foreach($array as $key => $val) {//push onto the stack of indices
            $temp = $indices;
            $temp[]= $key;
            transpose($val, $out, $temp);}
    } else {//go through the stack in reverse - make the new array
        $ref = &$out;
        foreach(array_reverse($indices)as $idx)
            $ref =&$ref[$idx];
        $ref = $array;
    }
}

/* Beautify array or object */
function pre($array) {
    echo "<pre style='font-size:12px;'>";
    print_r($array);
    echo "</pre>";
}
