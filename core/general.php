<?php

$display_messages = array(
    "class" => array(
        "success" => "Klasa eshte shtuar me sukses",
        "fail" => "Klasa nuk eshte shtuar "),
    "user" => array(
        "success" => "Fjalkalimi u perditsu",
        "fail" => "Fjalkalimi nuk u perditesua"),
    "location" => array(
        "success" => "Lokacioni eshte shtuar me sukses",
        "fail" => "Lokacioni nuk eshte shtuar"
    ),
);


echo "<pre></pre>";

function logged_in_redirect()
{
    if (logged_in() === true) {
        header('Location: ../../index.php');
        exit();
    }
}

function protect_page()
{
    if (logged_in() === false) {
        header('Location: ../views/protected.php');
        exit();
    }
}

function sanitize($data)
{
    return mysql_real_escape_string($data);
}

function output_errors($errors)
{
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function create_options($query_result, $value, $text)
{
    while ($data = mysql_fetch_assoc($query_result))
        echo "<option value=\"{$data[$value]}\">$data[$text]</option>";
}

