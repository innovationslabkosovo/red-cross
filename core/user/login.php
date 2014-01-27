<?php
include '../init.php';
logged_in_redirect();
if(empty($_POST) === false)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) === true || empty($password) === true)
    {
        $errors[] ="You need to enter a username and password";
    }
    else if (user_exists($username) === false)
    {
        $errors[] ="That username doesn't exist!";
    }
    else
    {
        $login = login($username, $password);

        if($login === false)
        {
            $errors[] = "That username/password combination is incorrect";
        }
        else
        {
            $_SESSION['id'] = $login;
            header('Location: ../../index.php');
            exit();

        }
    }
}
else
{
    $errors[] = 'No data received';
}

include '../../views/layout/header.php';
if(empty($errors) === false)
{
    ?>
    <h2>We tried to log you in, but...</h2>
    <?php
    echo output_errors($errors);
}

include '../../views/layout/footer.php';

?>