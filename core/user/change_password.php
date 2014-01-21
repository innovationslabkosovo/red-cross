<?php
include '../../core/init.php';
//protect_page();

if(empty($_POST) === false)
{
    $required_fields = array('current_password', 'password', 'password_again');
    foreach($_POST as $key => $value)
    {
        if(empty($value) && in_array($key, $required_fields) === true)
        {

            $errors[] = 'Fields marked with an asterisk are required';
            break 1;
        }
    }

    if(md5($_POST['current_password']) === $user_data['password'])
    {
        if(trim($_POST['password']) !== trim($_POST['password_again']))
        {
            $errors[] = 'Your new passwords do not match';
        }
        else if(strlen($_POST['password']) < 6)
        {
            $errors[] = 'Your password must be at least 6 characters';
        }
    }
    else
    {
        $errors[] = 'Your current password is incorrect.';
    }

}
?>

<?php
if(isset($_GET['success']) && empty($_GET['success']))
{
    echo 'Your password has been changed';
}
else
{
    if(empty($_POST) === false && empty($errors) === true)
    {
        change_password($_SESSION['id'], $_POST['password']);
        //header("location: ../../views/user/change_password_view.php?message=success&object=user");
    }
    else if (empty($errors) === false)
    {
        echo output_errors($errors);
        //header("location: ../../views/user/change_password_view.php?message=fail&object=user");
    }
    ?>
<?php
}
?>