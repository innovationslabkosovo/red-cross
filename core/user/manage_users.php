<?php
function change_password($user_id, $password)
{
    $user_id = (int)$user_id;
    $password = md5($password);

    mysql_query("UPDATE `User` SET `password` = '$password' WHERE `user_id` = $user_id");
}

function user_count()
{
    return mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `User`"), 0);
}

function user_data($user_id)
{
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if($func_num_args > 1)
    {
        unset($func_get_args[0]);
        $fields = '`' . implode('`, `', $func_get_args) . '`';
        $data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `User` WHERE `user_id`=$user_id"));

        return $data;
    }

}

function logged_in()
{
    return(isset($_SESSION['id'])) ? true : false;
}

function user_exists($username)
{
    $username = sanitize($username);
    $query = mysql_query("SELECT COUNT(`user_id`) FROM `User` WHERE `username` = '$username'");
    return(mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username)
{
    $username = sanitize($username);
    return mysql_result(mysql_query("SELECT `user_id` FROM `User` WHERE `username` = '$username'"), 0, 'user_id');
}

function login($username, $password)
{
    $user_id = user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    return(mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `User` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}

function is_admin ($user_id)
{

    if ($result = mysql_query("SELECT COUNT(*) as count FROM User WHERE user_id=$user_id and is_superuser=1"))
    {

        if (mysql_result($result, 0, 'count') == 1)
            return true;
        else
            return false;

    }else return false;
}

function get_user_id ($user_id)
{
    if ($user_id)
    {
        if ($result = mysql_query("SELECT user_id FROM User WHERE user_id = $user_id"))
        {
            return mysql_result($result, 0, 'user_id');
        }else
            return false;
    }
    else
        return false;
}
?>