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

            $errors[] = 'Fushat me nje yll te kuq jane te detyrueshme';
            break 1;
        }
    }

    if(md5($_POST['current_password']) === $user_data['password'])
    {
        if(trim($_POST['password']) !== trim($_POST['password_again']))
        {
            $errors[] = 'Fjalekalimet e reja tuaja nuk perputhen';
        }
        else if(strlen($_POST['password']) < 6)
        {
            $errors[] = 'Fjalkalimi duhet te jete te pakten 6 karaktere';
        }
    }
    else
    {
        $errors[] = 'Fjalkalimi i tanishem nuk eshte i sakte.';
    }

}
?>

<?php
if(isset($_GET['success']) && empty($_GET['success']))
{
    // echo 'Fjalkalimi u nderrua me sukses';
}
else
{
    if(empty($_POST) === false && empty($errors) === true)
    {
        change_password($_SESSION['id'], $_POST['password']);
        echo 'Fjalkalimi u ndryshua me sukses!';
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