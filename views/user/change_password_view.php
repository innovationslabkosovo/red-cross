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
include $project_root . '/views/layout/header.php';
?>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>/js/form_validate.js"></script>

    <h1>Ndryshoni Fjalekalimin!</h1>

    <form name="change_password" id="change_password" action="<?php echo BASE_URL; ?>/core/user/change_password.php"
          method="post">
        <ul>
            <li>
                <label for="current_password">Current password <span class="required">*</span></label><br>
                <input type="password" name="current_password" id="current_password">
            </li>
            <li>
                <label for="password">New password <span class="required">*</span></label><br>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password_again">Repeat new password <span class="required">*</span></label><br>
                <input type="password" name="password_again" id="password_again">
            </li>
            <li>
                <input type="submit" value="Change">
            </li>
        </ul>
    </form>
    <div id="message"></div>
<?php

if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}

include $project_root . '/views/layout/footer.php';

?>