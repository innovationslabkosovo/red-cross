<?php
session_start();

$host = $_SERVER['HTTP_HOST'];
$application_name = explode("/",$_SERVER['REQUEST_URI']);
$application_name = $application_name[1];

define('BASE_URL', 'http://'.$host.DIRECTORY_SEPARATOR.$application_name);

$project_root = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$application_name.DIRECTORY_SEPARATOR;

include $project_root.'config/config.php';
include $project_root.'core/general.php';
include $project_root.'core/user/manage_users.php';

if(logged_in() === true)
{
    $session_user_id = $_SESSION['id'];

    $user_data = user_data($session_user_id, 'user_id', 'name', 'username', 'password');

}

$errors = array();