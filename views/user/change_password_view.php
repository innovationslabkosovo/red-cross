<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

include '../../core/init.php';
$page_title = 'Perditeso Fjalkalimin';
protect_page();
include $project_root.'views/layout/header.php';
?>


<h1>Change password!</h1>

<form action="<?php echo BASE_URL; ?>/core/user/change_password.php" method="post">
    <ul>
        <li>
            <label for="current_password">Current password*</label><br>
            <input type="password" name="current_password" id="current_password">
        </li>
        <li>
            <label for="password">New password*</label><br>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password_again">Repeat new password*</label><br>
            <input type="password" name="password_again" id="password_again">
        </li>
        <li>
            <input type="submit" value="Change">
        </li>
    </ul>
</form>
<?php

if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}

include $project_root.'views/layout/footer.php';

?>