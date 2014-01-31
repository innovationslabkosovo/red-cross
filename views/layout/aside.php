<aside id="Just_A_Random_ID">
    <?php
    $include_login = basename($_SERVER['PHP_SELF']);
    $public_reports = 'reports.php';
    if(logged_in() === false && $include_login === $public_reports)
    {

    } else if (logged_in() === false && $include_login != $public_reports) {
    	include $project_root.'views/user/login_view.php';
    }
    ?>
</aside>