<aside id="Just_A_Random_ID">
    <?php
    $include_login = basename($_SERVER['PHP_SELF']);
    if(logged_in() === false && $include_login === 'reports.php')
    {

    } else if (logged_in() === false && $include_login != 'reports.php') {
    	include $project_root.'views/user/login_view.php';
    }
    ?>
</aside>