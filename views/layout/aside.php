<aside id="Just_A_Random_ID">
    <?php
    if(logged_in() === true)
    {
        include 'user/logged_in.php';
    }
    else
    {
        include 'user/login_view.php';
    }
    include 'user/user_count.php';
    ?>
</aside>