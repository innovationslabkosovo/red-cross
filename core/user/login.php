<?php
include '../init.php';
logged_in_redirect();
if(empty($_POST) === false)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) === true || empty($password) === true)
    {
        $errors[] ="Ju duhet te shkruani emailin tuaj dhe fjalekalimin";
    }
    else if (user_exists($username) === false)
    {
        $errors[] ="Ky email nul ekziston!";
    }
    else
    {
        $login = login($username, $password);

        if($login === false)
        {
            $errors[] = "Ky kombinim i emailit/fjalekalimit eshte gabim";
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
    <h2>Kycja ne platforme nuk eshte bere...</h2>
    <?php
    echo output_errors($errors);
}

include '../../views/layout/footer.php';

?>