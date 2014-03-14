<?php

$display_messages = array(
    "class" => array(
        "success" => "Kursi u shtua me sukses",
        "fail" => "Kursi nuk u shtua!"
    ),
    "participant" => array(
        "success" => "Pjesemarresi u shtua me sukses",
        "fail" => "Pjesemarresi nuk u shtua!"
    ),
    "participant_answer" => array(
        "success" => "Pergjegjet e pjesemarresit u shtuan me sukses",
        "fail" => "Pergjegjet e pjesemarresit nuk u shtua !"
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
        "fail" => "Grupi tematik nuk mund te fshihet per shkak se ka tema  aktive apo kursi qe i takojne!",
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

    "Supervisor" => array(
        "success" => "Supervizori u shtua me sukses",
        "fail" => "Supervizori nuk u shtua, ju lutem futni te dhenat per emer dhe mbiemer",
    ),

    "Trainer" => array(
        "success" => "Trajneri u shtua me sukses",
        "fail" => "Trajner i ri nuk u shtua, ju lutem futni te dhenat per emer dhe mbiemer",
    ),
        "Evaluation" => array(
        "success" => "Evaluimi i Trajnerit u shtua me sukses",
        "fail" => "Evaluimi i Trajnerit nuk u shtua",
    ),
    "CategoryDelete" => array(
        "success" => "Kategoria u fshi me sukses",
        "fail" => "Kategoria nuk mund te fshihet sepse ka trajner te cilet jane vleresuar me kete kategori!",
    ),
    "TrainerDelete" => array(
        "success" => "Trajneri u fshi me sukses",
        "fail" => "Trajneri nuk mund te fshihet sepse ka kursi te cilat i ka mbajtur!",
    ),
    "SupervisorDelete" => array(
        "success" => "Supervizori u fshi me sukses",
        "fail" => "Supervizori nuk mund te fshihet sepse ka vleresime te cilat i ka bere!",
    ),
    "Question" => array(
        "success" => "Pyetja u shtua me sukses",
        "fail" => "Supervizori nuk u fshi",
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

function protect_page($user_id = NULL)
{


    if(logged_in() === false)
    {
        header('Location:'.BASE_URL.'/views/protected.php');
        exit();
    }

    if ($user_id)
    {

        if (is_admin($user_id) === false)
        {
            header('Location:'.BASE_URL.'/views/protected.php?403=1');
            exit();
        }
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
        // print_r($data);
        // echo $text;

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
