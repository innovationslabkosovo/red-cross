<aside id="Just_A_Random_ID">
    <?php
    if(logged_in() === false)
    {
        include $project_root.'views/user/login_view.php';
    }
    ?>
</aside>