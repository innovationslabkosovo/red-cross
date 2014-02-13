<aside id="Just_A_Random_ID">
    <?php
    $include_login = basename($_SERVER['PHP_SELF']);
    if(logged_in() === false && strpos(strtolower($include_login),'public') || $include_login === 'index.php')
    {

    } else if (logged_in() === false && strpos(strtolower($include_login),'public') === false) {
    	include $project_root.'views/user/login_view.php';
    }
    ?>
</aside>