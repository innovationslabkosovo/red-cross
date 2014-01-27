<aside id="Just_A_Random_ID">
    <?php
    if(logged_in() === true)
    {
        include $project_root.'views/user/logged_in.php';
    }
    else
    {
        include $project_root.'views/user/login_view.php';
    }
    include $project_root.'views/user/user_count.php';
    ?>
</aside>