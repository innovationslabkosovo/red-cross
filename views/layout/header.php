<!doctype html>
<html>
<?php
include $project_root.'views/layout/head.php';
?>
<body>
<header>
    <h1 class="logo"><a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/img/kryqikuq.png" width="100px" height="100px" alt="Red Cross"></a></h1>
    <?php
    	if (logged_in() == true)
    	{
    		include $project_root.'views/user/logged_in.php';
    	}
    ?>
    <?php include 'nav_menu.php'; ?>
    <div class="clear"></div>
</header>
<div id="container">

    <?php
    include 'aside.php';
    ?>
